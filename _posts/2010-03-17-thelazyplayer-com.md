--- 
layout: post
title: thelazyplayer.com
author: Dennis
date: 2010-03-17 17:27:27 -04:00
permalink: 2010/03/thelazyplayer-com
tags: 
- magento
- armory
- world of warcraft
- jquery
comments: []

---
This is a freelance project I did for a site called "[The Lazy Player](http://www.thelazyplayer.com)" which sells world of warcraft leveling services and accounts.  The site is built on Magento and there are several parts to my contribution to the site.

![]({{ site.url }}images/2010/03/doodle.png)
![]({{ site.url }}images/2010/03/doodle1.png)
![]({{ site.url }}images/2010/03/doodle2.png)

The first is an armory link that curl's the xml data from Blizzard's "[Armory](http://www.wowarmory.com)" service into the product listing and displays it on the product page in an easy to read format, using jquery and [wowhead](http://www.wowhead.com)'s "powered by wowhead" item tooltips.

The second part is a backend script for magento's admin panel that pulls the list of wow servers from blizzard and populates the drop-down of custom options for leveling services so that the list can be easily updated.  It also allows for different pricing options based on the type of server chosen.

The final component is a script to generate custom options for partial leveling services that will adjust the price of the service in magento based on the customer's start and end level.  The values are calculated from cost per group of levels (ex: 21-30) into a full range of level choices for start and a choice for each group, all of which are given specific negative price values that will adjust the final cost of the service product in magento.
