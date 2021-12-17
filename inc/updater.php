<?php
$ground_update_checker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/evoluzione/ground/',
	GROUND_TEMPLATE_PATH,
	'ground'
);

$ground_update_checker->getVcsApi()->enableReleaseAssets();
// $ground_update_checker->setBranch( 'feature/2.0' );
// $ground_update_checker->setBranch( 'master' );
