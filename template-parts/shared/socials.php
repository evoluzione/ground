<?php if ( GROUND_SOCIAL_LINKEDIN_URL || GROUND_SOCIAL_FACEBOOK_URL || GROUND_SOCIAL_TWITTER_URL || GROUND_SOCIAL_INSTAGRAM_URL || GROUND_SOCIAL_YOUTUBE_URL ) : ?>

	<div class="lg:flex items-center justify-center lg:space-x-6">

		<p class="pr-3 text-center mb-2 text-sm lg:text-xs lg:pl-6 lg:text-left text-quaternary lg:mb-0"><?php _e( 'Follow us on social networks', 'ground' ); ?></p>

		<div class="flex justify-center lg:justify-start space-x-3">
			<?php if ( GROUND_SOCIAL_LINKEDIN_URL ) : ?>
				<span class="inline-block">
					<a class="h-10 w-10 rounded-full text-white active:text-white focus:text-white bg-blue-600 hover:text-white flex items-center" href="<?php echo GROUND_SOCIAL_LINKEDIN_URL; ?>" target="_blank" aria-label="<?php esc_attr_e( 'Icon social linkedin', 'ground' ); ?>">
						<?php ground_icon( 'linkedin', 'mx-auto', 'social' ); ?>
					</a>
				</span>
			<?php endif; ?>

			<?php if ( GROUND_SOCIAL_FACEBOOK_URL ) : ?>
				<span class="inline-block">
					<a class="h-10 w-10 rounded-full text-white active:text-white focus:text-white bg-blue-500 hover:text-white flex items-center" href="<?php echo GROUND_SOCIAL_FACEBOOK_URL; ?>" target="_blank" aria-label="<?php esc_attr_e( 'Icon social facebook', 'ground' ); ?>">
						<?php ground_icon( 'facebook', 'mx-auto', 'social' ); ?>
					</a>
				</span>
			<?php endif; ?>

			<?php if ( GROUND_SOCIAL_TWITTER_URL ) : ?>
				<span class="inline-block">
					<a class="h-10 w-10 rounded-full text-white active:text-white focus:text-white bg-blue-400 p-2 hover:text-white flex items-center" href="<?php echo GROUND_SOCIAL_TWITTER_URL; ?>" target="_blank" aria-label="<?php esc_attr_e( 'Icon social twitter', 'ground' ); ?>">
						<?php ground_icon( 'twitter', 'mx-auto', 'social' ); ?>
					</a>
				</span>
			<?php endif; ?>

			<?php if ( GROUND_SOCIAL_INSTAGRAM_URL ) : ?>
				<span class="inline-block">
					<a class="h-10 w-10 rounded-full text-white active:text-white focus:text-white bg-pink-500 p-2 hover:text-white flex items-center" href="<?php echo GROUND_SOCIAL_INSTAGRAM_URL; ?>" target="_blank" aria-label="<?php esc_attr_e( 'Icon social instagram', 'ground' ); ?>">
						<?php ground_icon( 'instagram', 'mx-auto', 'social' ); ?>
					</a>
				</span>
			<?php endif; ?>

			<?php if ( GROUND_SOCIAL_YOUTUBE_URL ) : ?>
				<span class="inline-block">
					<a class="h-10 w-10 rounded-full text-white active:text-white focus:text-white bg-red-500 p-2 hover:text-white flex items-center" href="<?php echo GROUND_SOCIAL_YOUTUBE_URL; ?>" target="_blank" aria-label="<?php esc_attr_e( 'Icon social youtube', 'ground' ); ?>">
						<?php ground_icon( 'youtube', 'mx-auto', 'social' ); ?>
					</a>
				</span>
			<?php endif; ?>


		</div>

	</div>

<?php endif; ?>
