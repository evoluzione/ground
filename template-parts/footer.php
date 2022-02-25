		</main>

		<?php
		/**
		 * Hook: ground_footer.
		 *
		 * @hooked ground_pre_footer - 5
		 * @hooked ground_newsletter - 8
		 * @hooked ground_footer_type - 10
		 * @hooked ground_search_form - 15
		 * @hooked ground_modal - 20
		 * @hooked ground_cursor - 25
		 * @hooked ground_debug_grid - 30
		 */
		do_action( 'ground_footer' );
		?>

		<?php wp_footer(); ?>

	</body>

</html>
