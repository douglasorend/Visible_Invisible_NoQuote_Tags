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

$txt['VIVNQ_Filter'] = 'Filter By';
$txt['VIVNQ_Expand'] = 'Filter On';
$txt['VIVNQ_Collapse'] = 'Filter Off';

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

?>