<?php
/**********************************************************************************
* Subs-VIVNQ.php
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
// Mod Hook functions
//=================================================================================
function VIVNQ_LoadTheme()
{
	global $context, $settings, $modSettings;

	// Load the VIVNQ language file & CSS file:
	$context['html_headers'] .= '
	<link rel="stylesheet" type="text/css" href="' . $settings['default_theme_url'] . '/css/BBCode-VIVNQ.css" />';
}

//=================================================================================
// BBCode Hook functions
//=================================================================================
function VIVNQ_Tags(&$bbc)
{
	global $smcFunc;

	// Let's get the parameters for the "visible" and "invisible" bbcodes:
	$parameters = array(
		'u' => array('optional' => true, 'match' => '(\d+|((\d+),?)+)', 'validate' => 'VIVNQ_UserID'),
		'g' => array('optional' => true, 'match' => '(\d+|((\d+),?)+)', 'validate' => 'VIVNQ_GroupID'),
		'min_posts' => array('optional' => true, 'match' => '(\d+)', 'validate' => 'VIVNQ_MinPosts'),
		'max_posts' => array('optional' => true, 'match' => '(\d+)', 'validate' => 'VIVNQ_MaxPosts'),
		'guests' => array('optional' => true, 'match' => '(y|yes|true|1|n|no|false|0)', 'validate' => 'VIVNQ_Guests'),
		'members' => array('optional' => true, 'match' => '(y|yes|true|1|n|no|false|0)', 'validate' => 'VIVNQ_Members'),
		'banned' => array('optional' => true, 'match' => '(y|yes|true|1|n|no|false|0)', 'validate' => 'VIVNQ_Banned'),
		'username' => array('optional' => true, 'quoted' => true, 'validate' => 'VIVNQ_Username'),
		'user' => array('optional' => true, 'quoted' => true, 'validate' => 'VIVNQ_User'),
		'group' => array('optional' => true, 'quoted' => true, 'validate' => 'VIVNQ_Group'),
		'lang' => array('optional' => true, 'quoted' => true, 'validate' => 'VIVNQ_Lang'),
		'karma' => array('optional' => true, 'match' => '(\d+)', 'validate' => 'VIVNQ_Karma'),
		'replied' => array('optional' => true, 'match' => '(\d+)', 'validate' => 'VIVNQ_Replied'),
		'warning' => array('optional' => true, 'match' => '(\d+)', 'validate' => 'VIVNQ_Warning'),
	);

	// Add any usable custom fields to the standard parameters:
	call_integration_hook('integrate_vivnq_params', array(&$parameters));

	// Populate the content keys so that the parser includes the relevant info:
	$keys = '{' . implode('}|{', array_keys($parameters)) . '}';

	// Unserialize the bbcode translation setting into an array:
	$bbcodes = array();
	$unserialize = function_exists('safe_serialize') ? 'safe_unserialize' : 'unserialize';
	if (!empty($modSettings['VIVNQ_shortcuts']))
	{
		if (!is_array($modSettings['VIVNQ_shortcuts']))
			$bbcodes = $unserialize($modSettings['VIVNQ_shortcuts']);
		elseif (is_array($modSettings['VIVNQ_shortcuts']))
			$bbcodes = $modSettings['VIVNQ_shortcuts'];
	}

	// Define "visible", "invisible", "else", "noquote" bbcodes:
	$bbc[] = array(
		'tag' => 'noquote',
		'before' => '',
		'after' => '',
	);
	$bbc[] = array(
		'tag' => 'visible',
		'type' => 'unparsed_content',
		'parameters' => $parameters,
		'validate' => 'VIVNQ_Visible',
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
		'validate' => 'VIVNQ_Invisible',
		'content' => $keys,
		'disabled' => '$1',
	);
	$bbc[] = array(
		'tag' => 'invisible',
		'type' => 'unparsed_content',
		'content' => '',
		'disabled' => '',
	);
	$bbc[] = array(
		'tag' => 'else',
		'type' => 'closed',
		'content' => '',
		'require_parents' => array('invisible', 'visible'),
	);

	// We need to define our "Shortcut" bbcodes in the array:
	$context['VIVNQ_disallowed']['visible'][] = 'visible';
	$context['VIVNQ_disallowed']['invisible'][] = 'invisible';
	foreach ($bbcodes as $tag => $contents)
	{
		$bbc[] = array(
			'tag' => $tag,
			'type' => 'unparsed_content',
			'validate' => 'VIVNQ_Shortcut',
			'content' => '',
			'disabled' => '$1',
			'sc_open' => $contents['open'],
			'sc_close' => $contents['close'],
		);
		$context['VIVNQ_disallowed'][$contents['sc_for']][] = $tag;
	}
}

/**********************************************************************************
* Parameter validation function for our BBcodes
**********************************************************************************/
function VIVNQ_UserID($data)
{
	global $user_info, $context;
	if (empty($data))
		return false;
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'U:' . $data;
	return in_array($user_info['id'], explode(',', $data));
}

function VIVNQ_Lang($data)
{
	global $user_info, $context;
	if (empty($data))
		return false;
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'Lang:' . strtolower($data);
	return in_array(strtolower($user_info['language']), explode(',', strtolower($data)));
}

function VIVNQ_Guests($data)
{
	global $user_info, $context;
	if (empty($data))
		return false;
	$okay = ($data == 'y' || $data == 'yes' || $data == 1 || $data == 'true');
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'Guests:' . (empty($okay) ? 'N' : 'Y');
	return (!empty($user_info['is_guest']) && !empty($okay)) || (empty($user_info['is_guest']) && empty($okay));
}

function VIVNQ_Members($data)
{
	global $user_info, $context;
	if (empty($data))
		return false;
	$okay = ($data == 'y' || $data == 'yes' || $data == 1 || $data == 'true');
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'Members:' . (empty($okay) ? 'N' : 'Y');
	return (empty($user_info['is_guest']) && !empty($okay)) || (!empty($user_info['is_guest']) && empty($okay));
}

function VIVNQ_Banned($data)
{
	global $user_info, $context;
	if (empty($data))
		return false;
	$okay = ($data == 'y' || $data == 'yes' || $data == 1 || $data == 'true');
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'Banned:' . (empty($okay) ? 'N' : 'Y');
	return (empty($user_info['is_banned']) && !empty($okay)) || (!empty($user_info['is_banned']) && empty($okay));
}

function VIVNQ_MinPosts($data)
{
	global $user_info, $context;
	if (empty($data))
		return false;
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'MinPosts:' . ((int) $data);
	return $user_info['posts'] >= (int) $data;
}

function VIVNQ_MaxPosts($data)
{
	global $user_info, $context;
	if (empty($data))
		return false;
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'MaxPosts:' . ((int) $data);
	return $user_info['posts'] <= (int) $data;
}

function VIVNQ_GroupID($data)
{
	global $user_info, $context;
	if (empty($data))
		return false;
	$valid = false;
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'GroupID:' . $data;
	$data = explode(',', $data);
	foreach ($user_info['groups'] as $group)
		$valid = $valid || in_array($group, $data);
	return $valid;
}

function VIVNQ_User($data)
{
	global $user_info, $context;

	if (empty($data))
		return false;
	$valid = false;
	$username = strtolower($user_info['name']);
	$u = $context['utf8'] ? 'u' : '';
	foreach (explode(',', $data) as $check)
	{
		$pattern = '#' . strtolower($check) . '#i' . $u;
		$valid = $valid || preg_match($pattern, $username);
	}
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'User:' . $data;
	return $valid;
}

function VIVNQ_Username($data)
{
	global $user_info, $context;

	if (empty($data))
		return false;
	$valid = false;
	$username = strtolower($user_info['username']);
	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'Username:' . $data;
	$u = $context['utf8'] ? 'u' : '';
	foreach (explode(',', $data) as $check)
	{
		$pattern = '#' . strtolower($check) . '#i' . $u;
		$valid = $valid || preg_match($pattern, $username);
	}
	return $valid;
}

function VIVNQ_Group($data)
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
	$u = $context['utf8'] ? 'u' : '';
	foreach ($user_info['groups'] as $group)
	{
		$group = strtolower($groupIDs[$group]);
		foreach ($data as $check)
		{
			$pattern = '#' . strtolower($check) . '#i' . $u;
			$valid = $valid || preg_match($pattern, $group);
		}
	}
	return $valid;
}

function VIVNQ_Karma($data)
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

function VIVNQ_Replied($data)
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

function VIVNQ_Warning($data)
{
	global $user_info, $context;

	if (!empty($context['VIVNQ_Test']))
		$context['VIVNQ_Filter'][] = 'Warning:' . ((int) $data);
	return ((int) $data) >= $user_info['warning'];
}

/**********************************************************************************
* Main Validation functions for our BBcodes
**********************************************************************************/
function VIVNQ_Shortcut(&$tag, &$data, &$disabled)
{
	if (!empty($tag['sc_open']) && !empty($tag['sc_close']))
		$tag['content'] = parse_bbc($tag['sc_open'] . $data . $tag['sc_close']);
}

function VIVNQ_Visible(&$tag, &$data, &$disabled)
{
	global $context, $txt;

	VIVNQ_Strip($data);
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
	$tmp = explode('[else]', $data, 2);
	if ($valid)
		$tag['content'] = $before . parse_bbc($tmp[0]) . $after;
	elseif (!$valid && !empty($tmp[1]))
		$tag['content'] = $before . parse_bbc($tmp[1]) . $after;
	unset($context['VIVNQ_Filter']);
	$context['VIVNQ_Show'] = $admin || allowedTo('VIVNQ_toggle_filter');
	if ($context['VIVNQ_Show'] && empty($context['VIVNQ_loaded']))
	{
		$context['VIVNQ_loaded'] = true;
		loadLanguage('VIVNQ');
	}
}

function VIVNQ_Invisible(&$tag, &$data, &$disabled)
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
	$tmp = explode('[else]', $data, 2);
	if ($valid)
		$tag['content'] = $before . parse_bbc($tmp[0]) . $after;
	elseif (!$valid && !empty($tmp[1]))
		$tag['content'] = $before . parse_bbc($tmp[1]) . $after;
	unset($context['VIVNQ_Filter']);
	$context['VIVNQ_Show'] = $admin || allowedTo('VIVNQ_toggle_filter');
	if ($context['VIVNQ_Show'] && empty($context['VIVNQ_loaded']))
	{
		$context['VIVNQ_loaded'] = true;
		loadLanguage('VIVNQ');
	}
}

/**********************************************************************************
* Miscellaneous functions for this mod:
**********************************************************************************/
function VIVNQ_Strip(&$message, $perm = false)
{
	global $context;
	if (!$perm || !allowedTo('VIVNQ_' . $perm . '_visible'))
		VIVNQ_Remove_Tags($message, $context['VIVNQ_disallowed']['visible']);
	if (!$perm || !allowedTo('VIVNQ_' . $perm . '_invisible'))
		VIVNQ_Remove_Tags($message, $context['VIVNQ_disallowed']['invisible']);
	if (!$perm || !allowedTo('VIVNQ_' . $perm . '_noquote'))
		VIVNQ_Remove_Tags($message, array('noquote'));
}

function VIVNQ_Remove_Tags(&$message, $tags = array())
{
	global $context;
	$u = $context['utf8'] ? 'u' : '';
	foreach ($tags as $tag)
		$message = preg_replace('#\[' . $tag . '( (.+?)|)\](.+?)\[/' . $tag .'\]#i' . $u, '', $message);
}

function VIVNQ_Params(&$message, $pos, &$parameters)
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