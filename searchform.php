		<section role="search">
			<form method="get" id="searchform2" action="<?php bloginfo('url'); ?>">
				<div id="search">
					<label for="s"></label><br />
					<input id="s" name="s" type="text" class="field" value="<?php the_search_query(); ?>" size="25" maxlength="100" /><br />
                    <input id="cn-search-submit" id="cn-search-submit" type="submit" value="<?php _e("Search"); ?>" />
					
				</div>
			</form>
		</section>