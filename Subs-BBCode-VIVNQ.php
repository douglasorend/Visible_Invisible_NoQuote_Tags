<?php
/**********************************************************************************
* Subs-BBCode_VIVNQ.php
***********************************************************************************
* This mod is licensed under the 2-clause BSD License, which can be found here:
*	http://opensource.org/licenses/BSD-2-Clause
***********************************************************************************
* This program is distributed in the hope that it is and will be useful, but      *
* WITHOUT ANY WARRANTIES; without even any implied warranty of MERCHANTABILITY    *
* or FITNESS FOR A PARTICULAR PURPOSE.                                            *
**********************************************************************************/
if (!defined('SMF'))
	die('Hacking attempt...');

//=================================================================================
// BBCode Hook functions
//=================================================================================
function BBCode_VIVNQ(&$bbc)
{
	global $smcFunc;

	// Let's get the parameters for the "visible" and "invisible" bbcodes:
	$parameters = BBCode_VIVNQ_parameters();
	$keys = '{' . implode('}|{', array_keys($parameters)) . '}';

	// Definition of "visible", "invisible" and "noquote" bbcodes:
	$bbc[] = array(
		'tag' => 'noquote',
		'before' => '',
		'after' => '',
	);
	$bbc[] = array(
		'tag' => 'visible',
		'type' => 'unparsed_content',
		'parameters' => $parameters,
		'validate' => 'BBCode_VIVNQ_Visible',
		'content' => $keys,
		'disabled' => '$1',
	);
	$bbc[] = array(
		'tag' => 'visible',
		'before' => '',
		'after' => '',
	);
	$bbc[] = array(
		'tag' => 'invisible',
		'type' => 'unparsed_content',
		'parameters' => $parameters,
		'validate' => 'BBCode_VIVNQ_Invisible',
		'content' => $keys,
		'disabled' => '$1',
	);
	$bbc[] = array(
		'tag' => 'invisible',
		'type' => 'unparsed_content',
		'content' => '',
		'disabled' => '$1',
	);
}

function BBCode_VIVNQ_LoadTheme()
{
	global $context, $settings;
	$context['html_headers'] .= '
	<link rel="stylesheet" type="text/css" href="' . $settings['default_theme_url'] . '/css/BBCode-VIVNQ.css" />';
}

function BBCode_VIVNQ_Permissions(&$permissionGroups, &$permissionList, &$leftPermissionGroups, &$hiddenPermissions, &$relabelPermissions)
{
	global $context;

	// Define the new permissions that we will use throughout the mod:
	$permissionList['board']['VIVNQ_use_visible'] = array(false, 'VIVNQ', 'VIVNQ');
	$permissionList['board']['VIVNQ_quote_visible'] = array(false, 'VIVNQ', 'VIVNQ');
	$permissionList['board']['VIVNQ_use_invisible'] = array(false, 'VIVNQ', 'VIVNQ');
	$permissionList['board']['VIVNQ_quote_invisible'] = array(false, 'VIVNQ', 'VIVNQ');
	$permissionList['board']['VIVNQ_use_noquote'] = array(false, 'VIVNQ', 'VIVNQ');
	$permissionList['board']['VIVNQ_quote_noquote'] = array(false, 'VIVNQ', 'VIVNQ');
	$permissionList['board']['VIVNQ_toggle_filter'] = array(false, 'VIVNQ', 'VIVNQ');
	
	// Define the illegal permissions that Guests cannot use:
	$context['non_guest_permissions'][] = 'VIVNQ_use_visible';
	$context['non_guest_permissions'][] = 'VIVNQ_quote_visible';
	$context['non_guest_permissions'][] = 'VIVNQ_use_invisible';
	$context['non_guest_permissions'][] = 'VIVNQ_quote_invisible';
	$context['non_guest_permissions'][] = 'VIVNQ_use_noquote';
	$context['non_guest_permissions'][] = 'VIVNQ_quote_noquote';
	$context['non_guest_permissions'][] = 'VIVNQ_toggle_filter';
}

/**********************************************************************************
* Function defining all parameters used by the mod:
**********************************************************************************/
function BBCode_VIVNQ_parameters()
{
	// Define all the standard parameters that we can check easily:
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
		'karma' => array('optional' => true, 'match' => '(\d+)', 'validate' => 'BBCode_VIVNQ_Karma'),
		'replied' => array('optional' => true, 'match' => '(\d+)', 'validate' => 'BBCode_VIVNQ_Replied'),
		'warning' => array('optional' => true, 'match' => '(\d+)', 'validate' => 'BBCode_VIVNQ_Warning'),
	);

	// Add any usable custom fields to the standard parameters:
	// TODO: All custom fields should be added here!

	// Return to the parameters to the caller:
	return $parameters;
}

/**********************************************************************************
* Parameter validation function for our BBcodes
**********************************************************************************/
function BBCode_VIVNQ_UserID($data)
{
	global $user_info, $context;
	if (empty($data))
		return false;
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'U:' . $data;
	return in_array($user_info['id'], explode(',', $data));
}

function BBCode_VIVNQ_Lang($data)
{
	global $user_info, $context;
	if (empty($data))
		return false;
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'Lang:' . strtolower($data);
	return in_array(strtolower($user_info['language']), explode(',', strtolower($data)));
}

function BBCode_VIVNQ_Guests($data)
{
	global $user_info, $context;
	if (empty($data))
		return false;
	$okay = ($data == 'y' || $data == 'yes' || $data == 1 || $data == 'true');
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'Guests:' . (empty($okay) ? 'N' : 'Y');
	return (!empty($user_info['is_guest']) && !empty($okay)) || (empty($user_info['is_guest']) && empty($okay));
}

function BBCode_VIVNQ_Members($data)
{
	global $user_info, $context;
	if (empty($data))
		return false;
	$okay = ($data == 'y' || $data == 'yes' || $data == 1 || $data == 'true');
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'Members:' . (empty($okay) ? 'N' : 'Y');
	return (empty($user_info['is_guest']) && !empty($okay)) || (!empty($user_info['is_guest']) && empty($okay));
}

function BBCode_VIVNQ_Banned($data)
{
	global $user_info, $context;
	if (empty($data))
		return false;
	$okay = ($data == 'y' || $data == 'yes' || $data == 1 || $data == 'true');
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'Banned:' . (empty($okay) ? 'N' : 'Y');
	return (empty($user_info['is_banned']) && !empty($okay)) || (!empty($user_info['is_banned']) && empty($okay));
}

function BBCode_VIVNQ_MinPosts($data)
{
	global $user_info, $context;
	if (empty($data))
		return false;
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'MinPosts:' . ((int) $data);
	return $user_info['posts'] >= (int) $data;
}

function BBCode_VIVNQ_MaxPosts($data)
{
	global $user_info, $context;
	if (empty($data))
		return false;
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'MaxPosts:' . ((int) $data);
	return $user_info['posts'] <= (int) $data;
}

function BBCode_VIVNQ_GroupID($data)
{
	global $user_info, $context;
	if (empty($data))
		return false;
	$valid = false;
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'MinPosts:' . $data;
	$data = explode(',', $data);
	foreach ($user_info['groups'] as $group)
		$valid = $valid || in_array($group, $data);
	return $valid;
}

function BBCode_VIVNQ_User($data)
{
	global $user_info, $context;

	if (empty($data))
		return false;
	$valid = false;
	$username = strtolower($user_info['name']);
	foreach (explode(',', $data) as $check)
	{
		$pattern = '#' . strtolower($check) . '#i' . ($context['utf8'] ? 'u' : '');
		$valid = $valid || preg_match($pattern, $username);
	}
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'User:' . $data;
	return $valid;
}

function BBCode_VIVNQ_Username($data)
{
	global $user_info, $context;

	if (empty($data))
		return false;
	$valid = false;
	$username = strtolower($user_info['username']);
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'Username:' . $data;
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

	if (empty($data))
		return false;
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
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'Group:' . $data;
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

function BBCode_VIVNQ_Karma($data)
{
	global $smcFunc, $user_info, $context;
	static $saved_karma = array();

	if (is_array($saved_karma))
	{
		$query = $smcFunc['db_query']('', '
			SELECT karma_bad, karma_good
			FROM {db_prefix}members
			WHERE id_member = {int:id_member}',
			array(
				'id_member' => (int) $user_info['id'],
			)
		);
		$row = $smcFunc['db_fetch_assoc']($query);
		$smcFunc['db_free_result']($query);
		$saved_karma = $row['karma_good'] - $row['karma_bad'];
	}
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'Karma:' . ((int) $data);
	return ((int) $data) >= $saved_karma;
}

function BBCode_VIVNQ_Replied($data)
{
	global $smcFunc, $user_info, $topic, $context;
	static $topic_checked = array();

	$data = (int) (!empty($data) ? $data : $topic);
	if (empty($data))
		return false;
	if (!isset($topic_checked[$data]))
	{
		$query = $smcFunc['db_query']('', '
			SELECT COUNT(*) AS messages
			FROM {db_prefix}messages
			WHERE id_member = {int:id_member}
				AND id_topic = {int:id_topic}',
			array(
				'id_member' => (int) $user_info['id'],
				'id_topic' => $data,
			)
		);
		$topic_checked[$data] = $smcFunc['db_fetch_assoc']($query);
		$smcFunc['db_free_result']($query);
	}
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'Replied:Y';
	return ($topic_checked[$data]['messages'] > 0);
}

function BBCode_VIVNQ_Warning($data)
{
	global $user_info, $context;

	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'Warning:' . ((int) $data);
	return ((int) $data) >= $user_info['warning'];
}

/**********************************************************************************
* Main Validation functions for our BBcodes
**********************************************************************************/
function BBCode_VIVNQ_Visible(&$tag, &$data, &$disabled)
{
	global $context, $txt;

	if (empty($data))
		return ($tag['content'] = '');
	$valid = false;
	$checks = explode('|', $tag['content']);
	foreach ($checks as $check)
		$valid = $valid || !empty($check);
	$before = $after = $tag['content'] = '';
	$admin = (!empty($context['VIVNQ_Test']) || !empty($user_info['is_admin']) || !empty($user_info['is_mod']));
	if ($admin && isset($_REQUEST['filter']))
	{
		$before = '<div class="quoteheader"></div><blockquote class="' . (!$valid ? 'bbc_invisible_quote' : 'bbc_visible_quote') . '">';
		$after = '</blockquote><div class="quotefooter"><div class="botslice_quote"></div></div>';
	}
	if ($valid || !empty($before))
		$tag['content'] = $before . parse_bbc($data) . $after;
	unset($context['VIVNQ_Filter']);
	$context['VIVNQ_Show'] = ($admin || allowedTo('VIVNQ_toggle_filter'));
}

function BBCode_VIVNQ_Invisible(&$tag, &$data, &$disabled)
{
	global $context, $txt;

	if (empty($data))
		return ($tag['content'] = '');
	$valid = false;
	$checks = explode('|', $tag['content']);
	foreach ($checks as $check)
		$valid = $valid || !empty($check);
	$before = $after = $tag['content'] = '';
	$admin = (!empty($context['VIVNQ_Test']) || !empty($user_info['is_admin']) || !empty($user_info['is_mod']));
	if ($admin && isset($_REQUEST['filter']))
	{
		$before = '<div class="quoteheader"></div><blockquote class="' . ($valid ? 'bbc_invisible_quote' : 'bbc_visible_quote') . '">';
		$after = '</blockquote><div class="quotefooter"><div class="botslice_quote"></div></div>';
	}
	if (!$valid || !empty($before))
		$tag['content'] = $before . parse_bbc($data) . $after;
	unset($context['VIVNQ_Filter']);
	$context['VIVNQ_Show'] = ($admin || allowedTo('VIVNQ_toggle_filter'));
}

/**********************************************************************************
* Additional subfunctions required by our mod
**********************************************************************************/
function BBCode_VIVNQ_AllowedTo(&$message)
{
	global $context;
	
	if (!allowedTo('VIVNQ_use_visible'))
	{
		$pattern = '#\[visible( (.+?)|)\](.+?)\[/visible\]#i' . ($context['utf8'] ? 'u' : '');
		$message = preg_replace($pattern, '$3', $message);
	}
	if (!allowedTo('VIVNQ_use_invisible'))
	{
		$pattern = '#\[invisible( (.+?)|)\](.+?)\[/invisible\]#i' . ($context['utf8'] ? 'u' : '');
		$message = preg_replace($pattern, '$3', $message);
	}
	if (!allowedTo('VIVNQ_use_noquote'))
	{
		$pattern = '#\[noquote( (.+?)|)\](.+?)\[/noquote\]#i' . ($context['utf8'] ? 'u' : '');
		$message = preg_replace($pattern, '$3', $message);
	}
}

function BBCode_VIVNQ_Remove(&$message)
{
	global $context;

	if (!allowedTo('VIVNQ_quote_visible'))
	{
		$pattern = '#\[visible( (.+?)|)\](.+?)\[/visible\]#i' . ($context['utf8'] ? 'u' : '');
		$message = preg_replace($pattern, '', $message);
	}
	if (!allowedTo('VIVNQ_quote_invisible'))
	{
		$pattern = '#\[invisible( (.+?)|)\](.+?)\[/invisible\]#i' . ($context['utf8'] ? 'u' : '');
		$message = preg_replace($pattern, '', $message);
	}
	if (!allowedTo('VIVNQ_quote_noquote'))
	{
		$pattern = '#\[noquote( (.+?)|)\](.+?)\[/noquote\]#i' . ($context['utf8'] ? 'u' : '');
		$message = preg_replace($pattern, '', $message);
	}
}

function BBCode_VIVNQ_Params(&$message, $pos, &$parameters)
{
	$match = substr($message, $pos - 1);
	$match = substr($match, 0, strpos($match, ']'));
	$params = explode(' ', $match);
	unset($params[0]);
	$order = array();
	$replace_str = $old = '';
	foreach ($params as $param)
	{
		if (strpos($param, '=') === false)
			$order[$old] .= ' ' . $param;
		else
			$order[$old = substr($param, 0, strpos($param, '='))] = substr($param, strpos($param, '=') + 1);
	}
	foreach ($parameters as $key => $ignore)
	{
		$replace_str .= (isset($order[$key]) ? ' ' . $key . '=' . $order[$key] : '');
		unset($order[$key]);
	}
	$message = str_replace($match, $replace_str, $message);
	return count($order) == 0;
}

?>