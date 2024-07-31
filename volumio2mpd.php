#!/usr/bin/php
<?php
define("__DEBUG__", true );

date_default_timezone_set('Europe/London');

include_once("PHP-MPD/mpd.class.php");
include_once("debug.php");

$buck = "";
$in_path = __DIR__;

if( file_exists("local.php") ){
	include_once("local.php");
}

debug("buck: $buck");
debug("in_path: $in_path");

// these should be setup already
// the password might need to be setup in the calling script
//
$host = getenv("MPD_HOST");
$port = getenv("MPD_PORT");
$pass = getenv("MPD_PASS");

if( !$host ) $host = "localhost";
if( !$port ) $port = "6600";
if( !$pass ) $pass = "";

debug( "host: $host, port: $port, pass: $pass");

$mpd = new MPD($host, (int) $port, $pass);
$hmm = $mpd->mpd($host, (int) $port, $pass);

var_dump( $mpd->get_error() );
echo "Done\n";

if( $hmm === true ){
	debug("We're in!");
	
	$d = dir( $in_path );

	while (false !== ($entry = $d->read())) {
		if( $entry != "." && $entry != ".." ){
			debug("list: $entry");
			Convert( $in_path, $entry );
		}
	}
	$d->close();
	
	$mpd->close();
}
else {
	debug("Error");
	var_dump($mpd->get_error());
}
echo "\n";

function Convert( $path, $filename ){
	global $buck, $mpd;

	$playlist = "";

	$var = json_decode( file_get_contents($path."/".$filename), false );
	foreach( $var as $item ){
		$uri = "$buck$item->uri";
		$ok = $mpd->add_to_playlist( "$filename", "$uri" );
	}
}

?>
