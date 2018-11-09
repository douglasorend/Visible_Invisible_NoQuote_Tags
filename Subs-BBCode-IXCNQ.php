<?php
/**********************************************************************************
* Subs-BBCode_IXCNQ.php
***********************************************************************************
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
function BBCode_IXCNQ(&$bbc)
{
	// Definition of "visible" and "invisible" bbcodes:
	$visible = array(
		'tag' => 'visible',
		'type' => 'unparsed_content',
		'validate' => 'BBCode_IXCNQ_Visible',
		'disabled' => '$1',
	);
	$invisible = array(
		'tag' => 'invisible',
		'type' => 'unparsed_content',
		'validate' => 'BBCode_IXCNQ_Invisible',
		'disabled' => '$1',
	);
	$visible['parameters'] = $invisible['parameters'] = array(
		'u' => array('optional' => true, 'match' => '((\d+),?)+', 'validate' => 'BBCode_IXCNQ_UserID'),
		'g' => array('optional' => true, 'match' => '((\d+),?)+', 'validate' => 'BBCode_IXCNQ_GroupID'),
		'username' => array('optional' => true, 'validate' => 'BBCode_IXCNQ_Username'),
		'name' => array('optional' => true, 'validate' => 'BBCode_IXCNQ_Name'),
		'group' => array('optional' => true, 'validate' => 'BBCode_IXCNQ_Group'),
		'guests' => array('optional' => true, 'validate' => 'BBCode_IXCNQ_Guest'),
		'members' => array('optional' => true, 'validate' => 'BBCode_IXCNQ_Members'),
		'lang' => array('optional' => true, 'validate' => 'BBCode_IXCNQ_Lang'),
		'posts' => array('optional' => true, 'match' => '(\d+)', 'validate' => 'BBCode_IXCNQ_Posts'),
	);
	$visible['content'] = $invisible['content'] = '{' . implode('}|{', array_keys($visible['parameters'])) . '}';
	$bbc[] = &$visible;
	$bbc[] = &$invisible;

	// Definition of "noquote" bbcode:
	$bbc[] = array(
		'tag' => 'noquote',
		'before' => '',
		'after' => '',
	);
}

/**********************************************************************************
* Parameter validation function for our BBcodes
**********************************************************************************/
function BBCode_IXCNQ_UserID($data)
{
	global $user_info;
	return in_array($user_info['id'], explode(',', $data));
}

function BBCode_IXCNQ_Lang($data)
{
	global $user_info;
	return in_array($user_info['language'], explode(',', $data));
}

function BBCode_IXCNQ_Guest($data)
{
	global $user_info;
	return $user_info['is_guest'];
}

function BBCode_IXCNQ_Members($data)
{
	global $user_info;
	return !$user_info['is_guest'];
}

function BBCode_IXCNQ_Posts($data)
{
	global $user_info;
	return $user_info['posts'] >= $data;
}

function BBCode_IXCNQ_GroupID($data)
{
	global $user_info;
	$valid = false;
	$data = explode(',', $data);
	foreach ($user_info['groups'] as $group)
		$valid = $valid || in_array($group, $data);
	return $valid;
}

function BBCode_IXCNQ_Name($data)
{
	global $user_info, $context;
	$valid = false;
	$username = strtolower($user_info['name']);
	foreach (explode(',', $data) as $check)
	{
		$pattern = '#' . strtolower($check) . '#i' . ($context['utf8'] ? 'u' : '');
		$valid = $valid || preg_match($pattern, $username);
	}
	return $valid;
}

function BBCode_IXCNQ_Username($data)
{
	global $user_info, $context;
	$valid = false;
	$username = strtolower($user_info['username']);
	foreach (explode(',', $data) as $check)
	{
		$pattern = '#' . strtolower($check) . '#i' . ($context['utf8'] ? 'u' : '');
		$valid = $valid || preg_match($pattern, $username);
	}
	return $valid;
}

function BBCode_IXCNQ_Group($data)
{
	global $smcFunc, $user_info, $context;
	
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
function BBCode_IXCNQ_Visible(&$tag, &$data, &$disabled)
{
	$valid = false;
	$checks = explode('|', $tag['content']);
	foreach ($checks as $check)
		$valid = $valid || !empty($check);
	if ($valid)
		$tag['content'] = parse_bbc($data);
	else
		$tag['content'] = '';
}

function BBCode_IXCNQ_Invisible(&$tag, &$data, &$disabled)
{
	$valid = false;
	$checks = explode('|', $tag['content']);
	foreach ($checks as $check)
		$valid = $valid || !empty($check);
	if ($valid)
		$tag['content'] = '';
	else
		$tag['content'] = parse_bbc($data);
}

/**********************************************************************************
* Additional subfunction required by our mod
**********************************************************************************/
function BBCode_IXCNQ_Remove(&$message)
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