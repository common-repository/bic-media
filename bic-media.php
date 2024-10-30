<?php
/*
Plugin Name: BIC Media Widget
Plugin URI: http://www.bic-media.com/dmr/index.jsp?nav=widget&nav2=wordpressplugin&lang=de
Description: Easy integration of the BIC Media Widget into your blog.
Author: arvato systems GmbH
Version: 1.0
Author URI: http://www.bic-media.com/
*/ 

/*  Copyright 2008  arvato systems GmbH  (email : info@bic-media.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (!class_exists('BICMedia')) {
    class BICMedia	{

		function BICMedia(){$this->__construct();}
		
		function __construct(){
			add_action("init", array(&$this,"add_scripts"));
			
			if ( function_exists( 'add_shortcode' ) ) {
				add_shortcode('bic-media', array(&$this,'bic_media_handler'));
				add_shortcode('bic-carousel', array(&$this,'bic_media_carousel_handler'));
			}
			
			if (strpos($_SERVER['REQUEST_URI'], 'post.php') || strpos($_SERVER['REQUEST_URI'], 'post-new.php') || strpos($_SERVER['REQUEST_URI'], 'page-new.php') || strpos($_SERVER['REQUEST_URI'], 'page.php') || strpos($_SERVER['REQUEST_URI'], 'comment.php')) { 
				add_action('admin_footer', array(&$this,'bm_quicktag'));
				add_action('media_buttons', array(&$this,"media_button_bicm"), 20 );
			}
		
			$BICMedia_locale = get_locale();
			$BICMedia_mofile = dirname(__FILE__) . "/languages/bicmedia-".$BICMedia_locale.".mo";
			load_textdomain("BICMediaWidget", $BICMedia_mofile);

			
		}
		
		function add_scripts(){
			wp_enqueue_script('bic_media_widget_script', 'http://www.bic-media.com/DMRWidget.js');
		}

		function bic_media_handler($atts) {
			extract(shortcode_atts(array(
				'isbn' => 'default',
				'param' => '',
			), $atts));
			
			if ($isbn == 'default') {
				return '';
			} else {
				return "<script type='text/javascript'>try {new DMRWidget('".$isbn."', '".$param."');} catch (e) {}</script>";
			}
		}
		
		function bic_media_carousel_handler($atts) {
			extract(shortcode_atts(array(
				'param' => 'default'
			), $atts));

			if ($param == 'default') {
				return '';
			} else {
				return "<script type='text/javascript'>try {new DMRCarousel(".$param.");} catch (e) {}</script>";
			} 
		}		

		function bm_quicktag() {
			$txt_heading = __('Enter a ISBN-13 number','BICMediaWidget');
			$txt_check = __('Please enter a 13 digit ISBN number without any delimiter','BICMediaWidget');
			$txt_label = __('Add BIC Media Widget','BICMediaWidget'); 

				$bicm_script = <<<SCRIPTEOF
<script type="text/javascript">
	<!--
	if (wpbicmToolbar = document.getElementById('ed_toolbar')) {
		var wpbicmNr, wpbicmBut;
		
		wpbicmNr = edButtons.length;
		edButtons[wpbicmNr] = new edButton('ed_bicm', 'BICM', '', '','',-1);
		
		var wpbicmBut = wpbicmToolbar.lastChild;
		while (wpbicmBut.nodeType != 1) {
			wpbicmBut = wpbicmBut.previousSibling;
		}
		wpbicmBut = wpbicmBut.cloneNode(true);
		wpbicmToolbar.appendChild(wpbicmBut);
		wpbicmBut.value = '$txt_label';
		wpbicmBut.title = '$txt_label';
		wpbicmBut.id = 'ed_bicm';
		wpbicmBut.onclick = function () { edInsertBICM(edCanvas, wpbicmNr)};
		wpbicmBut.open = -1;
	}

	function edInsertBICM(myField, i) {
		var ISBN = prompt('$txt_heading', '');
		if(ISBN.length != 13 || isNaN(ISBN)) {
			alert('$txt_check');
			ISBN = null;
		}
		
		if (ISBN) {
			edButtons[i].tagStart = '[bic-media isbn=\"' + ISBN + '\"]';
			edInsertTag(myField, i);
		}
	}						
	//-->
</script>
SCRIPTEOF;

					echo $bicm_script;
		}

		function media_button_bicm() {
			global $post_ID, $temp_ID;
			$uploading_iframe_ID = (int) (0 == $post_ID ? $temp_ID : $post_ID);
			$media_upload_iframe_src = get_settings('siteurl').__('/wp-content/plugins/bic-media/bicm-media-button.php?','BICMediaWidget');
			$media_title = __('Add BIC Media Widget','BICMediaWidget');
			$image_url = get_settings('siteurl').'/wp-content/plugins/bic-media/images/book.png';
			$out = <<<EOF
			<a href="{$media_upload_iframe_src}&amp;inlineId=mycontentTB_iframe=true&amp;height=730&amp;width=740" class="thickbox" title='$media_title'><img src='$image_url' alt='bic media' /></a>
EOF;
			printf($out);
		}
    }
}

if (class_exists('BICMedia')) {
	$BICMedia = new BICMedia();
}
?>