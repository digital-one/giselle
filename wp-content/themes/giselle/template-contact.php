<?php /* Template Name: Contact */ ?>
<?php get_header() ?>
<main id="main" role="main">
	<section id="location-map"><div id="map"></div></section>

<section id="address" class="gutter">
  <p class="vcard">
<h1>Giselle Ladieswear</h1>
<p class="vcard">
<span>14 Swinegate<br />
York<br />
North Yorkshire <br />
YO1 8AZ</span>
<span>TEL: <a href="tel:01904639210">01904 639210</a><br />EMAIL: <a href="mailto:info@giselleladieswear.com">info@giselleladieswear.com</a></span>
</p>
</section>
<section id="opening-hours">
<h2>Opening Hours</h2>
<ul>
	<?php
if(get_field('opening_hours')):
while(the_repeater_field('opening_hours')): 
?>
  <li><span class="days"><?php echo get_sub_field('days') ?></span><span class="times"><?php echo get_sub_field('times') ?></span></li>
 <?php endwhile ?>
<?php endif ?>
</ul>
</section>
<?php get_template_part('newsletter'); ?>
</main>
<?php get_footer() ?>