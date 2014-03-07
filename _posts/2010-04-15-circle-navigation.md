--- 
layout: post
status: publish
published: true
title: Circle Navigation
author: Dennis
author_login: admin
author_email: dennis@drogers.net
author_url: http://www.drogers.net
wordpress_id: 71
wordpress_url: http://drogers.net/?p=71
date: 2010-04-15 20:32:19 -04:00
categories: 
- Posts
tags: 
- javascript
- math
- navigation
- circle
comments: []

---
![]({{ site.url }}images/2010/04/Wireframe-v1.1-e1271362861897.png)

This is the model for what was supposed to be an information site sort of like a wiki but in which the information is updated every couple years at most.  The project is currently on hold and hopefully will not include such a silly navigation system.  Nonetheless I wanted to share the model and how I implemented it here because of the unusual nature.

Naturally I could have made it an image map or use flash (gross to both) but I wanted to keep it simple and accessible, so I used javascript and math.

```javascript
    jQuery(document).ready(function(){
        $("#circle").mousemove(function(e){
            var center = $(this).offset();
            center.left += 242;
            center.top += 242;
            var mouse = {'left': e.pageX, 'top': e.pageY};
            var distance = Math.sqrt(Math.pow(mouse.left - center.left, 2) + Math.pow(mouse.top - center.top, 2));
            var angle = Math.atan2( mouse.left - center.left, mouse.top - center.top ) *(180/Math.PI) + 180;
            var debug;
            if(distance < 60){
                debug = "self management";
            } else if(distance < 90){
                debug = "nps universal";
            } else if(distance < 197){
                if(angle > 325 || angle < 35){
                    debug = "i";
                } else if(angle < 325 & angle > 252){
                    debug = "ii";
                } else if(angle < 252 & angle > 180){
                    debug = "iii";
                } else if(angle < 180 & angle > 107){
                    debug = "iv";    
                } else if(angle > 35 & angle < 107){
                    debug = "v";
                }
            } else if(distance < 228){
                debug = "supervision etc";
            }
            console.log(debug);
        }); 
    })
```
It's more of a proof of concept because the project is on hold, but I found the solution fairly elegant.
