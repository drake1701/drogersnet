--- 
layout: post
status: publish
published: true
title: Interpretive Development Program
author: Dennis
author_login: admin
author_email: dennis@drogers.net
author_url: http://www.drogers.net
wordpress_id: 75
wordpress_url: http://drogers.net/?p=75
date: 2010-05-19 18:27:13 -04:00
categories: 
- Posts
tags: 
- jquery
- javascript
- slideshow
- drupal
- theme
- css
comments: []

---
Latest work project.  Implementing an unsliced PSD from our designer.

![Interpretive Developer Program]({{ site.url }}images/2010/05/idp.png)

This is an abandoned Drupal project assigned to me so there was a fair amount of cruft in the source.  Basically I built the static site then replaced the dev site's css with mine, tweaking class names and wrappers as needed to compensate for Drupal's bizarre template system.

I liked the simplicity of the slideshow over my last attempt, requiring no counters or explicit element IDs.

```javascript
    var slider;

    $(document).ready(function() {
        slider = setTimeout(doSlider, 6000);
        $('.slider>a:first').show();
    });
    
    function doSlider(){
        if($('.slider>a.current').next()[0].tagName != "A"){
            $('.slider>a.current').fadeOut(). removeClass('current');
            $('.slider>a:first').fadeIn(). addClass('current');
            $('.slider-footer>a.current'). removeClass('current');
            $('.slider-footer>a:first'). addClass('current');
        } else {
            $('.slider>a.current').next('a').fadeIn(). addClass('current').prev('a').fadeOut(). removeClass('current');
            $('.slider-footer>a.current').removeClass('current').next('a'). addClass('current');
        }
        slider = setTimeout(doSlider, 6000);
    }
```