<?php
/**********************************************************************************
* Subs-BBCode_VIVNQ.php
***********************************************************************************
* This program is distributed in the hope that it is and will be useful, but      *
* WITHOUT ANY WARRANTIES; without even any implied warranty of MERCHANTABILITY    *
* or FITNESS FOR A PARTICULAR PURPOSE.                                            *
**********************************************************************************/
if (!defined('SMF'))
	die('Hacking attempt...');

/**********************************************************************************
* Function that defines the BBCode we are adding to the forum
**********************************************************************************/
function BBCode_VIVNQ(&$bbc)
{
	global $smcFunc;

	// Definition of "visible", "invisible" and "noquote" bbcodes:
	$bbc[] = array(
		'tag' => 'noquote',
		'before' => '',
		'after' => '',
	);
	$visible = array(
		'tag' => 'visible',
		'type' => 'unparsed_content',
		'validate' => 'BBCode_VIVNQ_Visible',
		'disabled' => '$1',
	);
	$invisible = array(
		'tag' => 'invisible',
		'type' => 'unparsed_content',
		'validate' => 'BBCode_VIVNQ_Invisible',
		'disabled' => '$1',
	);

	// Let's define most of the parameters for the "visible" and "invisible" bbcodes:
	$parameters = array(
		'u' => array('optional' => true, 'match' => '(\d+|((\d+),?)+)', 'validate' => 'BBCode_VIVNQ_UserID'),
		'g' => array('optional' => true, 'match' => '(\d+|((\d+),?)+)', 'validate' => 'BBCode_VIVNQ_GroupID'),
		'min_posts' => array('optional' => true, 'match' => '(\d+)', 'validate' => 'BBCode_VIVNQ_MinPosts'),
		'max_posts' => array('optional' => true, 'match' => '(\d+)', 'validate' => 'BBCode_VIVNQ_MaxPosts'),
		'guests' => array('optional' => true, 'match' => '(y|yes|true|1|n|no|false|0)', 'validate' => 'BBCode_VIVNQ_Guests'),
		'members' => array('optional' => true, 'match' => '(y|yes|true|1|n|no|false|0)', 'validate' => 'BBCode_VIVNQ_Members'),
		'banned' => array('optional' => true, 'match' => '(y|yes|true|1|n|no|false|0)', 'validate' => 'BBCode_VIVNQ_Banned'),
		'username' => array('optional' => true, 'quoted' => true, 'validate' => 'BBCode_VIVNQ_Username'),
		'user' => array('optional' => true, 'quoted' => true, 'validate' => 'BBCode_VIVNQ_User'),
		'group' => array('optional' => true, 'quoted' => true, 'validate' => 'BBCode_VIVNQ_Group'),
		'lang' => array('optional' => true, 'quoted' => true, 'validate' => 'BBCode_VIVNQ_Lang'),
	);

	// TODO: Let's get all the custom fields so that we can process these too:

	// Finish adding these bbcodes to the array:
	$visible['parameters'] = $invisible['parameters'] = $parameters;
	$visible['content'] = $invisible['content'] = '{' . implode('}|{', array_keys($parameters)) . '}';
	$bbc[] = &$visible;
	$bbc[] = &$invisible;
}

/**********************************************************************************
* Parameter validation function for our BBcodes
**********************************************************************************/
function BBCode_VIVNQ_UserID($data)
{
	global $user_info;
	return in_array($user_info['id'], explode(',', $data));
}

function BBCode_VIVNQ_Lang($data)
{
	global $user_info;
	return in_array(strtolower($user_info['language']), explode(',', strtolower($data)));
}

function BBCode_VIVNQ_Guests($data)
{
	global $user_info;
	$okay = ($data == 'y' || $data == 'yes' || $data == 1 || $data == 'true');
	return (!empty($user_info['is_guest']) && !empty($okay)) || (empty($user_info['is_guest']) && empty($okay));
}

function BBCode_VIVNQ_Members($data)
{
	global $user_info;
	$okay = ($data == 'y' || $data == 'yes' || $data == 1 || $data == 'true');
	return (empty($user_info['is_guest']) && !empty($okay)) || (!empty($user_info['is_guest']) && empty($okay));
}

function BBCode_VIVNQ_Banned($data)
{
	global $user_info;
	$okay = ($data == 'y' || $data == 'yes' || $data == 1 || $data == 'true');
	return (empty($user_info['is_banned']) && !empty($okay)) || (!empty($user_info['is_banned']) && empty($okay));
}

function BBCode_VIVNQ_MinPosts($data)
{
	global $user_info;
	return $user_info['posts'] >= (int) $data;
}

function BBCode_VIVNQ_MaxPosts($data)
{
	global $user_info;
	return $user_info['posts'] <= (int) $data;
}

function BBCode_VIVNQ_GroupID($data)
{
	global $user_info;
	$valid = false;
	$data = explode(',', $data);
	foreach ($user_info['groups'] as $group)
		$valid = $valid || in_array($group, $data);
	return $valid;
}

function BBCode_VIVNQ_User($data)
{
	global $user_info, $context;

	// Save some time and return FALSE if data is empty:
	if (empty($data))
		return false;

	// Search for the username as a regex expression:
	$valid = false;
	$username = strtolower($user_info['name']);
	foreach (explode(',', $data) as $check)
	{
		$pattern = '#' . strtolower($check) . '#i' . ($context['utf8'] ? 'u' : '');
		$valid = $valid || preg_match($pattern, $username);
	}
	return $valid;
}

function BBCode_VIVNQ_Username($data)
{
	global $user_info, $context;

	// Save some time and return FALSE if data is empty:
	if (empty($data))
		return false;

	// Search for the username as a regex expression:
	$valid = false;
	$username = strtolower($user_info['username']);
	foreach (explode(',', $data) as $check)
	{
		$pattern = '#' . strtolower($check) . '#i' . ($context['utf8'] ? 'u' : '');
		$valid = $valid || preg_match($pattern, $username);
	}
	return $valid;
}

function BBCode_VIVNQ_Group($data)
{
	global $smcFunc, $user_info, $context;
	
	// Save some time and return FALSE if data is empty:
	if (empty($data))
		return false;

	// Retrieve the membergroup IDs from the database:
	if (($groupIDs = cache_get_data('membergroup_names', 360)) == null)
	{
		$result = $smcFunc['db_query']('', '
			SELECT id_group, group_name
			FROM {db_prefix}membergroups'
		);
		$groupIDs = array();
		while ($row = $smcFunc['db_fetch_assoc']($result))
			$groupIDs[$row['id_group']] = $row['group_name'];
		$smcFunc['db_free_result']($result);
		cache_put_data('membergroup_names', $groupIDs, 360);
	}

	// Compare the membergroup IDs to the current users' membergroups:
	$valid = false;
	$data = explode(',', $data);
	foreach ($user_info['groups'] as $group)
	{
		$group = strtolower($groupIDs[$group]);
		foreach ($data as $check)
		{
			$pattern = '#' . strtolower($check) . '#i' . ($context['utf8'] ? 'u' : '');
			$valid = $valid || preg_match($pattern, $group);
		}
	}
	return $valid;
}

/**********************************************************************************
* Main Validation functions for our BBcodes
**********************************************************************************/
function BBCode_VIVNQ_Visible(&$tag, &$data, &$disabled)
{
	global $context;
	$valid = false;
	$checks = explode('|', $tag['content']);
	foreach ($checks as $check)
		$valid = $valid || !empty($check);
	$tag['content'] = '';
	if (!empty($valid) || !empty($context['VIVNQ_Test']))
		$tag['content'] = parse_bbc($data);
}

function BBCode_VIVNQ_Invisible(&$tag, &$data, &$disabled)
{
	global $context;
	$valid = false;
	$checks = explode('|', $tag['content']);
	foreach ($checks as $check)
		$valid = $valid || !empty($check);
	$tag['content'] = '';
	if (empty($valid) || !empty($context['VIVNQ_Test']))
		$tag['content'] = parse_bbc($data);
}

/**********************************************************************************
* Additional subfunction required by our mod
**********************************************************************************/
function BBCode_VIVNQ_Remove(&$message)
{
	global $context;
	$pattern = '#\[visible (.+?)\](.+?)\[/visible\]#i' . ($context['utf8'] ? 'u' : '');
	$message = preg_replace($pattern, '', $message);
	$pattern = '#\[invisible (.+?)\](.+?)\[/invisible\]#i' . ($context['utf8'] ? 'u' : '');
	$message = preg_replace($pattern, '', $message);
	$pattern = '#\[noquote\](.+?)\[/noquote\]#i' . ($context['utf8'] ? 'u' : '');
	$message = preg_replace($pattern, '', $message);
}

?>