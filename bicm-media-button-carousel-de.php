<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  dir="ltr" lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Wordpress BIC Media Widget Plugin</title>
<link rel='stylesheet' href='../../../wp-admin/css/global.css?version=2.5' type='text/css' />
<link rel='stylesheet' href='../../../wp-admin/wp-admin.css?version=2.5' type='text/css' />
<link rel='stylesheet' href='../../../wp-admin/css/media.css?version=2.5' type='text/css' />
<link rel='stylesheet' href='../../../wp-admin/css/colors-classic.css?version=2.5' type='text/css' />
<!--[if gte IE 6]>
<link rel='stylesheet' href='../../../wp-admin/css/ie.css?version=2.5' type='text/css' />
<![endif]-->
<link rel='stylesheet' href='css/styles.css' type='text/css' />
<script type='text/javascript' src='../../../wp-includes/js/jquery/jquery.js?ver=1.2.3'></script>
<script type="text/javascript"src='js/bicmedia-carousel.en.min.js'></script>
<script type='text/javascript' src='http://www.bic-media.com/DMRWidget.js'></script>  
</head>

<body id="media-upload">

<div id="media-upload-header">
	<ul id='sidemenu'>
		<li id='tab-type'><a href='bicm-media-button-de.php'>Buch/H&ouml;rbuch suchen</a></li>
		<li id='tab-type'><a href='bicm-media-button-carousel-de.php' class='current'>Karussell Widget</a></li>
	</ul>
</div>

<form name="bicm-carousel-search-param" id="bicm-carousel-search-param" action="">
<fieldset>
<legend>Widgetparameter</legend>
<table width="100%">
<tr>
<td width="50%" valign="top">
	<table class="describe" style="border-top: none; padding-bottom: 0"><tbody>
		<tr>
			<th valign="top" scope="row" class="label">
				<span class="alignleft"><label>ISBN Nummern</label><br/> (getrennt durch Kommas)</span>
			</th>
			<td class="field"><textarea name="isbns" cols="50" rows="5" style="width: 200px"></textarea></td>
		</tr>
		<tr>
			
			<td colspan="2"><p style="text-align:center">&mdash; ODER &mdash;</p></td>
		</tr>

		<tr>
			<th valign="top" scope="row" class="label">
				<span class="alignleft"><label>Titel</label></span>
			</th>
			<td class="field"><input type="text" size="25" maxlength="255" name="title" style="width: 200px" /></td>
		</tr>	
		<tr>
			<th valign="top" scope="row" class="label">
				<span class="alignleft"><label>Autor</label></span>
			</th>
			<td class="field"><input type="text" size="25" maxlength="255" name="author" style="width: 200px;" /></td>
		</tr>
		<tr>
			<th valign="top" scope="row" class="label">
				<span class="alignleft"><label>Verlag</label></span>
			</th>
			<td class="field"><select id="publisher" name="publisher" style="width: 200px;">
<option value="">W&auml;hlen Sie einen Verlag</option>
<option value="13">Albrecht Knaus Verlag</option>
<option value="40">Ansata</option>
<option value="9">Audionauten</option>
<option value="6">Bassermann Verlag</option>
<option value="29">Blanvalet Taschenbuch Verlag</option>
<option value="7">Blanvalet Verlag</option>
<option value="65">BOARDSTEIN</option>
<option value="41">btb Verlag</option>
<option value="11">C. B. Jugendbuch</option>
<option value="2">C. Bertelsmann Verlag</option>
<option value="10">cbj</option>
<option value="31">cbt</option>
<option value="16">Deutsche Verlags-Anstalt</option>
<option value="8">Diana Verlag</option>
<option value="61">Eberhard Blottner Verlag</option>
<option value="25">Elefanten Press</option>
<option value="5">Goldmann Verlag</option>
<option value="3">Heyne Verlag</option>
<option value="43">Integral</option>
<option value="15">Karl Blessing Verlag</option>
<option value="22">K&ouml;sel-Verlag</option>
<option value="30">Limes Verlag</option>
<option value="42">Lotos</option>
<option value="26">Luchterhand Literaturverlag</option>
<option value="23">Ludwig bei Heyne</option>
<option value="14">Manesse</option>
<option value="35">Manhattan</option>
<option value="58">Oldenbourg Akademieverlag</option>
<option value="57">Oldenbourg Wissenschaftsverlag</option>
<option value="18">Omnibus HC</option>
<option value="27">Omnibus TB</option>
<option value="28">Page &amp; Turner</option>
<option value="37">Pantheon Verlag</option>
<option value="36">Pavillon</option>
<option value="4">Random House Audio</option>
<option value="20">Random House Audio Editionen</option>
<option value="34">Riemann Verlag</option>
<option value="39">Sammlung Luchterhand</option>
<option value="19">Siedler Verlag</option>
<option value="48">S&uuml;dwest</option>
<option value="17">S&uuml;dwest Verlag</option>
<option value="62">Verlagsgesellschaft Rudolf M&uuml;ller</option>
</select></td>
		</tr>
	
	</tbody></table>

</td>

<td width="50%" valign="top">


	<table class="describe" style="border-top: none"><tbody>
		<tr>
			<th valign="top" scope="row" class="label">
				<span class="alignleft"><label>Breite</label></span>
			</th>
			<td class="field"><input type="text" size="3" maxlength="3" name="widget-width" value="760" style="width: 200px" /></td>
		</tr>
		<tr>
			<th valign="top" scope="row" class="label">
				<span class="alignleft"><label>H&ouml;he</label></span>
			</th>
			<td class="field"><input type="text" size="3" maxlength="3" name="widget-height" value="300" style="width: 200px" /></td>
		</tr>
		<tr>
			<th valign="top" scope="row" class="label">
				<span class="alignleft"><label>Hintergrundfarbe</label></span>
			</th>
			<td class="field"><input type="text" size="25" maxlength="7" name="widget-bgcolor" style="width: 200px" /></td>
		</tr>	
		<tr>
			<th valign="top" scope="row" class="label">
				<span class="alignleft"><label>Cover Breite</label></span>
			</th>
			<td class="field"><input type="text" size="25" maxlength="6" name="widget-cover-width" value="170" style="width: 200px" /></td>
		</tr>			
		<tr>
			<th valign="top" scope="row" class="label">
				<span class="alignleft"><label>Max. Anzahl Eintr&auml;ge</label></span>
			</th>
			<td class="field"><input type="text" size="3" maxlength="3" name="size" value="20" style="width: 200px;" /></td>
		</tr>		
	</tbody></table>

	<div class="media-blank">
		<p style="text-align:center">
			<input type="reset" class="button" value="Formular zur&uuml;cksetzen" /> &nbsp; 
			<input type="button" class="button" id="previewbutton" value="Vorschau" /> &nbsp; 
			<input type="button" class="button" id="okbutton" value="OK" />
		</p>
	</div>
</td>
</tr>
</table>
</fieldset>
</form>

<div id="media-upload-header">
	<ul id='sidemenu'>
		<li id='tab-type'><a href='#' class='current'>Vorschau</a></li>
	</ul>
</div>

<div id="carouselpreview">
<iframe src="bicm-carousel-preview.php" width="760" height="340" />
</div>
</body>
</html>
