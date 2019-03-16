<?php get_header(); ?>
<div class="container">
<div class="row">

<main role="main" property="mainContentOfPage" class="col-md-9 col-md-push-3">
    <!-- MainContentStart -->
			
			<!-- Content title begins / Début du titre du contenu -->
			<h1 id="wb-cont"><?php the_title(); ?></h1>
			<!-- Content Title ends / Fin du titre du contenu -->
			
<!-- clf2-nsi2 theme begins / Début du thème clf2-nsi2 -->
			<?php get_search_form(); ?>
			<section>
				<h2><?php _e("Months"); ?></h2>
				<ul>
					<?php wp_get_archives('type=monthly'); ?>
				</ul>
			</section>		
			<section>
				<h2><?php _e("Categories"); ?></h2>
				<ul>
					<?php wp_list_categories(); ?>
				</ul>
			</section>
			<section>
				<h2><?php _e("Tags"); ?></h2>
				<ul>
					<?php wp_tag_cloud('format=list'); ?>
				</ul>
			</section>
    <!-- Date Modified begins / Début de la date de modification -->
			<dl id="wb-dtmd" role="contentinfo" property="dateModified">
            <dt><?php _e("Date modified:"); ?></dt> 
                 <dd>
                   <time><?php the_time(get_option('date_format')) ?></time>
                 </dd>
            </dl>
			<!-- Date Modified ends / Fin de la date de modification -->
		</main>
		<!-- Main content ends / Fin du contenu principal --> 

<?php get_sidebar(); ?>
		</div></div>
<?php get_footer(); ?>