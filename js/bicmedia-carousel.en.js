var j = jQuery.noConflict();
// Parameter auslesen
var params = new Object();
	
/*
9783570303955,
 9783442369010,
 9783442361052,
9783453432161,
9783570215821
*/	
	
j(document).ready(function() {
	j("#previewbutton").click(function() { doCarouselPreview(); });
	j("#okbutton").click(function() { insertResultTag(); });

	j("#bicm-carousel-search-param").bind("keypress", function(event) {
		if(event.keyCode == 13) {
			doCarouselPreview();
		}
	});	
 });

function getParameters() {
	searchsize = j("#bicm-carousel-search-param input[name='size']").val();
	if(searchsize != "" && !isNaN(searchsize) && searchsize > 0) {
		params['size'] = searchsize;
	} else {
		params['size'] = 20;
		j("#bicm-carousel-search-param input[name='size']").val("20");
	}

	searchtitle = j("#bicm-carousel-search-param input[name='title']").val();
	if(searchtitle != "") {
		params['title'] = searchtitle;
	}		

	searchauthor = j("#bicm-carousel-search-param input[name='author']").val();
	if(searchauthor != "") {
		params['author'] = searchauthor;
	}			
	
	searchpublisher = j("#bicm-carousel-search-param select[name='publisher'] option:selected").text();
	if(j("#bicm-carousel-search-param select[name='publisher'] option:selected").val() != "") {
			params['publisher'] = searchpublisher;
	}

	widgetwidth = j("#bicm-carousel-search-param input[name='widget-width']").val();
	if(widgetwidth != "" && !isNaN(widgetwidth) && widgetwidth > 0) {
		params['widget-width'] = widgetwidth;
	} else {
		params['widget-width'] = 760;
		j("#bicm-carousel-search-param input[name='widget-width']").val("760");	
	}	

	widgetheight = j("#bicm-carousel-search-param input[name='widget-height']").val();
	if(widgetheight != "" && !isNaN(widgetheight) && widgetheight > 0) {
		params['widget-height'] = widgetheight;
	} else {
		params['widget-height'] = 300;
		j("#bicm-carousel-search-param input[name='widget-height']").val("300");
	}	

	widgetbgcolor = j("#bicm-carousel-search-param input[name='widget-bgcolor']").val();
	if(widgetbgcolor != "") {
		params['widget-bgcolor'] = widgetbgcolor;
	}			
	
	widgetcoverwidth = j("#bicm-carousel-search-param input[name='widget-cover-width']").val();
	if(widgetcoverwidth != "" && !isNaN(widgetcoverwidth) && widgetcoverwidth > 0) {
		params['widget-cover-width'] = widgetcoverwidth;
	} else {
		params['widget-cover-width'] = 170;
		j("#bicm-carousel-search-param input[name='widget-cover-width']").val("170");
	}	

	
	searchisbns = j("#bicm-carousel-search-param textarea[name='isbns']").val();
	if(searchisbns != "") {
		var isbnfilter = /\D/g;

		// ISBN Nummern filtern	
		var isbns = searchisbns.split(",");
		var filteredisbns = new Array();
		
		for(var i=0;i < isbns.length; i++) {
			// Sonderzeichen usw. entfernen
			var tmp = isbns[i].replace(isbnfilter,'');
			
			// Noch was übrig?
			if(tmp != "") {
				filteredisbns.push(tmp);
			}
			tmp = "";
		}

		var freshisbns = "";
		
		// Kommas einfügen
		for(var i=0;i < filteredisbns.length; i++) {
			freshisbns += filteredisbns[i]+",";
		}
		
			// letztes Komma entfernen
		freshisbns = removeTrailingComma(freshisbns);
		
		// Für die Optik Wert aktualisieren
		j("#bicm-carousel-search-param textarea[name='isbns']").val(freshisbns);

		params['isbns'] = freshisbns;
	}			

} 


function doCarouselPreview() {
	// Params Reset
	params = new Object();
	
	// Formularfelder auslesen
	getParameters();
	
	// Parameter String ermitteln
	var parameter = "";
	parameter = buildParameterString();
	
	j("#carouselpreview iframe").attr("src","bicm-carousel-preview.php?param="+encodeURIComponent(parameter));
}

function buildParameterString() {
	var parameter = "";

	// Anfang
	parameter = '{ ';
	
	if(params['isbns'] != "" && params['isbns'] !== undefined) {
		parameter += '\'isbns\':\''+params['isbns']+'\',';
	} 

	if(params['size'] != "" && params['size'] !== undefined) {
		parameter += '\'size\':'+params['size']+',';
	} 	
	
	if(params['title'] != "" && params['title'] !== undefined) {
		parameter += '\'title\':\''+params['title']+'\',';
	} 	

	if(params['author'] != "" && params['author'] !== undefined) {
		parameter += '\'author\':\''+params['author']+'\',';
	}	
	
	if(params['publisher'] != "" && params['publisher'] !== undefined) {
		parameter += '\'publisher\':\''+params['publisher']+'\',';
	}		
	
	if(params['widget-height'] != "" && params['widget-height'] !== undefined) {
		parameter += '\'height\':'+params['widget-height']+',';
	}	

	if(params['widget-width'] != "" && params['widget-width'] !== undefined) {
		parameter += '\'width\':'+params['widget-width']+',';
	}	

	if(params['widget-cover-width'] != "" && params['widget-cover-width'] !== undefined) {
		parameter += '\'coverWidth\':'+params['widget-cover-width']+',';
	}	

	if(params['widget-bgcolor'] != "" && params['widget-bgcolor'] !== undefined) {
		if(params['widget-bgcolor'].substring(0,1) != "#") {		
			parameter += '\'bgcolor\':\'\#'+params['widget-bgcolor']+'\',';
			j("#bicm-carousel-search-param input[name='widget-bgcolor']").val('#'+params['widget-bgcolor']);
		} else { 
			parameter += '\'bgcolor\':\''+params['widget-bgcolor']+'\',';	
		}
	}		
	
	// letztes Komma entfernen
	parameter = removeTrailingComma(parameter);
	
	// Ende
	parameter += ' }';

	return parameter;
}

function removeTrailingComma(text) {
	// letztes Komma entfernen
	if(text.substring((text.length-1),text.length) == ",") {
		var tmp = text.substr(0,(text.length-1));
		text = tmp;
	}
	
	return text;
}

function insertResultTag(isbn) {
	// Parameterstring ermitteln
	var widgetparams = "";
	var bicmtag = "";

	widgetparams = buildParameterString();
	bicmtag = "[bic-carousel param=\""+widgetparams+"\"]";

	send_to_editor(bicmtag);

}

function send_to_editor(html) {
	parent.send_to_editor(html);
	parent.tb_remove();
}