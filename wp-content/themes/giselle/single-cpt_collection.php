<?php get_header() ?>
<?php
$brand = get_field('collection_brand',$post->ID);
       list($svg,$w,$h) = wp_get_attachment_image_src(get_field('brand_logo_svg',$brand->ID), 'full');
       list($png,$w,$h) = wp_get_attachment_image_src(get_field('brand_logo_png',$brand->ID), 'full');
       $class=  $h > $w ? ' portrait' : '';
       $logo_src = !empty($svg) ? $svg : $png;
       $link = get_permalink($brand->ID);
?>
<main id="main">
<!--section-->
<section class="section">
<div class="section-inner">
    <a class="close" href="<?php echo home_url() ?>" title="Close">Close</a>
<div class="column half left">
  <div class="row">
    <div class="content">
      <div id="gallery" class="slick-slider">
      <?php /*  <div class="slick-list">
          <div class="slick-track"> */ ?>
          	<?php
if(get_field('collection_gallery')):
while(the_repeater_field('collection_gallery')): 
list($src,$w,$h) = wp_get_attachment_image_src(get_sub_field('gallery_image'), 'brand');
?>
<div class="slide slick-slide preload" style="background-image:url('<?php echo $src ?>');"></div>
<?php endwhile ?>
<?php endif ?>
</div>
</div>
<?php /*
<button type="button" data-role="none" class="slick-prev" style="display: block;">Previous</button>
<button type="button" data-role="none" class="slick-next" style="display: block;">Next</button>
</div>
</div>
*/ ?>
</div></div>
 <div class="column half right">
<div class="row">
<?php
$display_title = get_field('collection_displayed_title',$post->ID); 
$title = !empty($display_title) ? $display_title : $post->post_title;
?>

<div class="content"><div class="text"><div><div class="logo<?php echo $class ?>"><img src="<?php echo $logo_src ?>" onerror="this.onerror=null; this.src='<?php echo $png ?>'" /></div><h2><?php echo $title ?></h2>
<?php echo $post->post_content ?>
<?php if(get_field('link_to_brand_page',$post->ID)==1): ?>
<a href="<?php echo $link ?>" class="button">VIEW MORE</a>
<?php endif ?>
</div></div></div>
</div>
</div>
</div>
</section>
<!--/section-->
</main>
<?php wp_footer() ?>