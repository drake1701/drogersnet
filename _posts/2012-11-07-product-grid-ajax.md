--- 
layout: post
title: Product Grid Ajax
author: Dennis
date: 2012-11-07 17:18:35 -05:00
permalink: 2012/11/product-grid-ajax/
tags: [magento, ecommerce, jquery, javascript, theme, development]
comments: []

---
For a recent client project we were asked to do several fancy implementations to match their very specific design requirements, and while some of the solutions ended up somewhat hacky, there were a couple where I was pleased with the process and result.  Both were on the product grid and involved ajax requests.  

The first was a product "quick view" feature with fully implemented quantity drop downs, configurable form elements, social media widgets and add to cart functionality.

<div class="row-fluid">
<div class="span6">
<a href="{{site.url}}images/2012/11/Screen-Shot-2012-11-07-at-11.57.45-AM.png" data-featherlight="image"><img src="{{site.url}}images/2012/11/Screen-Shot-2012-11-07-at-11.57.45-AM.png" alt="Hover" /></a>
</div>
<div class="span6">
<a href="{{site.url}}images/2012/11/Screen-Shot-2012-11-07-at-11.57.57-AM.png" data-featherlight="image"><img src="{{site.url}}images/2012/11/Screen-Shot-2012-11-07-at-11.57.57-AM.png" alt="Quick View" /></a>
</div>
</div>

The main quick view box was pretty straightforward, with a little jquery to make the ajax call, a custom controller route to serve the page, and a template to arrange the content.  There was a little trickery required to make the social media play nice, and we had to involve some jquery modules to make the fancy dropdowns and scrollbars required by the client.

The second piece was an infinite scroller, sometimes referred to as a "lazy loader" which complicated my research because of the php/architecture term of the same name.  Regardless, the process was very similar, ajax request with route and template to serve the next page in the product grid and append it in the page when the user scrolls to the bottom, eliminating pagination completely in this design.

Overall it was a fun project to work on, even though the layers of javascript required some less that pretty solutions to make everything play nice.
