<?php get_header(); ?>

<main role="main" property="mainContentOfPage" class="container">
	<?php if (have_posts()) : the_post(); ?>

		<h1 id="wb-cont" property="name"><?php the_title(); ?></h1>
		<?php if ( has_post_thumbnail() ) { ?>
		<div class="row">
			<div class="col-xs-12">
				<img class="img-responsive mrgn-bttm-md" src="<?php echo( wp_get_attachment_image_src( get_post_thumbnail_id( $post ), 'full' )[ 0 ] ); ?>" alt="" />
			</div>
		</div>
        <?php } ?>
		<div class="row">
			<div class="col-md-8">
		<?php the_content(); ?>
		
	<?php endif; ?>

		<div class="clearfix"></div>
	<dl id="wb-dtmd" class="pull-right" role="contentinfo" property="dateModified">
		<dt><?php _e( "Modified on:", "wet-boew" ); ?></dt> 
		 <dd>
		   <time><?php the_time(get_option('date_format')) ?></time>
		 </dd>
	</dl>
	</div>

    <?php get_sidebar(); ?>
	</div>
</main>




<?php get_footer(); ?>
