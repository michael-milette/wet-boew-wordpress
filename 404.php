<?php get_header(); ?>

<main role="main" property="mainContentOfPage" class="container">
	<h1 id="wb-cont" property="name"><span class="glyphicon glyphicon-warning-sign"></span> <?php _e("HTTP Error 404 - Article not found", "wet-boew" ); ?></h1>
	<p><?php _e("Unfortunately, the content you are looking for at this address does not exit. Either the content has been removed or you may have an error in the URL address.", "wet-boew"); ?></p>
	<aside>
		<h2><?php _e("Recent articles", "wet-boew"); ?></h2>
		<?php query_posts('cat=&showposts=5'); ?>
		<ul id="recentPosts">
			<?php while (have_posts()) : the_post(); ?>
			<li><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a> (<time datetime="<?php the_date(get_option('date_format'), '', ''); ?>" pubdate><?php the_time('F j, Y'); ?></time>)</li>
			<?php endwhile; ?>
		</ul>
	</aside>
	<dl id="wb-dtmd" role="contentinfo" property="dateModified">
	<dt><?php _e("Date modified:", "wet-boew"); ?></dt> 
		 <dd>
		   <time><?php the_time(get_option('date_format')) ?></time>
		 </dd>
	</dl>
</main>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>
