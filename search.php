<?php get_header(); ?>

<div class="container">
<div class="row">

<main role="main" property="mainContentOfPage" class="col-md-9 col-md-push-3">
    <!-- MainContentStart -->
	<?php if (have_posts()) : ?>

			<!-- Content title begins / Début du titre du contenu -->
			<h1 id="wb-cont"><?php _e("Search results", 'wet-boew'); ?></h1>
			<!-- Content Title ends / Fin du titre du contenu -->
			
<!-- clf2-nsi2 theme begins / Début du thème clf2-nsi2 -->
			<?php while (have_posts()) : the_post(); ?>
			<article id="article-<?php the_ID(); ?>">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permalink to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<pre><?php _e("Date issued:", 'wet-boew'); ?><time datetime="<?php the_time('Y-m-d') ?>"><?php the_time('j F Y') ?></time></pre>
				<?php the_excerpt('<p>' . __("Read this article", 'wet-boew') . ' &raquo;</p>'); ?>
				<p class="postmetadata"><?php the_tags(__("Tags:", 'wet-boew'), ', ', '<br />'); ?> <?php _e("In:"); ?> <?php the_category(', ') ?> | <?php edit_post_link(__("Edit:", 'wet-boew'), '', ' | '); ?>  <?php comments_popup_link(__("No comments", 'wet-boew') . ' &raquo;', __("1 comment", 'wet-boew') . ' &raquo;', __("% comments", 'wet-boew') . ' &raquo;', 'comments-link', __("Comments are closed.", 'wet-boew')); ?></p>
			</article>	
			<?php endwhile; ?>
			
			<div class="page">
				<div class="left"><?php next_posts_link('&laquo; ' . __("Older entries", 'wet-boew')) ?></div>
				<div class="right"><?php previous_posts_link(__("Newer entries", 'wet-boew') . ' &raquo;') ?></div>
			</div>   
	<?php else : ?>

			<!-- Content title begins / Début du titre du contenu -->
			<h1 id="wb-cont" class="center"><?php _e("Not found", 'wet-boew'); ?></h1>
			<!-- Content Title ends / Fin du titre du contenu -->

<!-- clf2-nsi2 theme begins / Début du thème clf2-nsi2 -->
			<p class="center"><?php _e("Sorry, no posts matched your criteria.", 'wet-boew'); ?></p>
	<?php endif; ?>
    <!-- Date Modified begins / Début de la date de modification -->
			<!-- Date Modified begins / Début de la date de modification -->
			<dl id="wb-dtmd" role="contentinfo" property="dateModified">
            <dt><?php _e("Date modified:", 'wet-boew'); ?></dt> 
                 <dd>
                   <time><?php the_time('Y-m-d') ?></time>
                 </dd>
            </dl>
		</main>
		<!-- Main content ends / Fin du contenu principal --> 

<?php get_sidebar(); ?>
</div></div>
<?php get_footer(); ?>
