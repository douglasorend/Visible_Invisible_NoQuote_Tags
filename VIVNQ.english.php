<?php
/**********************************************************************************
* VIVNQ.english.php
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

$txt['VIVNQ_Settings'] = 'VIVNQ Settings';
$txt['VIVNQ_description'] = 'From here you can administer the user-defined shortcuts for the <strong>visible</strong> and <strong>invisible</strong> bbcodes.  You can also control who can use the bbcodes defined by the VIVNQ mod.';
$txt['VIVNQ_shortcuts'] = 'Shortcuts';
$txt['VIVNQ_new_tag'] = 'Create New Tag';

$txt['permissiongroup_VIVNQ'] = $txt['permissiongroup_simple_VIVNQ'] = 'Visible, Invisible and NoQuote';
$txt['permissionname_VIVNQ_use_visible'] = 'Allow use of the  &quot;visible&quot; tag';
$txt['permissionhelp_VIVNQ_use_visible'] = 'Checking this option allows members of this membergroup to use the &quot;visible&quot; bbcode tag to filter out who can see the message contained within the tags.<br/><br/>Unchecking this option will cause the forum to remove the tags from the message before committing it to the database.';
$txt['permissionname_VIVNQ_quote_visible'] = 'Quote the contents of &quot;visible&quot; tag';
$txt['permissionhelp_VIVNQ_quote_visible'] = 'Checking this option allows members of this membergroup to quote the &quot;visible&quot; bbcode tag to filter out who can see the message contained within the tags.<br/><br/>Unchecking this option will cause the forum to remove the tags from the message before committing it to the database.';
$txt['permissionname_VIVNQ_use_invisible'] = 'Allow use of the  &quot;invisible&quot; tag';
$txt['permissionhelp_VIVNQ_use_invisible'] = 'Checking this option allows members of this membergroup to use the &quot;invisible&quot; bbcode tag to filter out who can see the message contained within the tags.<br/><br/>Unchecking this option will cause the forum to remove the tags from the message before committing it to the database.';
$txt['permissionname_VIVNQ_quote_invisible'] = 'Quote the contents of &quot;invisible&quot; tag';
$txt['permissionhelp_VIVNQ_quote_invisible'] = 'Checking this option allows members of this membergroup to quote the &quot;invisible&quot; bbcode tag to filter out who can see the message contained within the tags.<br/><br/>Unchecking this option will cause the forum to remove the tags from the message before committing it to the database.';
$txt['permissionname_VIVNQ_use_noquote'] = 'Allow use of the  &quot;noquote&quot; tag';
$txt['permissionhelp_VIVNQ_use_noquote'] = 'Checking this option allows members of this membergroup to use the &quot;noquote&quot; bbcode tag to filter out who can see the message contained within the tags.<br/><br/>Unchecking this option will cause the forum to remove the tags from the message before committing it to the database.';
$txt['permissionname_VIVNQ_quote_noquote'] = 'Quote the contents of &quot;noquote&quot; tag';
$txt['permissionhelp_VIVNQ_quote_noquote'] = 'Checking this option allows members of this membergroup to quote the &quot;innoquote&quot; bbcode tag to filter out who can see the message contained within the tags.<br/><br/>Unchecking this option will cause the forum to remove the tags from the message before committing it to the database.';
$txt['permissionname_VIVNQ_toggle_filter'] = 'Toggle filtering of &quot;visible&quot; &amp; &quot;invisible&quot; tag';
$txt['permissionhelp_VIVNQ_toggle_filter'] = 'By default, only Adminstrators, Moderators and the original post author have the right to see how the unfiltered content would be processed by the forum.<br/><br/>Checking this box allows the user to view the contents of &quot;visible&quot;, &quot;invisible&quot;, and &quot;noquote&quot; tags by clicking on the &quot;Filter On&quot; or &quot;Filter Off&quot; buttons near the &quot;Modify&quot; and &quot;Quote&quot; buttons.';

$txt['VIVNQ_use_visible'] = 'Can use of the  &quot;visible&quot; tag:';
$txt['VIVNQ_quote_visible'] = 'Can quote &quot;visible&quot; tag in quotes:';
$txt['VIVNQ_use_invisible'] = 'Can use of the  &quot;invisible&quot; tag:';
$txt['VIVNQ_quote_invisible'] = 'Can quote &quot;invisible&quot; tag in quotes:';
$txt['VIVNQ_use_noquote'] = 'Can use of the  &quot;noquote&quot; tag:';
$txt['VIVNQ_quote_noquote'] = 'Can quote &quot;noquote&quot; tag in quotes:';
$txt['VIVNQ_toggle_filter'] = 'Can see when conditions are set:';

$txt['VIVNQ_no_shortcuts'] = 'No shortcuts have been defined yet.';
$txt['VIVNQ_Tag'] = 'Tag';
$txt['VIVNQ_Replacement'] = 'BBCode Replacement';
$txt['VIVNQ_Modify'] = 'Modify';
$txt['VIVNQ_Confirm'] = 'Are you sure you want to delete this bbcode?  Any usage of this bbcode must be manually removed from the forum.';
$txt['VIVNQ_Delete'] = 'Delete';

$txt['VIVNQ_tag'] = 'Shortcut BBCode:';
$txt['VIVNQ_which'] = 'Shortcut for which tag:';
$txt['VIVNQ_params'] = 'Shortcut uses which parameters?';
$txt['VIVNQ_Param_u'] = 'Allowed Member ID number(s):';
$txt['VIVNQ_Param_g'] = 'Allowed Membergroup ID number(s):';
$txt['VIVNQ_Param_min_posts'] = 'Minimum number of posts:';
$txt['VIVNQ_Param_max_posts'] = 'Maximum number of posts:';
$txt['VIVNQ_Param_guests'] = 'User is a guest?';
$txt['VIVNQ_Param_members'] = 'User is a member?';
$txt['VIVNQ_Param_banned'] = 'User is banned?';
$txt['VIVNQ_Param_username'] = 'Usernames:';
$txt['VIVNQ_Param_user'] = 'User:';
$txt['VIVNQ_Param_group'] = 'Allowed Membergroups:';
$txt['VIVNQ_Param_lang'] = 'Language(s):';
$txt['VIVNQ_Param_karma'] = 'Minimum karma required?';
$txt['VIVNQ_Param_replied'] = 'Topic to check for reply:';
$txt['VIVNQ_Param_warning'] = 'Member warning level:';

?>