# Volumio2Mpd

This applet converts Volumio style playlists to MPD style  playlists.
It relies on PHP-MPD. The repo is here: https://github.com/jimmikristensen/PHP-MPD.git
__DO NOT__ use the files from the repo, the class file has been edited to work with modern versions of php.

The script follows this pattern for each playlist:
  - clear the queue
  - convert each playlist entry into mpd format and add it to the queue
  - save the queue with the playlist name (overwriting any existing playlist with the same name)

## Preparation
It is required to know the mpd host, port and password. The host might be localhost, for example.

The defaults, if not provided, are:
```php
$host = "localhost";
$port = 6600;
$pass = "";
```

You should edit the `local.php` file which by default looks like this:
```php
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
```

The comments speak for themselves. Note there is no preceding `/` on `$buck`.
Where possible, the environment variables should already exist so there is nowhere in the code anyone can scrape them from.

Create a folder called `lists` as a subfolder of the current directory, and copy the volumio playlists into it.



## PHP-MPD
This is an old mpd library that was developed for PHP v5.x, so there is a lot in it that will break. However, it is sufficiently usable that by changing 4 lines of code it works for the requirements of this applet.

If you want to do a bit more than convert Volumio playlists, I suggest you look at [https://github.com/FloFaber/MphpD](MphpD), which is a beautiful library that embraces the entire MPD api. I haven't used it here because it imports a lot of stuff that - in this case - just simply isn't needed.
