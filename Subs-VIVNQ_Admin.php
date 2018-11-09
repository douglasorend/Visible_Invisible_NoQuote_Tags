<?php
/**********************************************************************************
* Subs-VIVNQ_Admin.php
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
// BBCode permission hooks
//=================================================================================
function VIVNQ_Permissions(&$permissionGroups, &$permissionList, &$leftPermissionGroups, &$hiddenPermissions, &$relabelPermissions)
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

//=================================================================================
// Controller function for mod settings:
//=================================================================================
function VIVNQ_Settings($return_config = false)
{
	global $txt, $modSettings, $scripturl, $context, $options;

	// You have to be able to adminstrate the forum to do this.
	isAllowedTo('admin_forum');

	// These are very likely to come in handy! (i.e. without them we're doomed!)
	require_once($sourcedir . '/ManagePermissions.php');
	require_once($sourcedir . '/ManageServer.php');

	// Split the shortcut setting into an array:
	$context['VIVNQ_shortcuts'] = array();
	$unserialize = function_exists('safe_unserialize') ? 'safe_unserialize' : 'unserialize';
	if (!empty($modSettings['VIVNQ_shortcuts']))
		$context['VIVNQ_shortcuts'] = $unserialize($modSettings['VIVNQ_shortcuts']);
	//$context['VIVNQ_shortcuts']['new_tag'] = array('visible', 'u' => 1);
	//$context['VIVNQ_shortcuts']['tag'] = array('visible', 'u' => 1);

	// Define the sub-actions:
	$subActions = array(
		'shortcuts' => 'VIVNQ_Shortcuts',
		'permissions' => 'VIVNQ_SetPermissions',
		'remove' => 'VIVNQ_Remove',
		'modify' => 'VIVNQ_Modify',
		'newtag' => 'VIVNQ_Modify',
	);

	// Pick the correct sub-action.
	if (isset($_REQUEST['sa']) && isset($subActions[$_REQUEST['sa']]))
		$context['sub_action'] = $_REQUEST['sa'];
	else
		$context['sub_action'] = 'shortcuts';

	// Default page title is good.
	$context['page_title'] = $txt['VIVNQ_Settings'];

	// This uses admin tabs - as it should!
	$context[$context['admin_menu_name']]['tab_data'] = array(
		'title' => $txt['VIVNQ_Settings'],
		'description' => $txt['VIVNQ_description'],
	);

	// Finally fall through to what we are doing.
	$subActions[$context['sub_action']]();
}

//=================================================================================
// Function for displaying this mod's permissions on one screen:
//=================================================================================
function VIVNQ_SetPermissions($return_config = false)
{
	global $txt, $context, $modSettings, $sourcedir, $scripturl;

	// You have to be able to adminstrate the forum to do this.
	isAllowedTo('admin_forum');

	$config_vars = array(
		array('permissions', 'VIVNQ_use_visible'),
		array('permissions', 'VIVNQ_quote_visible'),
		array('permissions', 'VIVNQ_use_invisible'),
		array('permissions', 'VIVNQ_quote_invisible'),
		array('permissions', 'VIVNQ_use_noquote'),
		array('permissions', 'VIVNQ_quote_noquote'),
		array('permissions', 'VIVNQ_toggle_filter'),
	);

	// Saving settings?
	if (isset($_GET['save']))
	{
		checkSession();
		saveDBSettings($config_vars);
		redirectexit('action=admin;area=vivnq;sa=permissions');
	}
	$context['post_url'] = $scripturl . '?action=admin;area=vivnq;sa=permissions;save';
	$context['sub_template'] = 'show_settings';
	prepareDBSettingContext($config_vars);
}

//=================================================================================
// Function for browsing user-defined shortcuts:
//=================================================================================
function VIVNQ_Shortcuts($return_config = false)
{
	global $txt, $context, $modSettings, $sourcedir, $scripturl;

	// You have to be able to adminstrate the forum to do this.
	isAllowedTo('admin_forum');

	// Build the array required for "createList" function:
	$list_options = array(
		'id' => 'list_shortcuts',
		'title' => $txt['CustomBBCode_List_Title'],
		'items_per_page' => 30,
		'base_href' => $scripturl . '?action=admin;area=' . $_GET['area'] . ';sa=custombbc',
		'default_sort_col' => 'tag',
		'get_items' => array(
			'function' => 'VIVNQ_get_data',
		),
		'get_count' => array(
			'function' => 'VIVNQ_get_count',
		),
		'no_items_label' => $txt['VIVNQ_no_shortcuts'],
		'columns' => array(
			'tag' => array(
				'header' => array(
					'value' => $txt['VIVNQ_Tag'],
				),
				'data' => array(
					'db' => 'tag',
					'style' => 'width: 10%; text-align: center;',
				),
				'sort' =>  array(
					'default' => 'tag',
					'reverse' => 'tag DESC',
				),
			),
			'replacement' => array(
				'header' => array(
					'value' => $txt['VIVNQ_Replacement'],
				),
				'data' => array(
					'db' => 'replace',
					'style' => 'width: 70%;',
				),
			),
			'actions' => array(
				'header' => array(
					'value' => $txt['List_actions'],
				),
				'data' => array(
					'function' => 'VIVNQ_get_actions',
					'style' => 'width: 20%; text-align: center;',
				),
			),
		),
	);

	// Let's build the list now:
	$context['page_title'] = $txt['VIVNQ_shortcuts'];
	$context['sub_template'] = 'VIVNQ_shortcuts';
	require_once($sourcedir . '/Subs-List.php');
	createList($list_options);
}

function VIVNQ_get_count()
{
	global $context;
	return count($context['VIVNQ_shortcuts']);
}

function VIVNQ_get_data($start, $items_per_page, $sort)
{
	global $context;
	isAllowedTo('admin_forum');

	// Sort the list of bbcode shortcuts:
	$sort_func = ($sort == 'tag' ? 'ksort' : 'krsort');
	$sort_func($context['VIVNQ_shortcuts']);

	// Find the entries we are looking for:
	foreach ($context['VIVNQ_shortcuts'] as $tag => $params)
	{
		$start--;
		if ($start > 0)
			continue;
		if ($items_per_page == 0)
			break;
		$items_per_page--;

		// Build the replacement string:
		$return[] = array(
			'tag' => $tag,
			'replace' => '[' . VIVNQ_build_replacement($params) . ']',
		);
	}
	return $return;
}

function VIVNQ_get_actions($row)
{
	global $scripturl, $txt, $context;
	return '<a href="' . $scripturl . '?action=admin;area=vivnq;sa=modify;tag=' . $row['tag'] . ';' . $context['session_var'] . '=' . $context['session_id'] . '" class="button">' . $txt['VIVNQ_Modify'] . '</a>&nbsp;&nbsp;' .
		'<a href="' . $scripturl . '?action=admin;area=vivnq;sa=remove;tag=' . $row['tag'] . ';' . $context['session_var'] . '=' . $context['session_id'] . '" onclick="return confirm(\'' . $txt['VIVNQ_Confirm'] . '\');" class="button">' . $txt['VIVNQ_Delete'] . '</a>';
}

function template_VIVNQ_shortcuts()
{
	template_show_list('list_shortcuts');
}

//=================================================================================
// Function for removing user-defined shortcuts:
//=================================================================================
function VIVNQ_Remove()
{
	global $context;

	// Error out if the tag is invalid:
	checkSession('get');
	$tag = isset($_REQUEST['tag']) ? $_REQUEST['tag'] : false;
	if (!isset($context['VIVNQ_shortcuts'][$tag]))
		fatal_lang_error('VIVNQ_not_defined', false);

	// Remove the bbcode requested:
	unset($context['VIVNQ_shortcuts'][$tag]);
	VIVNQ_Commit($context['VIVNQ_shortcuts']);
}

function VIVNQ_Commit(&$array)
{
	// You have to be able to adminstrate the forum to do this!
	isAllowedTo('admin_forum');

	// Serialize the existing bbcode shortcut array:
	$serialize = function_exists('safe_serialize') ? 'safe_serialize' : 'serialize';
	$_POST['VIVNQ_shortcuts'] = $serialize($array);

	// Commit our changed shortcut list to the database!
	$config_vars = array(
		array('text', 'VIVNQ_shortcuts'),
	);
	saveDBSettings($config_vars);

	// Go back to browse the shortcuts:
	redirectexit('action=admin;area=vivnq;sa=shortcuts');
}

//=================================================================================
// Function for creating/editing user-defined shortcuts:
//=================================================================================
function VIVNQ_Modify($return_config = false)
{
	global $txt, $context, $modSettings, $sourcedir, $scripturl;

	// You have to be able to adminstrate the forum to do this.
	isAllowedTo('admin_forum');

	// Which tag are we dealing with?
	$bbcode = array();
	$modSettings['VIVNQ_tag'] = isset($_REQUEST['tag']) ? $_REQUEST['tag'] : '';
	if (isset($context['VIVNQ_shortcuts'][$modSettings['VIVNQ_tag']]))
		$bbcode = &$context['VIVNQ_shortcuts'][$modSettings['VIVNQ_tag']];
	$modSettings['VIVNQ_which'] = !empty($bbcode[0]) ? $bbcode[0] : 'visible';

	// Start defining our UI for this:
	$config_vars = array(
		array('text', 'VIVNQ_tag'),
		array('select', 'VIVNQ_which', array('visible' => 'visible', 'invisible' => 'invisible')),
		array('title', 'VIVNQ_params'),
	);

	// Populate the settings for this shortcut bbcode:
	foreach (VIVNQ_get_params() as $param => $details)
	{
		$n = 'VIVNQ_Check_' . $param;
		$modSettings[$p = 'VIVNQ_Param_' . $param] = isset($bbcode[$param]) ? $bbcode[$param] : '';
		$txt[$p] = '<input type="checkbox" name="' . $n . '" value="1" id="' . $n . '"' . (!empty($modSettings[$p]) ? ' checked="checked"' : '') . ' class="input_check" />&nbsp;' . $txt[$p];
		$func = isset($details['admin']) ? 'VIVNQ_UI_' . $details['admin'] : false;
		$config_vars[$param] = function_exists($func) ? $func($param) : array('text', $p);
	}

	// Saving settings?
	if (isset($_GET['save']))
	{
		checkSession();
		redirectexit('action=admin;area=vivnq');
	}
	$context['post_url'] = $scripturl . '?action=admin;area=vivnq;sa=' . $_REQUEST['sa'] . ';tag=' . $tag . ';save';
	$context['sub_template'] = 'show_settings';
	prepareDBSettingContext($config_vars);
}

function VIVNQ_UI_checkbox($param)
{
	return array('check', 'VIVNQ_Param_' . $param);
}

function VIVNQ_UI_membergroup($param)
{
	global $modSettings;
	$modSettings['VIVNQ_Param_group'] = explode(',', $modSettings['VIVNQ_Param_group']);
	return array('callback', 'VIVNQ_UI_membergroup');
}

function template_callback_VIVNQ_UI_membergroup($param)
{
	global $sourcedir, $txt, $modSettings;

	require_once($sourcedir . '/Subs-Membergroups.php');
	echo '
					<dt>
						<a id="setting_VIVNQ_Param_group"></a><span><label for="VIVNQ_Param_group">', $txt['VIVNQ_Param_group'], '</label></span>
					</dt>
					<dd>
						<input type="checkbox" name="VIVNQ_Param_group[-1]" value="1" id="VIVNQ_Param_group[-1]"' . (!empty($modSettings[$p]) ? ' checked="checked"' : '') . ' class="input_check" />', $txt['membergroups_guests'], '<br />
						<input type="checkbox" name="VIVNQ_Param_group[0]" value="1" id="VIVNQ_Param_group[0]"' . (!empty($modSettings[$p]) ? ' checked="checked"' : '') . ' class="input_check" />', $txt['membergroups_members'], '<br />';
	foreach (list_getMembergroups(0, 1000000, 'id_group', '') as $group)
		echo '
						<input type="checkbox" name="VIVNQ_Param_group[', $group['id_group'], ']" value="1" id="VIVNQ_Param_group[', $group['id_group'], ']"' . (in_array($group['id_group'], $modSettings['VIVNQ_Param_group']) ? ' checked="checked"' : '') . ' class="input_check" />', $group['group_name'], '<br />';
	echo '
					</dd>';
	
}

?>