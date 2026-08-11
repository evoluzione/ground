<?php
return [
	'automatic-feed-links' => true,
	'theme-color' => '#fafafa',

	/*
	 * Debug-only guard rail for the navigation helpers (ground_terms(),
	 * ground_subpages()): past this many items they log a warning rather than
	 * quietly getting slower. They never truncate — slicing the flat result
	 * before the hierarchy is built drops children whose parent fell outside
	 * the slice, which is worse than a slow menu. Set to 0 to disable.
	 */
	'nav_tree_warn_at' => 500,
];
