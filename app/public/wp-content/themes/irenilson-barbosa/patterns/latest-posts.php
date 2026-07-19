<?php
/**
 * Title: Últimos Artigos
 * Slug: irenilson-barbosa/latest-posts
 * Categories: featured
 */
?>
<!-- wp:group -->
<div class="wp-block-group">
	<!-- wp:heading {"level":2,"style":{"typography":{"fontSize":"1rem","textTransform":"uppercase","letterSpacing":"0.05em"}},"textColor":"marrom-400"} -->
	<h2 class="wp-block-heading has-marrom-400-color has-text-color" style="font-size:1rem;letter-spacing:0.05em;text-transform:uppercase">Últimos artigos</h2>
	<!-- /wp:heading -->

	<!-- wp:query {"queryId":2,"query":{"perPage":5,"postsPerPage":5,"offset":4,"postType":"post","order":"desc","orderBy":"date","author":"","search":"","sticky":"","inherit":false},"metadata":{"name":"Lista de Artigos"}} -->
	<div class="wp-block-query">
		<!-- wp:post-template -->
			<!-- wp:group {"style":{"spacing":{"padding":{"bottom":"var:preset|spacing|40"}},"border":{"bottom":{"color":"var:preset|color|bege-300","width":"1px","style":"solid"}}}} -->
			<div class="wp-block-group" style="border-bottom-color:var(--wp--preset--color--bege-300);border-bottom-width:1px;border-bottom-style:solid;padding-bottom:var(--wp--preset--spacing--40)">
				<!-- wp:columns {"style":{"spacing":{"blockGap":"var:preset|spacing|40"}}} -->
				<div class="wp-block-columns">
					<!-- wp:column {"width":"180px"} -->
					<div class="wp-block-column" style="flex-basis:180px">
						<!-- wp:post-featured-image {"width":"100%","height":"120px","style":{"border":{"radius":"4px"}},"size":"medium"} /-->
					</div>
					<!-- /wp:column -->
					<!-- wp:column -->
					<div class="wp-block-column">
						<!-- wp:post-terms {"term":"category","style":{"typography":{"fontSize":"0.75rem","textTransform":"uppercase","letterSpacing":"0.05em"}}} /-->
						<!-- wp:post-title {"level":3,"isLink":true,"fontSize":"x-large"} /-->
						<!-- wp:post-excerpt {"moreText":null,"excerptLength":25} /-->
						<!-- wp:group {"layout":{"type":"flex","flexWrap":"wrap"},"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"typography":{"fontSize":"0.8rem"}} -->
						<div class="wp-block-group" style="font-size:0.8rem">
							<!-- wp:post-author {"showAvatar":false,"showBio":false} /-->
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
