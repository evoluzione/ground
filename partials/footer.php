						</main>

						<div class="fixed bottom-0 right-0 z-50">

							<?php
							/**
							 * Hook: ground_notice.
							 */
							do_action( 'ground_notice' );
							?>
						</div>

						<?php
						/**
						 * Functions hooked in to ground_before_footer action
						 *
						 * @hooked ground_pre_footer - 10
						 */
							do_action( 'ground_before_footer' );
						?>

						<?php
						/**
						 * Functions hooked into ground_footer action
						 *
						 * @hooked ground_footer_type - 10
						 */
						do_action( 'ground_footer' );
						?>

						</div><!-- End [data-router-view]  -->

						</div><!-- End [data-router-wrapper] -->

						</div> <!-- End .scroll -->

						<?php get_template_part( 'partials/search', 'form' ); ?>
						<?php // get_template_part( 'partials/cursor' ); ?>
						<?php // get_template_part( 'partials/modal' ); ?>
						<?php // get_template_part( 'partials/debug-grid' ); ?>

						<?php wp_footer(); ?>

						</body>

						</html>
