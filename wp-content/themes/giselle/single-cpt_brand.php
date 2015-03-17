<?php get_header() ?>
<main id="main" class="fullpage">
  <!--<div id="fullpage">-->
<?php
list($featured_src,$w,$h) = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID),'slide');
list($svg,$w,$h) = wp_get_attachment_image_src(get_field('brand_logo_svg',$post->ID), 'full');
list($png,$w,$h) = wp_get_attachment_image_src(get_field('brand_logo_png',$post->ID), 'full');
       $class=  $h > $w ? ' portrait' : '';
       $logo_src = !empty($svg) ? $svg : $png;
?>
<!--top section-->
<section class="section">
  <div class="handle"><a>Scroll Down</a></div>
<div class="section-inner">
<div class="column full-width"><div class="row"><div class="content preload" style="background-image:url('<?php echo $featured_src ?>');"><div class="vcenter"><div class="logo<?php if(get_field('logo_position',$post->ID)=='right'):?> right<?php endif ?> <?php echo $class ?>"><img src="<?php echo $logo_src ?>" /></div></div></div></div></div>
</div>
</section>
<!--/section-->
<?php while ( have_posts()):
the_post();
?>
<?php
if(have_rows('brand_pages_rptr')):
  $collection_total = count(get_field('brand_pages_rptr'));
  $collection_count=0;
while(have_rows('brand_pages_rptr')): 
  the_row();
  $collection = get_sub_field('brand_collection');
  $collection_count++;
  $last = false;
   $title = get_field('collection_displayed_title',$collection->ID);
  $display_title = !empty($title) ? $title : $collection->post_title;



   //$page_total = count(get_field('brand_collection_pages_rptr'));
$rows = get_sub_field('brand_collection_pages_rptr');
if( have_rows('brand_collection_pages_rptr') ):
     $page_count=0;
$page_total = count($rows);

      while( have_rows('brand_collection_pages_rptr')):
       
        
        $page_count++;
        the_row(); 
     $layout = get_sub_field('collection_page_layout');
     switch($layout){
        case 'intro_text_right':
        list($image1_src,$w,$h) = wp_get_attachment_image_src(get_sub_field('image_one_portrait'),'brand');
        list($image2_src,$w,$h) = wp_get_attachment_image_src(get_sub_field('image_two_landscape'),'brand');

       
        ?>
        <!--section-->
<section class="section<?php if($last):?> last<?php endif ?>">
<div class="section-inner">
<div class="column half"><div class="row"><div class="content preload" style="background-image:url('<?php echo $image1_src ?>');"></div></div></div>
<div class="column half">
<div class="row height-45-pct top">
<div class="content"><div class="text"><div><h2><?php echo $display_title; ?></h2>
<?php echo $collection->post_content ?></div></div></div>
</div>
<div class="row height-55-pct bottom"><div class="content preload"   style="background-image:url('<?php echo $image2_src ?>');"></div></div>
</div>
</div>
<!--</section>-->
<!--/section-->
        <?php
        break;
        case 'intro_text_left':
        list($image1_src,$w,$h) = wp_get_attachment_image_src(get_sub_field('image_one_landscape'),'brand');
        list($image2_src,$w,$h) = wp_get_attachment_image_src(get_sub_field('image_two_portrait'),'brand');
        ?>
         <!--section-->
<section class="section<?php if($last):?> last<?php endif ?>">
<div class="section-inner">
<div class="column half">
<div class="row height-45-pct top">
<div class="content"><div class="text"><div><h2><?php echo $display_title; ?></h2>
<?php echo $collection->post_content ?></div></div></div>
</div>
<div class="row height-55-pct bottom"><div class="content preload"   style="background-image:url('<?php echo $image1_src ?>');"></div></div>
</div>
<div class="column half"><div class="row"><div class="content preload" style="background-image:url('<?php echo $image2_src ?>');"></div></div></div>
</div>
<!--</section>-->
<!--/section-->
        <?php
        break;
        case 'full_image':
          list($image1_src,$w,$h) = wp_get_attachment_image_src(get_sub_field('image_one_landscape'),'slide');
        ?>
        <!--section-->
<section class="section<?php if($last):?> last<?php endif ?>">
<div class="section-inner">
<div class="column full-width"><div class="row"><div class="content preload"  style="background-image:url('<?php echo $image1_src ?>');"></div></div></div>
</div>
<!--</section>-->
<!--/section-->
        <?php
        break;
        case 'two_half_images':
        list($image1_src,$w,$h) = wp_get_attachment_image_src(get_sub_field('image_one_portrait'),'brand');
        list($image2_src,$w,$h) = wp_get_attachment_image_src(get_sub_field('image_two_portrait'),'brand');
        ?>
          <!--section-->
<section class="section<?php if($last):?> last<?php endif ?>">
<div class="section-inner">
<div class="column half"><div class="row"><div class="content preload" style="background-image:url('<?php echo $image1_src ?>');"></div></div></div>
<div class="column half"><div class="row"><div class="content preload" style="background-image:url('<?php echo $image2_src ?>');"></div></div></div>
</div>
<!--</section>-->
<!--/section-->
        <?php
        break;
        case 'intro_text_right_1_image':
         list($image1_src,$w,$h) = wp_get_attachment_image_src(get_sub_field('image_one_portrait'),'brand');
        ?>
<!--section 1 image intro text right-->
<section class="section<?php if($last):?> last<?php endif ?>">
<div class="section-inner">
<div class="column half"><div class="row"><div class="content preload" style="background-image:url('<?php echo $image1_src ?>');"></div></div></div>
<div class="column half">
<div class="row">
<div class="content"><div class="text"><div><h2><?php echo $display_title; ?></h2>
<?php echo $collection->post_content ?></div></div></div></div></div>
</div>
<!--</section>-->
<!--/section-->
        <?php
        break;
        case 'intro_text_left_1_image':
          list($image1_src,$w,$h) = wp_get_attachment_image_src(get_sub_field('image_one_portrait'),'brand');
        ?>
        <!--section 1 image intro text left-->
<section class="section<?php if($last):?> last<?php endif ?>">
<div class="section-inner">
<div class="column half">
<div class="row">
<div class="content"><div class="text"><div><h2><?php echo $display_title; ?></h2>
<?php echo $collection->post_content ?></div></div></div></div></div>
<div class="column half"><div class="row"><div class="content preload" style="background-image:url('<?php echo $image1_src ?>');"></div></div></div>
</div>
<!--</section>-->
<!--/section-->
        <?php
        break;
     }
     if($last):
      ?>
    <?php get_template_part('newsletter'); ?>
<?php get_footer() ?>
    <?php
      endif;
    ?>
  </section>
    <?php
         $last = $collection_count==$collection_total && $page_count==$page_total-1 ? true : false;
     endwhile;
     endif;
  endwhile;
  endif;
  ?>
<?php endwhile ?>



<!--</div>-->
</main>
<?php wp_footer() ?>