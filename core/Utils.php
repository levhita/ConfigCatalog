<?php

class Utils {
  /**
   * An ls style command using regular expresions
   * 
   * By fordiman@gmail.com taken from PHP documentation:
   * http://www.php.net/manual/en/class.dir.php#60562
   *
   * @example foreach (preg_ls("/etc/X11", true, "/.*\.conf/i") as $file) echo $file."\n";
   * @param string $path
   * @param boolean $recursive if the ls should be recursive
   * @param string $patttern the pattern in regular expression format
   * @return Array
   */ 
  public static function preg_ls ($path=".", $recursive=false, $pattern="/.*/") {
    $rec = $recursive;
    $pat = $pattern;
    // it's going to be used repeatedly, ensure we compile it for speed.
    $pat=preg_replace("|(/.*/[^S]*)|s", "\\1S", $pat);
    //Remove trailing slashes from path
    while (substr($path,-1,1)=="/") $path=substr($path,0,-1);
    //also, make sure that $path is a directory and repair any screwups
    if (!is_dir($path)) $path=dirname($path);
    //assert either truth or falsehoold of $rec, allow no scalars to mean truth
    if ($rec!==true) $rec=false;
    //get a directory handle
    $d=dir($path);
    //initialise the output array
    $ret=Array();
    //loop, reading until there's no more to read
    while (false!==($e=$d->read())) {
        //Ignore parent- and self-links
        if (($e==".")||($e=="..")) continue;
        //If we're working recursively and it's a directory, grab and merge
        if ($rec && is_dir($path."/".$e)) {
            $ret=array_merge($ret,preg_ls($path."/".$e,$rec,$pat));
            continue;
        }
        //If it don't match, exclude it
        if (!preg_match($pat,$e)) continue;
        //In all other cases, add it to the output array
        $ret[]=$path."/".$e;
    }
    //finally, return the array
    return $ret;
  }
}