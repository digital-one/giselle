<?php get_header() ?>

<section id="slider" class="slider-outer">
  <div id="slick" class="slick-slider">
	<!--<div class="slick-list">
		<div class="slick-track">-->

      
<div class="slick-slide slide preload" style="background-image:url('<?php echo get_template_directory_uri(); ?>/images/marccain-slide.jpg');"><div class="vcenter"><div class="caption"><div class="logo"><img src="<?php echo get_template_directory_uri(); ?>/images/marccain.svg" /></div><h3>New Spring/Summer Collections</h3><h4>available in store now</h4><a href="#" class="button">View more</a></div></div></div>
<div class="slick-slide slide preload" style="background-image:url('<?php echo get_template_directory_uri(); ?>/images/marccain-slide.jpg');"><div class="vcenter"><div class="caption">Caption</div></div></div>

<!--</div>
</div>-->
<?php /*
<div class="slick-dots-wrap">
	<div class="inner">
		<div>
    <ul class="slick-dots"><li class=""><button type="button" data-role="none">1</button></li><li class="slick-active"><button type="button" data-role="none">2</button></li><li class=""><button type="button" data-role="none">3</button></li><li class=""><button type="button" data-role="none">4</button></li><li class=""><button type="button" data-role="none">5</button></li><li class=""><button type="button" data-role="none">6</button></li><li class=""><button type="button" data-role="none">7</button></li></ul>
    </div>
</div>
</div>
*/ ?>
<!--</div>
</div>-->
</div>
</section>
<main id="main">
<div class="handle"><a>Scroll Down</a></div>
<section id="signposts">
<header><h2>SPRING/SUMMER 2015 COLLECTIONS IN STORE NOW</h2></header>
<div class="posts">

<?php
if(get_field('signposts',$post->ID)):
while(the_repeater_field('signposts',$post->ID)): 
  switch(get_sub_field('signpost_type')){
    case 'collection':
    $collection = get_sub_field('signpost_collection');
      list($src,$w,$h) = wp_get_attachment_image_src(get_post_thumbnail_id($collection->ID), 'signpost');
      $brand = get_field('collection_brand',$collection->ID);
      ?>
      <div class="signpost overlay"><a href="<?php echo get_permalink($collection->ID) ?>" title="<?php echo $collection->post_title ?>" class="content null"><figure><div class="bg" style="background-image:url(<?php echo $src ?>);"></div><figcaption><div><h3><?php echo $brand->post_name ?></h3><h4><?php echo $collection->post_name ?></h4></div><footer><span class="button">View More</span></footer></figcaption></figure></a></div>
      <?php
    break;
    case 'brand':
      $brand = get_sub_field('signpost_brand');
       list($svg,$w,$h) = wp_get_attachment_image_src(get_field('brand_logo_svg',$brand->ID), 'full');
       list($png,$w,$h) = wp_get_attachment_image_src(get_field('brand_logo_png',$brand->ID), 'full');
       $class=  $h > $w ? ' portrait' : '';
       $src = !empty($svg) ? $svg : $png;
    ?>
    <div class="signpost"><a href="<?php echo get_permalink($brand->ID)?>" class="content"><div class="logo"><div class="img-wrap<?php echo $class ?>"><img src="<?php echo $src ?>" onerror="this.onerror=null; this.src='<?php echo $png ?>'" /></div></div></a></div>
    <?php
    break;
    case 'tweet':
    $feed = get_sub_field('signpost_twitter_feed');
?>
<div class="signpost twitter">
  <div class="content">
    <div id="<?php echo $feed ?>" class="twitter-feed"></div>
      <footer><a href="https://twitter.com/giselle_york" target="_blank" class="button">Follow Us</a></footer>
  </div>

</div>
<?php
    break;
  }
  endwhile;
  endif;

?>
<?php /*
<div class="signpost"><a href="#" class="content"><figure><div class="bg" style="background-image:url('<?php echo get_template_directory_uri(); ?>/images/signpost-img-1.jpg');"></div><figcaption><div><h3>MARCCAIN</h3><h4>Express Yourself</h4></div><footer><span class="button">View More</span></footer></figcaption></figure></a></div>
<div class="signpost"><a href="" class="content">Content</a></div>
<div class="signpost"><a href="" class="content"><div class="logo"><div class="img-wrap"><img src="<?php echo get_template_directory_uri(); ?>/images/marccain.svg" onerror="this.onerror=null; this.src='<?php echo get_template_directory_uri(); ?>/images/marccain.png'" /></div></div></a></div>
<div class="signpost"><div class="content">Content</div></div>

<div class="signpost twitter"><div class="content"><div class="twitter-feed"><div class="user">
  <a href="https://twitter.com/fastforwardbook" aria-label="FastForwardBook (screen name: fastforwardbook)" data-scribe="element:user_link">
    <img alt="" src="https://pbs.twimg.com/profile_images/517313342382170112/23Gk_gc7_normal.jpeg" data-src-2x="https://pbs.twimg.com/profile_images/517313342382170112/23Gk_gc7_bigger.jpeg" data-scribe="element:avatar">
    <span>
      <span data-scribe="element:name">FastForwardBook</span>
    </span>
    <span data-scribe="element:screen_name">@fastforwardbook</span>

  </a>
</div><p class="tweet">BBC News - Solar plane journey's first leg ends <a href="http://t.co/i3ttC5si4V" data-expanded-url="http://ow.ly/K6ZoE" target="_blank" title="http://ow.ly/K6ZoE" data-scribe="element:url"><span>http://</span><span>ow.ly/K6ZoE</span><span></span><span><span>&nbsp;</span></span></a></p><p class="timePosted">Posted on 09 Mar</p><p class="interact"><a href="https://twitter.com/intent/tweet?in_reply_to=574975280042917888" class="twitter_reply_icon">Reply</a><a href="https://twitter.com/intent/retweet?tweet_id=574975280042917888" class="twitter_retweet_icon">Retweet</a><a href="https://twitter.com/intent/favorite?tweet_id=574975280042917888" class="twitter_fav_icon">Favorite</a></p>
<footer><a href="" class="button">Follow Us</a></footer>
</div>

</div></div>
<div class="signpost"><div class="content">Content</div></div>
<div class="signpost"><div class="content">Content</div></div>
<div class="signpost"><a href="" class="content"><div class="logo"><div class="img-wrap portrait"><img src="<?php echo get_template_directory_uri(); ?>/images/riani.png" /></div></div></a></div>
<div class="signpost"><div class="content">Content</div></div>
<div class="signpost twitter"><div class="content"><div class="twitter-feed"><div class="user">
  <a href="https://twitter.com/fastforwardbook" aria-label="FastForwardBook (screen name: fastforwardbook)" data-scribe="element:user_link">
    <img alt="" src="https://pbs.twimg.com/profile_images/517313342382170112/23Gk_gc7_normal.jpeg" data-src-2x="https://pbs.twimg.com/profile_images/517313342382170112/23Gk_gc7_bigger.jpeg" data-scribe="element:avatar">
    <span>
      <span data-scribe="element:name">FastForwardBook</span>
    </span>
    <span data-scribe="element:screen_name">@fastforwardbook</span>

  </a>
</div><p class="tweet">BBC News - Solar plane journey's first leg ends <a href="http://t.co/i3ttC5si4V" data-expanded-url="http://ow.ly/K6ZoE" target="_blank" title="http://ow.ly/K6ZoE" data-scribe="element:url"><span>http://</span><span>ow.ly/K6ZoE</span><span></span><span><span>&nbsp;</span></span></a></p><p class="timePosted">Posted on 09 Mar</p><p class="interact"><a href="https://twitter.com/intent/tweet?in_reply_to=574975280042917888" class="twitter_reply_icon">Reply</a><a href="https://twitter.com/intent/retweet?tweet_id=574975280042917888" class="twitter_retweet_icon">Retweet</a><a href="https://twitter.com/intent/favorite?tweet_id=574975280042917888" class="twitter_fav_icon">Favorite</a></p>
<footer><a href="" class="button">Follow Us</a></footer>
</div>

</div></div>
<div class="signpost"><div class="content">Content</div></div>

<div class="signpost"><div class="content">Content</div></div>

*/ ?>


</div>
<!--<footer class="posts-footer"><a href="" title="More" class="ul-button">MORE</a></footer>
<footer class="posts-footer"><span class="loader">Loading More</span></footer>-->
</section>
<section id="about" class="gutter">
	<div class="container">
<?php echo $post->post_content ?>
<div class="underline"><span></span></div>
<figure><img src="<?php echo get_template_directory_uri(); ?>/images/shop-front.jpg" /></figure>
</div>
	</section>
	<section id="newsletter-signup">
    <h2>SIGN UP FOR OUR NEWSLETTER</h2>
		<div class="container">
<?php echo do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]') ?>
    </div>
</section>

</main>
<?php get_footer() ?>