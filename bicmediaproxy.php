<?php
// don't cache this page
header("Cache-Control: no-cache");
header("Content-Type: text/xml;charset=UTF-8");

function geturl($url){
  $ch = curl_init($url);

  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);

  $results = curl_exec($ch);
  curl_close($ch);
  return $results;
}

$isbn = urlencode($_REQUEST['isbn']);
$book = urlencode($_REQUEST['book']);
$audio = urlencode($_REQUEST['audio']);
$video = urlencode($_REQUEST['video']);
$size = urlencode($_REQUEST['size']);
$author = urlencode($_REQUEST['author']);
$title = urlencode($_REQUEST['title']);
$publisher = urlencode($_REQUEST['publisher']);

$availableMedia_url = "http://www.bic-media.com/dmrs/availableMedia.do?";
$isInRepository_url = "http://www.bic-media.com/dmrs/mediaInfo.do?";

// ISBN uebergeben, dann check der ISBN
if(!empty($isbn)) {
	$url = $isInRepository_url."identifier=".$isbn;
} else {
	// Keine ISBN, dann Suche
	$url = $availableMedia_url;

	if(!empty($book))
		$url .= "book=".$book;
	else 
		$url .= "book=true";

	if(!empty($audio))
		$url .= "&audio=".$audio;

	if(!empty($video))
		$url .= "&video=".$video;

	if(!empty($size))
		$url .= "&size=".$size;

	if(!empty($author))
		$url .= "&author=".$author;
		
	if(!empty($title))
		$url .= "&title=".$title;

	if(!empty($publisher))
		$url .= "&publisher=".$publisher;	
}

// URL ist fertig, dann abschicken
$v = geturl($url);

echo $v;
?>