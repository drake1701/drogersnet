--- 
layout: default
title: Photography
date: 2010-02-02 20:10:41 -05:00
permalink: /photography/
---
![Cat](/images/cat.jpg)

The website I've built for my photography is completely my own, all the photos, the design, and every scrap of code to make it work. I'm still adding a few features to it, but it's fully functional in its current form.

It uses a little apache magic to redirect all the page requests through either the gallery file or the cache image file, which organize and generate proper size images, respectfully.

[Shift_Photos](http://www.shift.ws/)

Here's the source code.  Some of the formatting is a little broken, but you can get the basic idea.

#### gallery.php

```php
<?php
    function scan($path){
        
        $dir = scandir($path);
        array_shift($dir);
        array_shift($dir);
        sort($dir);
        return $dir;
        
    }
    
    $path = urldecode(dirname($_SERVER[SCRIPT_FILENAME]).$_SERVER[REQUEST_URI]);
    if(!ereg('gallery', $path)) $path .= "gallery/";
    
    if(ereg("jpg", $path)){
        
        $here = scan(dirname($path));
        $current = array_search(basename($path), $here);
        require_once('head.php');
        if($current > 0) echo "<a id='prev' href=\"{$here[$current-1]}\">&lt;</a>";
        if($current+1 < count($here)) echo "<a id='next' href=\"{$here[$current+1]}\">&gt;</a>";
        echo "<img src='/cache{$_SERVER[REQUEST_URI]}/$img?x=710' alt=\"$img\" onLoad=\"javascript:loaded();\"/>";
        echo "<img id='loader' src='/img/ajax-loader.gif' alt='loader' style=\"padding: 50px 0px\"/>";
        require_once('tail.php');
        
    } else {
        
        $here = scan($path);
        
        rsort($here);
        
        $flag = 0;    
        
        foreach($here as $dir){
            
            if(is_dir($path.$dir)){
                
                $flag = 1;
                $sub = scan($path.$dir);
                rsort($sub);
                foreach($sub as $img){
                    if(ereg("jpg", $img)) break;
                }
                if(ereg("jpg", $img)) echo "<a class='galleryimg' href=\"/gallery/$dir\"><img src=\"/cache/gallery/$dir/$img?x=150&amp;y=150\" alt=\"$img\"/><br/>".ereg_replace("[0-9][0-9] ", "", $dir)."<br/></a>";
                
            }
        }
        
        if(!$flag){
            
        sort($here);
        
        require_once('head.php');
        $page = 1;
        $c = 0;
        echo "<div id='topnav'><div style='padding: 150px;'><img src='/img/ajax-loader.gif' alt='loader'/></div>";
            foreach($here as $img){
                if($c++ % 16 == 0){?>
                    </div>
                    <div id="page<?=$page++?>" style="display:none;">
                <?}
                
                if(ereg("jpg", $img)) {
                    
                    echo "<a class=\"galleryimg\" href=\"{$_SERVER[REQUEST_URI]}/$img\"><img src=\"/cache{$_SERVER[REQUEST_URI]}/$img?x=150&amp;y=150\" alt=\"$img\"/><br/></a>\n";
                    
                }
                
            }
        echo "</div>";
        echo "<div id='nav' style='display:none'><a onclick='javascript:prev()'>&lt;prev</a>&nbsp;";
        for($i=1;$i<$page;$i++){
            echo "<a onclick='javascript:pager($i)'>$i</a>&nbsp;";
        }
        echo "&nbsp;<a onclick='javascript:next()'>next&gt;</a></div>";
        
        require_once('tail.php');
        
        }
        
    }
```

#### cache.php
```php
<?php
    $x = $_GET['x'];
    $y = $_GET['y'];
    
    $_SERVER[REQUEST_URI] = substr(dirname($_SERVER[SCRIPT_FILENAME]), 0, strpos($_SERVER[REDIRECT_URL], '?'));
            
    $path = "cache/" . "$x-$y" . str_replace('/', '-', urldecode(dirname($_SERVER[SCRIPT_FILENAME]).$_SERVER[REDIRECT_URL]));
    if(!file_exists($path)){
        
        $src = str_replace('cache/', '', urldecode(dirname($_SERVER[SCRIPT_FILENAME]).rtrim($_SERVER[REDIRECT_URL], '/')));
        
        $src = imagecreatefromjpeg("$src");
        
        $sx = imagesx($src);
        $sy = imagesy($src);
            
        if($x && $y){        
            $ratio = min($sx, $sy) / max($x, $y);
        
            $top = $sx / 2 - $x * $ratio / 2;
            $left = $sy / 2 - $y * $ratio / 2;        
        } else {    
        
            if($x){
                $ratio = $sx / $x;
            } else {
                $ratio = $sy / $y;
            }
            
            $top = 0;
            $left = 0;
            
            $x = $sx / $ratio;
            $y = $sy / $ratio;
            
        }
        $dst = imagecreatetruecolor($x, $y);
        
        imagecopyresampled($dst, $src, 0, 0, $top, $left, $x, $y, $x*$ratio, $y*$ratio);
        
        imagejpeg($dst, $path, '70');
        
    }
    header("Content-type: image/jpeg");
    echo file_get_contents($path);
```
