# WDS Disable Pingbacks - Disable Pingbacks... all of them

![All Of Them](http://2.bp.blogspot.com/-E69IWOMA6_4/Vl77X80i9UI/AAAAAAAAOn4/i1zzEdZPc9M/s640/Star-Wars-Wipe-Them-Out-All-of-Them-Emperor-Palpatine.gif)

## Testing

Test that pingbacks are turned off.

@see http://blog.mlindgren.ca/entry/2015/01/17/how-to-manually-send-a-pingback/

1. Enable the WDS Disable Pingbacks plugin.
1. Edit pingback.xml.
    1. Replace source/url/here with a URL that is the source of the ping.
    1. Replace example.com/url/here with a URL on your WP site.
    1. Save pingback.xml.
1. Run this command from terminal, replacing example.com with your WP site: 

`curl -X POST -d @pingback.xml http://example.com/xmlrpc.php`
