<?php

echo "Zadatak 1" . "<br /><br />\n";

function getExtension($filepath)
{
    /**
     * Kod zadatka ide ovdje
     */
}

print "blah.gif:      " . getExtension("blah.gif") . "<br />\n";
print "my.file.gif:   " . getExtension("my.file.gif") . "<br />\n";
print "this/is/my/new/xfile: " . getExtension("this/is/my/new/xfile") . "<br />\n";
