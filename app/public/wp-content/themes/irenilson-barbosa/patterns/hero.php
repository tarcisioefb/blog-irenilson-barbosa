<?php
/**
 * Title: Hero — Destaque Principal
 * Slug: irenilson-barbosa/hero
 * Categories: featured
 */
?>
<!-- wp:group {"style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60"}},"layout":{"type":"constrained"}}} -->
<div class="wp-block-group" style="padding-top:var(--wp--preset--spacing--60);padding-bottom:var(--wp--preset--spacing--60)">
	<!-- wp:query {"queryId":0,"query":{"perPage":1,"postsPerPage":1,"offset":0,"postType":"post","order":"desc","orderBy":"date","sticky":"","inherit":false},"metadata":{"name":"Hero"}} -->
	<div class="wp-block-query">
		<!-- wp:post-template -->
			<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"backgroundColor":"branco","border":{"radius":"12px"},"padding":{"top":"var:preset|spacing|50","right":"var:preset|spacing|50","bottom":"var:preset|spacing|50","left":"var:preset|spacing|50"}} -->
			<div class="wp-block-group has-branco-background-color has-background" style="border-radius:12px;padding-top:var(--wp--preset--spacing--50);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--50);padding-left:var(--wp--preset--spacing--50)">
				<!-- wp:columns {"style":{"spacing":{"blockGap":"var:preset|spacing|50"}}} -->
				<div class="wp-block-columns">
					<!-- wp:column {"width":"55%"} -->
					<div class="wp-block-column" style="flex-basis:55%">
						<!-- wp:post-featured-image {"size":"large","style":{"border":{"radius":"8px"}},"height":"400px"} /-->
					</div>
					<!-- /wp:column -->
					<!-- wp:column {"width":"45%","verticalAlignment":"center"} -->
					<div class="wp-block-column is-vertically-aligned-center" style="flex-basis:45%">
						<!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"0.75rem","textTransform":"uppercase","letterSpacing":"0.08em","fontWeight":"600"}},"textColor":"verde-700"} /-->
						<!-- wp:post-title {"level":1,"isLink":true,"fontSize":"xx-large","style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} /-->
						<!-- wp:post-excerpt {"moreText":"Continuar lendo →","style":{"spacing":{"margin":{"top":"var:preset|spacing|20"}}}} /-->
						<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap"},"style":{"spacing":{"blockGap":"8px"}},"typography":{"fontSize":"0.85rem"},"textColor":"marrom-400"} -->
						<div class="wp-block-group has-marrom-400-color has-text-color" style="font-size:0.85rem">
							<!-- wp:post-author {"showAvatar":false,"showBio":false} /-->
							<!-- wp:paragraph {"style":{"typography":{"fontSize":"0.85rem"}}} -->
							<p style="font-size:0.85rem">·</p>
							<!-- /wp:paragraph -->
							<!-- wp:post-date {"format":"j F Y"} /-->
						</div>
						<!-- /wp:group -->
					</div>
					<!-- /wp:column -->
				</div>
				<!-- /wp:columns -->
			</div>
			<!-- /wp:group -->
		<!-- /wp:post-template -->
	</div>
	<!-- /wp:query -->
</div>
<!-- /wp:group -->
