<div class="sticky top-16 bg-quinary border-b border-septenary z-10 transform -translate-x-2/4 w-screen ml-1/2 lg:relative lg:bg-transparent lg:ml-auto lg:translate-x-0 lg:w-auto lg:border-0 lg:top-0">
    <div class="px-0 overflow-hidden">
        <div class="flex flex-wrap pt-3 lg:pt-0">
            <div class="w-1/2 gap-6 lg:w-2/3 sm:pr-3 pb-3 lg:pb-0 pl-6 lg:pl-0 pr-3 lg:pr-0">
                <?php if (is_active_sidebar('sidebar-woocommerce') || is_active_sidebar('sidebar-woocommerce-advanced')) : ?>
                    <button class="button button--bordered button--full-width block lg:hidden js-toggle" data-toggle-target="#sidebar-woocommerce html" data-toggle-class-name="is-sidebar-open">
                        <?php ground_icon('options', 'button__icon w-6 h-6'); ?> <?php _e('Filters', 'ground'); ?>
                    </button>
                <?php endif; ?>
            </div>
            <div class="w-1/2 lg:w-1/3 pb-3 pl-3 pr-6 lg:pr-0">
                <?php $result = woocommerce_catalog_ordering(); ?>
            </div>
            <div class="w-full col-span-full lg:order-first lg:hidden">
                <?php get_template_part('template-parts/woocommerce/active-filters'); ?>
            </div>
        </div>
    </div>
</div>