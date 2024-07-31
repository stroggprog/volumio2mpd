<?php

// $buck is prepended to volumio path uri's
// do not include anything that forms part of the MPD data folder
//
$buck = "Extended-Disk/";

// the path where to fetch the volumio playlists from
// probably a good idea to use a local copy
//
$in_path = __DIR__."/lists";

// uncomment these lines if these variables don't already exist in your environment
// Don't forget to change the values to something sane for your system
//
//putenv("MPD_HOST=localhost");
//putenv("MPD_PORT=6600");
//putenv("MPD_PASS=G0shVVutAbadPusswud");
?>
