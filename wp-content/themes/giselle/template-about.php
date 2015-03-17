<?php /* Template Name: About */ ?>
<?php get_header() ?>
<main id="main" role="main">
  <?php
  list($image1,$w,$h) = wp_get_attachment_image_src(get_field('image_1',$post->ID),'brand');
  list($image2,$w,$h) = wp_get_attachment_image_src(get_field('image_2',$post->ID),'brand');

  ?>
	<section id="image-banner"><div class="image-wrap"><div style="background-image:url('<?php echo $image1 ?>');"></div></div><div class="image-wrap right"><div style="background-image:url('<?php echo $image2 ?>');"></div></div></section>
	<div class="container">
<section id="intro" class="gutter">
<?php echo $post->post_content ?>
</section>

<section id="carousel">
  <?php
 $args = array(
  'post_type' => 'cpt_brand',
  'post_status' => 'publish',
  'orderby' => 'menu_order',
  'order' =>  'ASC',
  'posts_per_page' => -1
);
 if($brands = get_posts($args)):
  foreach($brands as $brand):
       list($svg,$w,$h) = wp_get_attachment_image_src(get_field('brand_logo_svg',$brand->ID), 'full');
       list($png,$w,$h) = wp_get_attachment_image_src(get_field('brand_logo_png',$brand->ID), 'full');
       $class=  $h >= $w ? ' portrait' : '';
       $logo_src = !empty($svg) ? $svg : $png;
       ?>
			<!--link-->
		<div class="signpost" index="-3"><a href="<?php echo get_permalink($brand->ID)?>" class="content"><div class="logo"><div class="img-wrap<?php echo $class ?>"><img src="<?php echo $logo_src ?>" onerror="this.onerror=null; this.src='<?php echo $png ?>'" /></div></div></a></div>
<!--/link-->
<?php endforeach ?>
<?php endif ?>
</section>
<?php get_template_part('newsletter'); ?>
</div>
</main>
<?php get_footer() ?>