<?php
/**
 * Title: Hero — Destaque Principal
 * Slug: irenilson-barbosa/hero
 * Categories: featured
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|70","bottom":"var:preset|spacing|60"}}}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--70);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:query {"queryId":0,"query":{"perPage":1,"postsPerPage":1,"offset":0,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","sticky":"","inherit":false},"metadata":{"name":"Hero Destaque"}} -->
	<div class="wp-block-query">
		<!-- wp:post-template -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"constrained"}} -->
			<div class="wp-block-group">
				<!-- wp:post-featured-image {"size":"full","style":{"border":{"radius":"8px"}}} /-->
				<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap"},"style":{"spacing":{"blockGap":"var:preset|spacing|20"}}} -->
				<div class="wp-block-group">
					<!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"0.75rem","textTransform":"uppercase","letterSpacing":"0.05em"}}} /-->
				</div>
				<!-- /wp:group -->
				<!-- wp:post-title {"level":1,"isLink":true,"fontSize":"xxx-large"} /-->
				<!-- wp:post-excerpt {"moreText":"Continuar lendo →"} /-->
				<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"typography":{"fontSize":"0.875rem"}} -->
				<div class="wp-block-group" style="font-size:0.875rem">
					<!-- wp:post-author {"showAvatar":false,"showBio":false} /-->
					<!-- wp:post-date {"format":"j F Y"} /-->
				</div>
				<!-- /wp:group -->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->
</div>
<!-- /wp:group -->
