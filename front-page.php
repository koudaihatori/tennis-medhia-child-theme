<!DOCTYPE html>
<html lang="ja">
<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php get_template_part( 'ogp' ); ?> 

<?php if( is_home() ): ?>
<?php if( ! get_theme_mod('desc_text') == "" ): ?>
<meta name="description" itemprop="description" content="<?php echo get_theme_mod('desc_text'); ?>">
<?php endif; ?>
<?php elseif( is_front_page() ): ?>
<?php if ( ! get_post_meta($post->ID, 'post_desc',true) == null ) :?>
<meta name="description" itemprop="description" content="<?php echo get_post_meta($post->ID, 'post_desc',true) ?>" >
<?php elseif( ! get_theme_mod('desc_text') == "" ): ?>
<meta name="description" itemprop="description" content="<?php echo get_theme_mod('desc_text'); ?>">
<?php elseif( ! empty($post->post_excerpt) ) : ?>
<meta name="description" itemprop="description" content="<?php echo $post->post_excerpt; ?>" >
<?php else: ?>
<meta name="description" itemprop="description" content="<?php echo jin_auto_desc_func(); ?>" >
<?php endif; ?>
<?php elseif( is_single() || is_page() ): ?>
<?php if ( ! get_post_meta($post->ID, 'post_desc',true) == null ) :?>
<meta name="description" itemprop="description" content="<?php echo get_post_meta($post->ID, 'post_desc',true) ?>" >
<?php elseif( ! empty($post->post_excerpt) ) : ?>
<meta name="description" itemprop="description" content="<?php echo $post->post_excerpt; ?>" >
<?php else: ?>
<meta name="description" itemprop="description" content="<?php echo jin_auto_desc_func(); ?>" >
<?php endif; ?>
<?php elseif( is_category() ): ?>
<meta name="description" itemprop="description" content="<?php cps_category_desc(); ?>" >
<?php endif; ?>
<?php if ( is_single() || is_page() ): ?>
<?php if( ! get_post_meta($post->ID, 'jin_keyword',true) == null ) : ?>
<meta name="keywords" itemprop="keywords" content="<?php echo get_post_meta($post->ID, 'jin_keyword',true) ?>" >
<?php endif; ?>
<?php endif; ?>
<?php if( ! has_site_icon()): ?>
<link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico">
<?php endif; ?>
<?php if( is_singular('cta') ) :?>
<meta name="robots" content="noindex">
<?php endif; ?>
<?php if ( is_single() || is_page() ):?>
<?php if( ! get_post_meta($post->ID, 'post_noindex',true) == null ): ?>
<meta name="robots" content="noindex">
<?php endif; ?>
<?php endif; ?>
<?php if( is_category() && get_option('seo_category_all_noindex') == "all_noindex" ): ?>
	<?php if( get_option('seo_category_index') == null ) : ?>
<meta name="robots" content="noindex">
	<?php else: ?>
	<?php
		$cat_id = strval(get_query_var('cat'));
		$noindex_cat_id_each = explode(",", get_option('seo_category_index'));
		if ( ! in_array( $cat_id , $noindex_cat_id_each) ) {
			echo '<meta name="robots" content="noindex">';
		}
	?>
	<?php endif; ?>
<?php endif; ?>
<?php if( is_tag() && get_option('seo_tag_all_noindex') == "all_noindex" ): ?>
	<?php if( get_option('seo_tag_index') == null ) : ?>
<meta name="robots" content="noindex">
	<?php else: ?>
	<?php
		$tag_id = strval( get_query_var( 'tag_id' ) );
		$noindex_tag_id_each = explode( ",", get_option( 'seo_tag_index' ) );
		if ( ! in_array( $tag_id , $noindex_tag_id_each) ) {
			echo '<meta name="robots" content="noindex">';
		}
	?>
	<?php endif; ?>
<?php endif; ?>

<?php wp_head(); ?>
	
<!--カエレバCSS-->
<?php if( ! get_option('kaereba_design') == null ) : ?>
<link href="<?php echo get_template_directory_uri() . '/css/kaereba.css' ?>" rel="stylesheet" />
<?php endif; ?>
<!--アプリーチCSS-->
<?php if( ! get_option('appreach_design') == null ) : ?>
<link href="<?php echo get_template_directory_uri() . '/css/appreach.css' ?>" rel="stylesheet" />
<?php endif; ?>

<?php if( ! get_option('space_head') == null ) : ?>
<?php echo get_option('space_head'); ?>
<?php endif; ?>
	
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-121626242-14"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-121626242-14');
</script>

<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/front-page.css">


</head>
<body <?php body_class(); ?> id="<?php echo is_font_style(); ?>">
<div id="wrapper">

	<?php if ( is_mobile() ) : ?>
		<span class="headsearch jin-sp-design <?php is_animation_style(); ?> <?php is_top_navi_sc_display(); ?>">
			<?php get_search_form(); ?>
		</span>
		<?php if( has_nav_menu('glonavi') ) : ?>
			<input type="checkbox" class="jin-sp-design" id="navtoggle">
			<label for="navtoggle" class="sp-menu-open <?php is_sp_header_fix(); ?>"><span class="cps-icon-bar <?php is_animation_style(); ?>"></span><span class="cps-icon-bar <?php is_animation_style(); ?>"></span><span class="cps-icon-bar <?php is_animation_style(); ?>"></span></label>
			<label for="navtoggle" class="sp-menu-close <?php is_sp_header_fix(); ?>"></label>
	
			
			<div class="sp-menu-box">
				<div class="sp-menu-title ef">MENU</div>
				<?php wp_nav_menu( array(
					'theme_location' =>'glonavi',
					'container'      =>'nav',
					'container_class'=>'fixed-content ef',
					'items_wrap'     =>'<ul class="menu-box">%3$s</ul>') );
				?>
				<?php if ( get_theme_mod('top_navi_sns_display') == "tn_sns_on" ): ?>
				<div class="sp-sns-menu">
					<ul>
						<?php if ( get_option('tw_page_url') ): ?>
						<li class="pro-tw"><a href="<?php echo get_option('tw_page_url'); ?>" target="_blank"><i class="jic-type jin-ifont-twitter"></i></a></li>
						<?php endif; ?>
						<?php if ( get_option('fb_page_url') ): ?>
						<li class="pro-fb"><a href="<?php echo get_option('fb_page_url'); ?>" target="_blank"><i class="jic-type jin-ifont-facebook" aria-hidden="true"></i></a></li>
						<?php endif; ?>
						<?php if ( get_option('insta_page_url') ): ?>
						<li class="pro-insta"><a href="<?php echo get_option('insta_page_url'); ?>" target="_blank"><i class="jic-type jin-ifont-instagram" aria-hidden="true"></i></a></li>
						<?php endif; ?>
						<?php if ( get_option('youtube_page_url') ): ?>
						<li class="pro-youtube"><a href="<?php echo get_option('youtube_page_url'); ?>" target="_blank"><i class="jic-type jin-ifont-youtube" aria-hidden="true"></i></a></li>
						<?php endif; ?>
						<?php if ( get_option('line_page_url') ): ?>
						<li class="pro-line"><a href="<?php echo get_option('line_page_url'); ?>" target="_blank"><i class="jic-type jin-ifont-line" aria-hidden="true"></i></a></li>
						<?php endif; ?>
						<?php if ( get_option('contact_page_url') ): ?>
						<li class="pro-contact"><a href="<?php echo get_option('contact_page_url'); ?>" target="_blank"><i class="jic-type jin-ifont-mail" aria-hidden="true"></i></a></li>
						<?php endif; ?>
					</ul>
				</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
	
	<?php endif; ?>
	
	<div id="scroll-content" class="<?php is_animation_style(); ?>">
    


		<!--ヘッダー-->
        <div class="lp-header">
            <?php if( is_header_design() == 'header_style1' ): ?>
                <?php get_template_part('include/headerstyle/header-style1'); ?>
            <?php elseif( is_header_design() == 'header_style2' ): ?>
                <?php get_template_part('include/headerstyle/header-style2'); ?>
            <?php elseif( is_header_design() == 'header_style3' ): ?>
                <?php get_template_part('include/headerstyle/header-style3'); ?>
            <?php elseif( is_header_design() == 'header_style4' ): ?>
                <?php get_template_part('include/headerstyle/header-style4'); ?>
            <?php elseif( is_header_design() == 'header_style5' ): ?>
                <?php get_template_part('include/headerstyle/header-style5'); ?>
            <?php elseif( is_header_design() == 'header_style6' ): ?>
                <?php get_template_part('include/headerstyle/header-style6'); ?>
            <?php elseif( is_header_design() == 'header_style7' ): ?>
                <?php get_template_part('include/headerstyle/header-style7'); ?>
            <?php elseif( is_header_design() == 'header_style8' ): ?>
                <?php get_template_part('include/headerstyle/header-style8'); ?>
            <?php elseif( is_header_design() == 'header_style9' ): ?>
                <?php get_template_part('include/headerstyle/header-style9'); ?>
            <?php elseif( is_header_design() == 'header_style10' ): ?>
                <?php get_template_part('include/headerstyle/header-style10'); ?>
            <?php elseif( is_header_design() == 'header_style11' ): ?>
                <?php get_template_part('include/headerstyle/header-style11'); ?>
            <?php endif; ?>

		<!--ヘッダー-->

		<div class="clearfix"></div>

		<?php if( ! is_page_template('lp.php') ) :?>
	
			<?php if( is_home() || is_front_page() ): ?>
				<?php get_template_part('include/head/pickup-contents'); ?>
			<?php else: ?>
				<?php if( is_pickup_child() == 'child_none') : ?>
				<?php else: ?>
					<?php get_template_part('include/head/pickup-contents'); ?>
				<?php endif; ?>
			<?php endif; ?>

		<?php endif; ?>



            <div class="BlockHead__ttlArea">
                <h1 class="BlockHead__title--col-wh">TENISH<span>日本最大級の<br class="Display--sp">テニス専門ポータルメディア</span></h1>
                    <div class="BlockHead__middle">
                    <div class="BlockHead__circle">スクール<span>3,000</span>件掲載</div>
                    <div class="BlockHead__circle">簡単<span>わかる</span>お得</div>
                    <div class="BlockHead__circle">日本<span>最大級</span>メディア</div>
                </div>
            </div>            
        </div>
<!-- 
    <section id="sec01" class="sec">
	<div class="head">
		<div class="headsub">- PICK UP -</div>
		<h2 class="headtitle border-ulstr">TENISHおすすめ記事</h2>
	</div>
	<div class="inner">
		<div class="head_wrap">
			<p class="subtitle inner-sp">これさえ読めば、もう失敗することはない！！<br class="sp">TENISHの<span class="fc-orange">厳選特集記事</span>です！</p>
        </div>
    </div>

    </section> -->



    <div id="contents">

    <!--メインコンテンツ-->
        <main id="onecolumn960lp" class="main-contents <?php echo is_article_design(); ?> <?php is_animation_style(); ?>" itemprop="mainContentOfPage">
            <section class="cps-post-box hentry">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <article class="cps-post">
                        
                        <div class="cps-post-main-box">
                            <div class="cps-post-main entry-content <?php echo esc_html(get_option('font_size'));?> <?php echo esc_html(get_option('font_size_sp'));?>" itemprop="articleBody">

                                <?php the_content(); ?>
                                
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
                <?php else : ?>
                    <article class="cps-post">
                        <h1 class="post-title">記事が見つかりませんでした。</h1>
                    </article>
                <?php endif; ?>
            </section>
            
            <?php if( is_bread_display() == "exist") :?>
            <?php if( is_mobile() ): ?>
            <?php get_template_part('include/breadcrumb'); ?>
            <?php endif; ?>
            <?php endif; ?>
        </main>

    </div>







<?php get_footer(); ?>