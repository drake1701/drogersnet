--- 
layout: post
title: Roman Numerals
author: Dennis
date: 2010-01-07 18:14:16 -05:00
permalink: 2010/01/roman-numerals
tags: 
- php
- function
- roman numerals
comments: []

---
Disappointed to find that php's date() function has no roman numeral conversion, nor is there any preexisting function to do so, I whipped up my own today.

```php
<?php
    function roman_numeral($dec){
        $table = array(1 => "I", 5 => "V", 10 => "X", 50 => "L", 100 => "C", 500 => "D", 1000 => "M");
        $rom[100] = substr($dec, -3, 1);
        $rom[10] = substr($dec, -2, 1);
        $rom[1] = substr($dec, -1);
        $m = substr($dec, 0, -3);
    
        foreach($rom as $key => $base){
           switch($base){
              case 0:
                 $rom[$key] = "";
                 break;
              case 9:
                 $rom[$key] = $table[$key].$table[$key*10];
                 break;
              case 4:
                 $rom[$key] = $table[$key].$table[$key*5];
                 break;
              case 5:
                 $rom[$key] = $table[$key*5];
                 break;
              case $base < 4:
                 $rom[$key] = str_repeat($table[$key], $base);
                 break;
              case $base > 5:
                 $rom[$key] = $table[$key*5].str_repeat($table[$key], $base - 5);
                 break;
           }
        }
        return str_repeat("M", $m).implode($rom);
    }
```