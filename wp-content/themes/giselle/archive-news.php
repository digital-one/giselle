<?php get_header() ?>
<main id="main" role="main">
	<section>
    <?php $page = get_page(11); ?>
    <?php echo $page->post_content ?>
    <!--
<h1>Latest News, Tweets &amp; Events</h1>
<p>All the latest trends, finds, views and features
from Giselle Ladieswear...</p>
-->
</section>
<section id="archive">
  <div class="container">
    <div class="posts">
           <?php
    $paged = isset($wp->query_vars['pge']) ? $wp->query_vars['pge'] : 1;
    $next_page = $paged+1;
  $args = array(
          'post_type' => 'cpt_news',
          'orderby' => 'date',
          'order' => 'DESC',
          'paged' => $paged,
          'posts_per_page' => 3,
          'post_status' => 'publish'
          );
    $query = new WP_Query($args);
    $max_num_pages = $query->max_num_pages;
    if($articles = get_posts($args)):
    foreach($articles as $article):
      list($src,$w,$h) = wp_get_attachment_image_src(get_post_thumbnail_id($article->ID),'news-tn');
     ?>
<article class="post"><div class="inner"><figure><img class="preload" src="<?php echo $src ?>" /></figure><div class="content"><header><h3><?php echo $article->post_title ?></h3><time datetime="<?php echo mysql2date('Y-M-d', $article->post_date); ?>"><?php echo mysql2date('jS F Y', $article->post_date); ?></time></header><?php echo $article->post_content ?></div></div></article>
    <?php endforeach; ?>
<?php endif; ?>

</div>
<footer class="posts-footer">
     <a href="/news/archive/pge/<?php echo $next_page ?>" class="load-posts<?php if($next_page > $max_num_pages): ?> end<?php endif ?>">Load More</a>
</footer>
</div>


</section>


<section id="newsletter-signup">
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
</section>

</main>
<?php get_footer() ?>