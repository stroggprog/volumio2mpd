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

## PHP-MPD
This is an old mpd library that was developed for PHP v5.x, so there is a lot in it that will break. However, it is sufficiently usable that by changing 4 lines of code it works for the requirements of this applet.

If you want to do a bit more than convert Volumio playlists, I suggest you look at [https://github.com/FloFaber/MphpD](MphpD), which is a beautiful library that embraces the entire MPD api. I haven't used it here because it imports a lot of stuff that - in this case - just simply isn't needed.
