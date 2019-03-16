<?php get_header(); ?>
<main role="main" property="mainContentOfPage" class="container">
	<?php if (have_posts()) : ?>
		<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
		<?php /* If this is a category archive */ if (is_category()) { ?>
	<h1 id="wb-cont"><?php _e("Section:", "wet-boew"); ?> <?php single_cat_title(); ?></h1>
		<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?> 
	<h1 id="wb-cont"><?php _e("Tag:", "wet-boew"); ?> <?php single_tag_title(); ?></h1>
		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
	<h1 id="wb-cont"><?php _e("Day:", "wet-boew"); ?> <?php the_time('F j, Y'); ?></h1>
		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
	<h1 id="wb-cont"><?php _e("Month:", "wet-boew"); ?> <?php the_time('F Y'); ?></h1>
		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
	<h1 id="wb-cont"><?php _e("Year:", "wet-boew"); ?> <?php the_time('Y'); ?></h1>
		<?php /* If this is an author archive */ } elseif (is_author()) { ?>
	<h1 id="wb-cont"><?php _e("Author:", "wet-boew"); ?> <?php the_author() ?></h1>
		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	<h1 id="wb-cont"><?php _e("Blog archive", "wet-boew"); ?></h1>
		<?php } ?>

		<?php while (have_posts()) : the_post(); ?>

			<section id="article-<?php the_ID(); ?>">
				<h2><?php the_title(); ?></h2>
	
				<p><small><?php 
					the_category(', ');
					
					the_tags( ' - (', ', ', ') - ' );
					
					echo (" <em>"); 
					
					comments_popup_link(
						__("No comments", "wet-boew" ), 
						__("1 comment", "wet-boew" ), 
						__("% comments", "wet-boew" ), 
						'comments-link', 
						__("Comments are closed.", "wet-boew" )
					);

					echo ("</em>"); 
				?></small></p>
				

				<p><a href="<?php the_permalink() ?>"> <?php echo( strip_tags( get_the_excerpt() ) );	?></a></p>
				
				<p><?php _e("Published on:", "wet-boew"); ?> <time><?php the_time(get_option('date_format')) ?></time>, <?php _e("by", "wet-boew"); ?> <?php the_author() ?></p>

			</section>
		<?php endwhile; ?> 
				
			<nav>
				<ul>
					<li><?php next_posts_link(__("Older articles", "wet-boew")) ?></li>
					<li><?php previous_posts_link(__("Newer articles", "wet-boew")) ?></li>
				</ul>
			</nav>    
	<?php else :
			if ( is_category() ) { // If this is a category archive
				printf('<h1 id="wb-cont">' . __("No articles in the category: %s", "wet-boew") . '</h1>', single_cat_title('',false));
			} else if ( is_date() ) { // If this is a date archive
				printf('<h1 id="wb-cont">' . __("No articles for this date: %s", "wet-boew") . '</h1>', the_time(get_option('date_format')));
			} else if ( is_author() ) { // If this is a category archive
				$userdata = get_userdatabylogin(get_query_var('author_name'));
				printf('<h1 id="wb-cont">' . __("%s did not write an article", "wet-boew") . '</h1>', $userdata->display_name);
			} else {
				echo('<h1 id="wb-cont">' . __("Not found", "wet-boew") . '</h1>');
			}
			get_search_form();

		endif;
	?>

	<div class="clearfix"></div>
	<dl id="wb-dtmd" role="contentinfo" property="dateModified">
		<dt><?php _e( "Last updated:", "wet-boew" ); ?></dt> 
		 <dd>
		   <time><?php the_time(get_option('date_format')) ?></time>
		 </dd>
	</dl>
</main>
<?php get_footer(); ?>