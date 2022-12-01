<?php

/**
 * Extend FacetWP
 *
 * @package https://facetwp.com/
 */

/**
 * How to hide empty facets: https://facetwp.com/help-center/facets/
 */
function ground_facetwp_hide_empty_filters() {   ?>
	<script>
			(function($) {
		document.addEventListener('facetwp-loaded', function() {
		  $.each(FWP.settings.num_choices, function(key, val) {
			var $facet = $('.facetwp-facet-' + key);
			var $wrap = $facet.closest('.widget_block');
			var $flyout = $facet.closest('.flyout-row');
			if ($wrap.length || $flyout.length) {
			  var $which = $wrap.length ? $wrap : $flyout;
			  (0 === val) ? $which.hide() : $which.show();
			}
		  });
		});
	  })(jQuery);

	</script>
	<?php
}

add_action( 'wp_head', 'ground_facetwp_hide_empty_filters', 100 );



/**
 * How to add labels / headings above each facet: https://facetwp.com/help-center/facets/
 */

function ground_facetwp_add_facet_labels() {
	?>
	  <script>
		(function($) {
		  $(document).on('facetwp-loaded', function() {
			$('.facetwp-facet').each(function() {
			  var facet = $(this);
			  var facet_name = facet.attr('data-name');
			  var facet_type = facet.attr('data-type');
			  var facet_label = FWP.settings.labels[facet_name];
			  if (facet_type !== 'pager' && facet_type !== 'sort') {
				if (facet.closest('.facet-wrap').length < 1 && facet.closest('.facetwp-flyout').length < 1) {
				  facet.wrap('<div class="facet-wrap"></div>');
				  facet.before('<h3 class="facet-label">' + facet_label + '</h3>');
				}
			  }
			});
		  });
		})(jQuery);
	  </script>
	<?php
}

add_action( 'wp_head', 'ground_facetwp_add_facet_labels', 100 );


/**
 * Extend facetwp_shortcode_html. example: [facetwp facet="colors" title="Filtra per Colore"]
 */
// add_filter(
// 'facetwp_shortcode_html',
// function( $output, $atts ) {
// $title = '';
// if ( $atts['title'] ) {
// $title = '<h3 class="facet-label">' . $atts['title'] . '</h3>';
// }
// return $title . $output;
// },
// 10,
// 2
// );
