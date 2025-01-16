<?php
$languages = apply_filters( 'wpml_active_languages', null );

if ( ! empty( $languages ) ) :
	$multiple_languages = count( $languages ) > 1;
	?>
	<div class="relative group">
		<button class="flex items-center pl-4 focus:outline-none" aria-haspopup="true" aria-expanded="false"
			aria-label="<?php esc_attr_e( 'Language selector', 'ground' ); ?>">

			<?php ground_icon( [ 
				'name' => 'globe',
				'attr' => [ 
					'class' => 'w-4 h-4 inline-block mr-2',
				],
			] ); ?>

			<span>
				<?php foreach ( $languages as $language ) {
					if ( $language['active'] ) {
						echo esc_html( $language['native_name'] );
						break;
					}
				} ?>
			</span>

			<?php if ( $multiple_languages ) : ?>
				<?php ground_icon( [ 
					'name' => 'chevron-down',
					'attr' => [ 
						'class' => 'w-4 h-4 inline-block ml-2',
					],
				] ); ?>
			<?php endif; ?>
		</button>

		<?php if ( $multiple_languages ) : ?>
			<div class="absolute right-0 min bg-white border border-gray-300 rounded-md shadow-lg hidden group-hover:block"
				role="menu" aria-labelledby="language-switcher">
				<?php foreach ( $languages as $language ) : ?>
					<?php if ( ! $language['active'] ) : ?>
						<a href="<?php echo esc_url( $language['url'] ); ?>" class="block px-4 py-2 text-gray-700 hover:text-primary"
							role="menuitem">
							<?php echo esc_html( $language['native_name'] ); ?>
						</a>
					<?php endif; ?>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>