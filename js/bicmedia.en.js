var j = jQuery.noConflict();

j(document).ready(function() {
	j("#searchbutton").click(function() { doBICMSearch(); });
	j("#result > ul").tabs();

	j.tablesorter.defaults.widgets = ['zebra']; 
	j.tablesorter.defaults.headers = { 3: { sorter: false }}; 
	j("#bookresults").tablesorter();
	j("#audioresults").tablesorter();
	
	j("#bicm-search").bind("keypress", function(event) {
		if(event.keyCode == 13) {
			doBICMSearch();
		}
	});	

 });

function doBICMSearch() {
	// Tabellen zur&uuml;cksetzen
	resetTables();
	
	// Parameter auslesen
	var params = new Object();
	
	var valchecked = j("#bicm-search input[type='checkbox']:checked");
	var checkedparams = new Array();
	
	var valunchecked = j("#bicm-search [type='checkbox']:not(:checked)");
	var uncheckedparams = new Array();
		
	j(valchecked).each(function(i, val) {
		params[val.name] = "true";
	});
	
	j(valunchecked).each(function(i, val) {
		params[val.name] = "false";
	});		
	

	searchsize = j("#bicm-search input[name='size']").val();
	if(searchsize != "" && !isNaN(searchsize)) {
		params['size'] = searchsize;
	}

	searchtitle = j("#bicm-search input[name='title']").val();
	if(searchtitle != "") {
		params['title'] = searchtitle;
	}		

	searchauthor = j("#bicm-search input[name='author']").val();
	if(searchauthor != "") {
		params['author'] = searchauthor;
	}			
	
	searchpublisher = j("#bicm-search select[name='publisher'] option:selected").text();
	if(j("#bicm-search select[name='publisher'] option:selected").val() != "") {
			params['publisher'] = searchpublisher;
	}
	
	searchisbn = j("#bicm-search input[name='isbn']").val();
	if(searchisbn != "") {
		var isbnfilter = /\D/g;

		filteredisbn = searchisbn.replace(isbnfilter, '');
		// Für die Optik Wert aktualisieren
		j("#bicm-search input[name='isbn']").val(filteredisbn);
		params['isbn'] = filteredisbn;
	}			


	if(
		(params['isbn'] == "" || params['isbn'] == undefined) && 
			((j("#bicm-search select[name='publisher'] option:selected").val() == "" || j("#bicm-search select[name='publisher'] option:selected").val() == undefined) && 
			(params['author'] == "" || params['author'] == undefined) && 
			(params['title'] == "" || params['title'] == undefined) )
		) {
		j("#message").html("Enter at least an ISBN number or title, author or publisher.");
		return false;
	} 
	
	// Normale Suche oder ISBN Suche
	if(params['isbn'] == "" || params['isbn'] == undefined) {
		doAJAXSearchRequest(params);
	} else {
		doAJAXISDNSearchRequest(params);
	}
}

function doAJAXSearchRequest(value) {
	j("#message").html("Searching");

	j.ajax({
		type:"GET",
		url:"bicmediaproxy.php",
		processData:true,
		data: value,
		success: parseResult, 
		error:function(xhr,err,e){ alert( "Error: " + err )},
		dataType: "xml"
	}); 
}

function doAJAXISDNSearchRequest(value) {
	j("#message").html("Searching");

	j.ajax({
		type:"GET",
		url:"bicmediaproxy.php",
		processData:true,
		data: value,
		success: parseResultISBN, 
		error:function(xhr,err,e){ alert( "Error: " + err )},
		dataType: "xml"
	}); 
}	

function parseResult(data, textStatus) {
	fehler = j(data).find("error").text();

	if(fehler.length != 0) {
		j("#message").html("<b style='color:red'>An error occured <br />"+fehler+"</b>");
		return false;
	} 
	else if (j(data).find("book").length == 0 && j(data).find("audio").length == 0) {
		j("#message").html("No results found");
		return false;
	} else {
		j("#message").html("Search successful");
	
		j("book",data).each(function(i, val) {fillTable("book", val)});
		j(data).find("audio").each(function(i, val) {fillTable("audio", val)});

		if (j(data).find("book").length != 0) {
			updateTableSorting("#bookresults");
		} 
		if (j(data).find("audio").length != 0) {
			updateTableSorting("#audioresults");
		}
		
		return false;
	}
}

function parseResultISBN(data, textStatus) {
	fehler = j(data).find("error").text();
	if(fehler.length != 0) {
		j("#message").html("<b style='color:red'>An error occured <br />"+fehler+"</b>");
		return false;
	} else {
		j("#message").html("Search successful");
	
		var media = j(data).find("media");
		
		var mediatype = j(media).attr('type');
		var author = j(media).attr('artist');
		var isbn = j(media).attr('isbn');
		var title = j(media).attr('title');
		var auswahl = j("<a></a>").html("Select").click(function () { insertResultTag(isbn); }).css("cursor","pointer");
			
		fillTableRow(mediatype, title, author, isbn, auswahl);

		if (mediatype == "book") {
			updateTableSorting("#bookresults");
		} 
		if (mediatype == "audio") {
			updateTableSorting("#audioresults");
		}
		
		return false;
	}
}

function updateTableSorting(target) {
		var sorting = [[0,0]]; 

		j(target).trigger("update");
		j(target).trigger("sorton",[sorting]);			
}

function fillTable(target, data) {
	var title = j(data).attr('title');
	var author = j(data).attr('author');
	var isbn = j(data).attr('isbn');
	var auswahl = j("<a></a>").html("Select").click(function () { insertResultTag(isbn); }).css("cursor","pointer");

	fillTableRow(target, title, author, isbn, auswahl);
}	

function fillTableRow(target, title, author, isbn, auswahl) {

	if(author === undefined) author = " ";
	if(title === undefined) title = " ";
			
	var newrow = j("<tr></tr>");
		
	j(newrow).append(j("<td></td>").html(title));
	j(newrow).append(j("<td></td>").html(author));
	j(newrow).append(j("<td></td>").html(isbn));
	j(newrow).append(j("<td></td>").html(auswahl));
			
	j("#"+target+"results tbody").append(newrow);
}	



function insertResultTag(isbn) {
	var params = new Object();

	widgetwidth = j("#bicm-search-param input[name='widget-width']").val();
	if(widgetwidth != "" && !isNaN(widgetwidth)) {
		params['widget-width'] = widgetwidth;
	} else {
		params['widget-width'] = 200;
	}		

	widgetheight = j("#bicm-search-param input[name='widget-height']").val();
	if(widgetheight != "" && !isNaN(widgetheight)) {
		params['widget-height'] = widgetheight;
	} else {
		params['widget-height'] = 400;
	}		

	widgetbuyurl = j("#bicm-search-param > input[name='widget-buyurl']").val();
	if(widgetbuyurl != "") {
		params['widget-buyurl'] = widgetbuyurl;
	}			

	// Parameterstring ermitteln
	var widgetparams = "";
	
	// Standardparameter nicht &uuml;bergeben
	if(params['widget-width'] != 200 || params['widget-height'] != 400) {
		widgetparams = "width="+params['widget-width']+",height="+params['widget-height'];
	}

	if(params['widget-buyurl'] != "" && params['widget-buyurl'] != undefined) {
		if(widgetparams != "") 
			widgetparams = widgetparams + ",";

		widgetparams = widgetparams + "buyUrl="+params['widget-buyurl'];
	}
	
	var bicmtag = "";
	if(widgetparams != "") {
		bicmtag = "[bic-media isbn=\""+isbn+"\" param=\""+widgetparams+"\"]";
	} else {
		bicmtag = "[bic-media isbn=\""+isbn+"\"]";
	}
	
	send_to_editor(bicmtag);

}

function resetTables() {
	j("#bookresults tr:not(:first)").remove();
	j("#audioresults tr:not(:first)").remove();
}

function send_to_editor(html) {
	parent.send_to_editor(html);
	parent.tb_remove();
}