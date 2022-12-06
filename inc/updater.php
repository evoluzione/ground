<?php
/**
 * Updater
 * https://github.com/YahnisElsts/plugin-update-checker
 *
 * @package Ground
 */

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$ground_update_checker = PucFactory::buildUpdateChecker(
	'https://github.com/evoluzione/ground/',
	GROUND_TEMPLATE_PATH,
	'ground'
);

$ground_update_checker->setBranch('master');
