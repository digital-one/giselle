<?php /* Template Name: Product */ ?>
<?php get_header() ?>
<main id="main">
<!--section-->
<section class="section">
<div class="section-inner">
    <a class="close">Close</a>
<div class="column half left">
  <div class="row">
    <div class="content">
      <div id="gallery" class="slick-slider">
        <div class="slick-list">
          <div class="slick-track">
<div class="slide slick-slide" style="background-image:url('<?php echo get_template_directory_uri(); ?>/images/marccain-express-yourself.jpg');"></div>
<div class="slide slick-slide" style="background-image:url('<?php echo get_template_directory_uri(); ?>/images/marccain-express-yourself.jpg');"></div>
</div>
</div>
<button type="button" data-role="none" class="slick-prev" style="display: block;">Previous</button>
<button type="button" data-role="none" class="slick-next" style="display: block;">Next</button>
      </div>
</div>
</div></div>
 <div class="column half right">

<div class="row">
<div class="content"><div class="text"><div><div class="logo"><img src="<?php echo get_template_directory_uri(); ?>/images/marccain.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/marccain.png'" /></div><h2>EXPRESS YOURSELF</h2>
<p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr,  sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum.</p><a href="" class="button">VIEW MORE</a></div></div></div>
</div>
</div>
</div>
</section>
<!--/section-->
</main>
<?php wp_footer() ?>