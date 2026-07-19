<?php
/**
 * Title: Artigos Recentes — Grid de Cards
 * Slug: irenilson-barbosa/card-grid-posts
 * Categories: featured
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"bottom":"var:preset|spacing|60"}}}} -->
<div class="wp-block-group" style="padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:group {"layout":{"type":"flex","justifyContent":"space-between"},"style":{"spacing":{"margin":{"bottom":"var:preset|spacing|40"}}}} -->
	<div class="wp-block-group" style="margin-bottom:var(--wp--preset--spacing--40)">
		<!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"1rem","textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"}},"textColor":"marrom-800"} -->
		<h2 class="wp-block-heading has-marrom-800-color has-text-color" style="font-size:1rem;font-weight:600;letter-spacing:0.08em;text-transform:uppercase">Artigos recentes</h2>
		<!-- /wp:heading -->
		<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.85rem"}},"textColor":"verde-700"} -->
		<p class="has-verde-700-color has-text-color" style="font-size:0.85rem"><a href="/artigos/">Ver todos →</a></p>
		<!-- /wp:paragraph -->
	</div>
	<!-- /wp:group -->

	<!-- wp:query {"queryId":1,"query":{"perPage":3,"postsPerPage":3,"offset":1,"postType":"post","order":"desc","orderBy":"date","sticky":"","inherit":false},"metadata":{"name":"Grid Artigos"}} -->
	<div class="wp-block-query">
		<!-- wp:post-template {"layout":{"type":"grid","columnCount":3}} -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"backgroundColor":"branco","border":{"radius":"10px"},"padding":{"top":"0","right":"0","bottom":"var:preset|spacing|40","left":"0"}} -->
			<div class="wp-block-group has-branco-background-color has-background" style="border-radius:10px;padding-top:0;padding-right:0;padding-bottom:var(--wp--preset--spacing--40);padding-left:0">
				<!-- wp:post-featured-image {"width":"100%","height":"200px","style":{"border":{"radius":"10px 10px 0 0","border":{"bottom":{"style":"none"}}}}} /-->
				<!-- wp:group {"style":{"spacing":{"padding":{"right":"var:preset|spacing|30","left":"var:preset|spacing|30","top":"var:preset|spacing|30"}}}} -->
				<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--30);padding-right:var(--wp--preset--spacing--30);padding-left:var(--wp--preset--spacing--30)">
					<!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"0.7rem","textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"}},"textColor":"verde-700"} /-->
					<!-- wp:post-title {"level":3,"isLink":true,"fontSize":"large","style":{"spacing":{"margin":{"top":"var:preset|spacing|10"}}}} /-->
					<!-- wp:post-excerpt {"moreText":null,"excerptLength":18,"style":{"typography":{"fontSize":"0.9rem"}}} /-->
					<!-- wp:post-date {"format":"j F Y","style":{"typography":{"fontSize":"0.8rem"}},"textColor":"marrom-400"} /-->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->
</div>
<!-- /wp:group -->
