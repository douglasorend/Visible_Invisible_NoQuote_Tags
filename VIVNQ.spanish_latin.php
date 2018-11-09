<?php
/**********************************************************************************
* VIVNQ.spanish_latin.php
***********************************************************************************
* This mod is licensed under the 2-clause BSD License, which can be found here:
*	http://opensource.org/licenses/BSD-2-Clause
***********************************************************************************
* This program is distributed in the hope that it is and will be useful, but      *
* WITHOUT ANY WARRANTIES; without even any implied warranty of MERCHANTABILITY    *
* or FITNESS FOR A PARTICULAR PURPOSE.                                            *
***********************************************************************************
* Spanish translation by Rock Lee (https://www.bombercode.org) Copyright 2014-2018*
***********************************************************************************/
if (!defined('SMF'))
	die('Hacking attempt...');

$txt['VIVNQ_Settings'] = 'Configuraciones VIVNQ';
$txt['VIVNQ_description'] = 'Desde aqu&iacute; puede administrar los accesos directos definidos por el usuario para <strong>visible</strong> y <strong>invisible</strong> bbcodes. Tambi&eacute;n puede controlar qui&eacute;n puede usar los bbcodes definidos por el mod VIVNQ.';
$txt['VIVNQ_shortcuts'] = 'Atajos';
$txt['VIVNQ_new_tag'] = 'Crear nueva etiqueta';

$txt['permissiongroup_VIVNQ'] = $txt['permissiongroup_simple_VIVNQ'] = 'Visible, Invisible y sin cita';
$txt['permissionname_VIVNQ_use_visible'] = 'Permitir el uso del &quot;visible&quot; tag';
$txt['permissionhelp_VIVNQ_use_visible'] = 'Al marcar esta opci&oacute;n, los usuarios de este grupo de miembros pueden usar &quot;visible&quot; bbcode tag para filtrar qui&eacute;n puede ver el mensaje contenido en las etiquetas.<br/><br/>Al desmarcar esta opci&oacute;n, el foro eliminar&aacute; las etiquetas del mensaje antes de enviarlo a la base de datos.';
$txt['permissionname_VIVNQ_quote_visible'] = 'Citar el contenido de &quot;visible&quot; tag';
$txt['permissionhelp_VIVNQ_quote_visible'] = 'Al marcar esta opci&oacute;n, los usuarios de este grupo de miembros pueden citar el &quot;visible&quot; bbcode tag para filtrar qui&eacute;n puede ver el mensaje contenido en las etiquetas.<br/><br/>Al desmarcar esta opci&oacute;n, el foro eliminar&aacute; las etiquetas del mensaje antes de enviarlo a la base de datos.';
$txt['permissionname_VIVNQ_use_invisible'] = 'Permitir el uso de la etiqueta &quot;invisible&quot;';
$txt['permissionhelp_VIVNQ_use_invisible'] = 'Al marcar esta opci&oacute;n, los miembros de este grupo de miembros pueden usar &quot;invisible&quot; bbcode tag para filtrar qui&eacute;n puede ver el mensaje contenido en las etiquetas.<br/><br/>Al desmarcar esta opci&oacute;n, el foro eliminar&aacute; las etiquetas del mensaje antes de enviarlo a la base de datos.';
$txt['permissionname_VIVNQ_quote_invisible'] = 'Citar el contenido de &quot;invisible&quot; tag';
$txt['permissionhelp_VIVNQ_quote_invisible'] = 'Al marcar esta opci&oacute;n, los usuarios de este grupo de miembros pueden citar el &quot;invisible&quot; bbcode tag para filtrar qui&eacute;n puede ver el mensaje contenido en las etiquetas.<br/><br/>Al desmarcar esta opci&oacute;n, el foro eliminar&aacute; las etiquetas del mensaje antes de enviarlo a la base de datos.';
$txt['permissionname_VIVNQ_use_noquote'] = 'Permitir el uso de la &quot;noquote&quot; tag';
$txt['permissionhelp_VIVNQ_use_noquote'] = 'Al marcar esta opci&oacute;n, los miembros de este grupo de miembros pueden usar the &quot;noquote&quot; bbcode tag para filtrar qui&eacute;n puede ver el mensaje contenido en las etiquetas.<br/><br/>Al desmarcar esta opci&oacute;n, el foro eliminar&aacute; las etiquetas del mensaje antes de enviarlo a la base de datos.';
$txt['permissionname_VIVNQ_quote_noquote'] = 'Citar el contenido de &quot;noquote&quot; tag';
$txt['permissionhelp_VIVNQ_quote_noquote'] = 'Al marcar esta opci&oacute;n, los usuarios de este grupo de miembros pueden citar el &quot;innoquote&quot; bbcode tag para filtrar qui&eacute;n puede ver el mensaje contenido en las etiquetas.<br/><br/>Al desmarcar esta opci&oacute;n, el foro eliminar&aacute; las etiquetas del mensaje antes de enviarlo a la base de datos.';
$txt['permissionname_VIVNQ_toggle_filter'] = 'Alternar el filtrado de &quot;visible&quot; &amp; &quot;invisible&quot; tag';
$txt['permissionhelp_VIVNQ_toggle_filter'] = 'De forma predeterminada, solo los administradores, moderadores y el autor original de la publicaci&oacute;n tienen derecho a ver c&oacute;mo el foro procesar&aacute; el contenido no filtrado..<br/><br/>Al marcar esta casilla, el usuario puede ver el contenido de &quot;visible&quot;, &quot;invisible&quot;, y &quot;noquote&quot; etiquetas haciendo clic en el &quot;Filter On&quot; o &quot;Filter Off&quot; botones cerca del &quot;Modificar&quot; y &quot;Citar&quot;.';

$txt['VIVNQ_use_visible'] = 'Puede usar el &quot;visible&quot; tag:';
$txt['VIVNQ_quote_visible'] = 'Puede citar &quot;visible&quot; tag entre comillas:';
$txt['VIVNQ_use_invisible'] = 'Puede usar el &quot;invisible&quot; tag:';
$txt['VIVNQ_quote_invisible'] = 'Puede citar &quot;invisible&quot; tag entre comillas:';
$txt['VIVNQ_use_noquote'] = 'Puede usar el &quot;noquote&quot; tag:';
$txt['VIVNQ_quote_noquote'] = 'Puede citar &quot;noquote&quot; tag entre comillas:';
$txt['VIVNQ_toggle_filter'] = 'Puede ver cuando se establecen las condiciones:';

$txt['VIVNQ_no_shortcuts'] = 'A&uacute;n no se han definido accesos directos.';
$txt['VIVNQ_Tag'] = 'Etiqueta';
$txt['VIVNQ_Replacement'] = 'BBCode Reemplazo';
$txt['VIVNQ_Modify'] = 'Modificar';
$txt['VIVNQ_Confirm'] = '&iquest;Est&aacute;s seguro que quieres eliminar este bbcode? Cualquier uso de este bbcode debe eliminarse manualmente del foro.';
$txt['VIVNQ_Delete'] = 'Borrar';

$txt['VIVNQ_tag'] = 'Atajo BBCode:';
$txt['VIVNQ_which'] = 'Acceso directo para la etiqueta:';
$txt['VIVNQ_params'] = '&iquest;El acceso directo usa qu&eacute; par&aacute;metros?';
$txt['VIVNQ_Param_u'] = 'N&uacute;mero(s) de identificaci&oacute;n de miembro permitidos:';
$txt['VIVNQ_Param_g'] = 'N&uacute;mero(s) de ID de grupo de miembros permitidos:';
$txt['VIVNQ_Param_min_posts'] = 'N&uacute;mero m&iacute;nimo de publicaciones:';
$txt['VIVNQ_Param_max_posts'] = 'N&uacute;mero m&aacute;ximo de publicaciones:';
$txt['VIVNQ_Param_guests'] = '&iquest;El usuario es un invitado?';
$txt['VIVNQ_Param_members'] = '&iquest;El usuario es un miembro?';
$txt['VIVNQ_Param_banned'] = '&iquest;El usuario est&aacute; prohibido?';
$txt['VIVNQ_Param_username'] = 'Nombres de usuario:';
$txt['VIVNQ_Param_user'] = 'Usuario:';
$txt['VIVNQ_Param_group'] = 'Grupos de miembros permitidos:';
$txt['VIVNQ_Param_lang'] = 'Idioma(s):';
$txt['VIVNQ_Param_karma'] = '&iquest;Karma m&iacute;nimo requerido?';
$txt['VIVNQ_Param_replied'] = 'Tema para verificar la respuesta:';
$txt['VIVNQ_Param_warning'] = 'Nivel de advertencia de los miembros:';

?>