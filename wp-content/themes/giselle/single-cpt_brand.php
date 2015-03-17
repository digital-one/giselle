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
<div class="column full-width"><div class="row"><div class="content preload" style="background-image:url('<?php echo $featured_src ?>');"><div class="vcenter"><div class="logo<?php echo $class ?>"><img src="<?php echo $logo_src ?>" /></div></div></div></div></div>
</div>
</section>
<!--/section-->
<?php while ( have_posts()):
the_post();
?>
<?php
if(have_rows('brand_pages_rptr')):
while(have_rows('brand_pages_rptr')): 
  the_row();
  $collection = get_sub_field('brand_collection');
   $title = get_field('collection_displayed_title',$collection->ID);
  $display_title = !empty($title) ? $title : $collection->post_title;
  if( have_rows('brand_collection_pages_rptr') ):
      while( have_rows('brand_collection_pages_rptr')):
        the_row(); 
     $layout = get_sub_field('collection_page_layout');
     switch($layout){
        case 'intro_text_right':
        list($image1_src,$w,$h) = wp_get_attachment_image_src(get_sub_field('image_one_portrait'),'brand');
        list($image2_src,$w,$h) = wp_get_attachment_image_src(get_sub_field('image_two_landscape'),'brand');

       
        ?>
        <!--section-->
<section class="section">
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
</section>
<!--/section-->
        <?php
        break;
        case 'intro_text_left':
        list($image1_src,$w,$h) = wp_get_attachment_image_src(get_sub_field('image_one_landscape'),'brand');
        list($image2_src,$w,$h) = wp_get_attachment_image_src(get_sub_field('image_two_portrait'),'brand');
        ?>
         <!--section-->
<section class="section">
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
</section>
<!--/section-->
        <?php
        break;
        case 'full_image':
          list($image1_src,$w,$h) = wp_get_attachment_image_src(get_sub_field('image_one_landscape'),'slide');
        ?>
        <!--section-->
<section class="section">
<div class="section-inner">
<div class="column full-width"><div class="row"><div class="content preload"  style="background-image:url('<?php echo $image1_src ?>');"></div></div></div>
</div>
</section>
<!--/section-->
        <?php
        break;
        case 'two_half_images':
        list($image1_src,$w,$h) = wp_get_attachment_image_src(get_sub_field('image_one_portrait'),'brand');
        list($image2_src,$w,$h) = wp_get_attachment_image_src(get_sub_field('image_two_portrait'),'brand');
        ?>
          <!--section-->
<section class="section">
<div class="section-inner">
<div class="column half"><div class="row"><div class="content preload" style="background-image:url('<?php echo $image1_src ?>');"></div></div></div>
<div class="column half"><div class="row"><div class="content preload" style="background-image:url('<?php echo $image2_src ?>');"></div></div></div>
</div>
</section>
<!--/section-->
        <?php
        break;
        case 'intro_text_right_1_image':
         list($image1_src,$w,$h) = wp_get_attachment_image_src(get_sub_field('image_one_portrait'),'brand');
        ?>
<!--section 1 image intro text right-->
<section class="section">
<div class="section-inner">
<div class="column half"><div class="row"><div class="content preload" style="background-image:url('<?php echo $image1_src ?>');"></div></div></div>
<div class="column half">
<div class="row">
<div class="content"><div class="text"><div><h2><?php echo $display_title; ?></h2>
<?php echo $collection->post_content ?></div></div></div></div></div>
</div>
</section>
<!--/section-->
        <?php
        break;
        case 'intro_text_left_1_image':
          list($image1_src,$w,$h) = wp_get_attachment_image_src(get_sub_field('image_one_portrait'),'brand');
        ?>
        <!--section 1 image intro text left-->
<section class="section">
<div class="section-inner">
<div class="column half">
<div class="row">
<div class="content"><div class="text"><div><h2><?php echo $display_title; ?></h2>
<?php echo $collection->post_content ?></div></div></div></div></div>
<div class="column half"><div class="row"><div class="content preload" style="background-image:url('<?php echo $image1_src ?>');"></div></div></div>
</div>
</section>
<!--/section-->
        <?php
        break;
     }
     endwhile;
     endif;
  endwhile;
  endif;
  ?>
<?php endwhile ?>
<div id="newsletter-signup">
    <h2>SIGN UP FOR OUR NEWSLETTER</h2>
    <div class="container">
<div class="gf_browser_chrome gform_wrapper" id="gform_wrapper_1"><a id="gf_1" name="gf_1" class="gform_anchor"></a><form method="post" enctype="multipart/form-data" target="gform_ajax_frame_1" id="gform_1" action="/facebook-mailing-list-signup/#gf_1">
                        <div class="gform_body"><ul id="gform_fields_1" class="gform_fields top_label form_sublabel_below description_below"><li id="field_1_1" class="gfield gfield_contains_required field_sublabel_below field_description_below"><label class="gfield_label" for="input_1_1">Your name<span class="gfield_required">*</span></label><div class="ginput_container"><input name="input_1" id="input_1_1" type="text" value="" class="medium" tabindex="1" placeholder="Your name"></div></li><li id="field_1_2" class="gfield gfield_contains_required field_sublabel_below field_description_below"><label class="gfield_label" for="input_1_2">Email Address<span class="gfield_required">*</span></label><div class="ginput_container">
                            <input name="input_2" id="input_1_2" type="text" value="" class="medium" tabindex="2" placeholder="Email Address">
                        </div></li>
                            </ul></div>
        <div class="gform_footer top_label"> <input type="submit" id="gform_submit_button_1" class="gform_button button" value="Submit" tabindex="3" onclick="if(window[&quot;gf_submitting_1&quot;]){return false;}  window[&quot;gf_submitting_1&quot;]=true;  "> <input type="hidden" name="gform_ajax" value="form_id=1&amp;title=&amp;description=&amp;tabindex=1">
            <input type="hidden" class="gform_hidden" name="is_submit_1" value="1">
            <input type="hidden" class="gform_hidden" name="gform_submit" value="1">
            
            <input type="hidden" class="gform_hidden" name="gform_unique_id" value="">
            <input type="hidden" class="gform_hidden" name="state_1" value="WyJbXSIsIjQ3MjNjOTIwMTUzOTI2Y2VjNWQ4MGRlN2UwMDYxNzVhIl0=">
            <input type="hidden" class="gform_hidden" name="gform_target_page_number_1" id="gform_target_page_number_1" value="0">
            <input type="hidden" class="gform_hidden" name="gform_source_page_number_1" id="gform_source_page_number_1" value="1">
            <input type="hidden" name="gform_field_values" value="">
         </div>
          </form>
        </div>
    </div>
</div>
<?php get_footer() ?>
</section>
<!--/section-->
<!--</div>-->
</main>