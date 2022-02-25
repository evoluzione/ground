<?php if ( GROUND_SOCIAL_LINKEDIN_URL || GROUND_SOCIAL_FACEBOOK_URL || GROUND_SOCIAL_TWITTER_URL || GROUND_SOCIAL_INSTAGRAM_URL || GROUND_SOCIAL_YOUTUBE_URL ) : ?>

	<div class="lg:flex items-center justify-center lg:space-x-6">

		<p class="pr-3 text-center mb-2 text-sm lg:text-xs lg:pl-6 lg:text-left text-quaternary lg:mb-0"><?php _e( 'Seguici sui social network', 'ground' ); ?></p>

		<div class="flex justify-center lg:justify-start space-x-3">
			<?php if ( GROUND_SOCIAL_LINKEDIN_URL ) : ?>
				<span class="inline-block">
					<a class="h-10 w-10 rounded-full text-white bg-blue-600 hover:text-white flex items-center" href="<?php echo GROUND_SOCIAL_LINKEDIN_URL; ?>">
						<?php ground_icon( 'linkedin', 'mx-auto h-3', 'social' ); ?>
					</a>
				</span>
			<?php endif; ?>

			<?php if ( GROUND_SOCIAL_FACEBOOK_URL ) : ?>
				<span class="inline-block">
					<a class="h-10 w-10 rounded-full text-white bg-blue-500 hover:text-white flex items-center" href="<?php echo GROUND_SOCIAL_FACEBOOK_URL; ?>">
						<?php ground_icon( 'facebook', 'mx-auto h-4', 'social' ); ?>
					</a>
				</span>
			<?php endif; ?>

			<?php if ( GROUND_SOCIAL_TWITTER_URL ) : ?>
				<span class="inline-block">
					<a class="h-10 w-10 rounded-full text-white bg-blue-400 p-2 hover:text-white flex items-center" href="<?php echo GROUND_SOCIAL_TWITTER_URL; ?>">
						<?php ground_icon( 'twitter', 'mx-auto h-4', 'social' ); ?>
					</a>
				</span>
			<?php endif; ?>

			<?php if ( GROUND_SOCIAL_INSTAGRAM_URL ) : ?>
				<span class="inline-block">
					<a class="h-10 w-10 rounded-full text-white bg-pink-500 p-2 hover:text-white flex items-center" href="<?php echo GROUND_SOCIAL_INSTAGRAM_URL; ?>">
						<?php ground_icon( 'instagram', 'mx-auto h-4', 'social' ); ?>
					</a>
				</span>
			<?php endif; ?>

			<?php if ( GROUND_SOCIAL_YOUTUBE_URL ) : ?>
				<span class="inline-block">
					<a class="h-10 w-10 rounded-full text-white bg-red-500 p-2 hover:text-white flex items-center" href="<?php echo GROUND_SOCIAL_YOUTUBE_URL; ?>">
						<?php ground_icon( 'youtube', 'mx-auto', 'social' ); ?>
					</a>
				</span>
			<?php endif; ?>


		</div>

	</div>

<?php endif; ?>
