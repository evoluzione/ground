			</main>

			<?php
			/**
			 * Hook: ground_footer.
			 *
			 * @hooked ground_pre_footer - 5
			 * @hooked ground_newsletter - 8
			 * @hooked ground_footer_type - 10
			 */
			do_action( 'ground_footer' );
			?>

			</div> <!-- End [data-router-view]  -->

		</div> <!-- End [data-router-wrapper] -->

		<?php get_template_part( 'partials/search', 'form' ); ?>
		<?php
		// get_template_part( 'partials/modal' );
		?>
		<?php
		// get_template_part( 'partials/cursor' );
		?>
		<?php
		// get_template_part( 'partials/debug-grid' );
		?>

		<?php wp_footer(); ?>

	</body>

</html>
