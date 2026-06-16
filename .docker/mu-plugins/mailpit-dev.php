<?php
/**
 * Mailpit (dev only) — route all outgoing mail to the Mailpit container
 * instead of attempting real delivery. UI: http://localhost:8025
 */
add_action( 'phpmailer_init', function ( $phpmailer ) {
	$phpmailer->isSMTP();
	$phpmailer->Host     = 'mailpit';
	$phpmailer->Port     = 1025;
	$phpmailer->SMTPAuth = false;
} );
