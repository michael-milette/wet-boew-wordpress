<?php get_header(); ?>

<main role="main" property="mainContentOfPage" class="container">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<h1 id="wb-cont" property="name"><?php the_title(); ?></h1>
			
			<?php the_content(); ?>

			<?php wp_link_pages(array('before' => '<p><strong>' . __( "Pages:" ) . '</strong>', 'after' => '</p>', 'next_or_number' => 'number')); ?>
			
	<?php endwhile; endif; ?>

	<div class="clearfix"></div>
	<dl id="wb-dtmd" class="pull-right" role="contentinfo" property="dateModified">
		<dt><?php _e( "Modified on:", "wet-boew" ); ?></dt> 
		 <dd>
		   <time><?php the_time(get_option('date_format')) ?></time>
		 </dd>
	</dl>
</main>

<?php // get_sidebar(); ?>

<?php get_footer(); ?>
