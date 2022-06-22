<?php

/**
 * Select all the child taxonomy on clicking the parent one
 * Based on : https://wordpress.org/plugins/taxonomy-tree-toggler/
 *
 * @return void
 */
function taxonomy_tree_parent_toggler() {

    /* PHP heredoc syntax */
	echo <<<SNIPPET

    <script>

        (function () {

            jQuery(document).on('change', '.selectit input[type="checkbox"]', function(){
                if (jQuery(this).prop('checked')) {
                    checkChildNodes(jQuery(this));
                } else {
                    uncheckChildNodes(jQuery(this));
                }
            }).on('change', 'input.components-checkbox-control__input[type="checkbox"]', function() {
                if (jQuery(this).prop('checked')) {
                    gtCheckChildren(jQuery(this));
                } else {
                    gtUncheckChildren(jQuery(this));
                }
            });

            function checkParentNodes(_el)
            {
                var _parent = findParentObj(_el);
                if (_parent.length != 0)
                {
                    _parent[0].checked = 1;
                    checkParentNodes(_parent);
                }
            }

            function findParentWithDepth(_el, _depth) {
                var parent = _el;
                var c = 0;
                do {
                    parent = parent.parent();
                } while (++c < _depth);
                return parent;
            }

            function findParentObj(_el){
                return findParentWithDepth(_el, 3).prev().children("input");
            }

            function uncheckChildNodes(_el){
                _el.parent().siblings().find('input[type="checkbox"]').each(function() {
                    jQuery(this).prop('checked', false);
                });
            }

            function checkChildNodes(_el){
                _el.parent().siblings().find('input[type="checkbox"]').each(function() {
                    jQuery(this).prop('checked', true);
                });
            }

            // Gutenberg, find labels and click
            function gtCheckParent(_el){
                var _parent = gtFindParentCheckbox(_el);
                if (_parent.length != 0)
                {
                    if (!_parent.prop('checked')) {
                        _parent.parent().next().trigger('click');
                    }
                    gtCheckParent(_parent.parent());
                }
            }

            function gtUncheckParent(_el){
                var _parent = gtFindParentCheckbox(_el);
                if (_parent.length != 0)
                {
                    if (_parent.prop('checked')) {
                        _parent.parent().next().trigger('click');
                    }
                    gtCheckParent(_parent.parent());
                }
            }

            function gtFindParentCheckbox(_el){
                var p = findParentWithDepth(_el, 5);
                if (p.hasClass('editor-post-taxonomies__hierarchical-terms-subchoices')) {
                    return p.prev().find('input[type="checkbox"]');
                } else {
                    return [];
                }
            }

            function gtUncheckChildren(_el){
                var selector = '.editor-post-taxonomies__hierarchical-terms-subchoices';
                findParentWithDepth(_el, 3).next(selector).find('input[type="checkbox"]').each(function() {
                    if (jQuery(this).prop('checked')) {
                        jQuery(this).parent().next().trigger('click');
                    }
                });
            }

            function gtCheckChildren(_el){
                var selector = '.editor-post-taxonomies__hierarchical-terms-subchoices';
                findParentWithDepth(_el, 3).next(selector).find('input[type="checkbox"]').each(function() {
                    if (!jQuery(this).prop('checked')) {
                        jQuery(this).parent().next().trigger('click');
                    }
                });
            }

        })();
    
    </script>

    SNIPPET;

}

add_action('admin_footer-edit.php', 'taxonomy_tree_parent_toggler');
add_action('admin_footer-post.php', 'taxonomy_tree_parent_toggler');
add_action('admin_footer-post-new.php', 'taxonomy_tree_parent_toggler');
