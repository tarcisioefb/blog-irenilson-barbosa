<?php
/**
 * Title: Grid de Destaques
 * Slug: irenilson-barbosa/featured-grid
 * Categories: featured
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"bottom":"var:preset|spacing|70"}}}} -->
<div class="wp-block-group" style="padding-bottom:var(--wp--preset--spacing--70)">
	<!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"1rem","textTransform":"uppercase","letterSpacing":"0.05em"}},"textColor":"marrom-400"} -->
	<h2 class="wp-block-heading has-marrom-400-color has-text-color" style="font-size:1rem;letter-spacing:0.05em;text-transform:uppercase">Em destaque</h2>
	<!-- /wp:heading -->

	<!-- wp:query {"queryId":1,"query":{"perPage":3,"postsPerPage":3,"offset":1,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","sticky":"","inherit":false},"metadata":{"name":"Grid Destaques"}} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"backgroundColor":"branco","border":{"radius":"8px"},"padding":{"top":"var:preset|spacing|40","right":"var:preset|spacing|40","bottom":"var:preset|spacing|40","left":"var:preset|spacing|40"}} -->
			<div class="wp-block-group has-branco-background-color has-background" style="border-radius:8px;padding-top:var(--wp--preset--spacing--40);padding-right:var(--wp--preset--spacing--40);padding-bottom:var(--wp--preset--spacing--40);padding-left:var(--wp--preset--spacing--40)">
				<!-- wp:post-featured-image {"width":"100%","height":"200px","style":{"border":{"radius":"4px"}}} /-->
				<!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"0.75rem","textTransform":"uppercase","letterSpacing":"0.05em"}}} /-->
				<!-- wp:post-title {"level":3,"isLink":true,"fontSize":"large"} /-->
				<!-- wp:post-excerpt {"moreText":null,"excerptLength":15} /-->
				<!-- wp:post-date {"format":"j F Y","style":{"typography":{"fontSize":"0.8rem"}}} /-->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->
</div>
<!-- /wp:group -->
