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
// BBCode permission hook function
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
// Functions for admin settings
//=================================================================================
function VIVNQ_Areas(&$admin_areas)
{
	global $txt;
	$admin_areas['config']['areas']['vivnq'] = array(
		'label' => 'VIVNQ ' . $txt['settings'],
		'file' => 'Subs-VIVNQ_Admin.php',
		'function' => 'VIVNQ_Settings',
		'icon' => 'modifications.gif',
		'enabled' => false,
	);
}

function VIVNQ_Settings($return_config = false)
{
}

?>