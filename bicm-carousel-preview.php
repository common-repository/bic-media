<?php
// don't cache this page
header("Cache-Control: no-cache");
header("Content-Type: text/html;charset=UTF-8");

$param = $_REQUEST['param'];

if(empty($param)) {
	$param = "{'width':765, 'height':300, 'client':'Oldenbourg', 'bgcolor':'#B92845', 'size':20, 'coverWidth':170}";
}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"  dir="ltr" lang="en-US">
<head>
<script type='text/javascript' src='http://www.bic-media.com/DMRWidget.js'></script>
</head>
<body style="margin:0 0 0 0; padding: 0 0 0 0;">
<script type='text/javascript'>try {new DMRCarousel(<?php echo str_replace("\\","",$param) ?>);} catch (e) {}</script>
</body>
</html>