<?php

function get_id_current_language ($id) {
    $my_current_lang = apply_filters( 'wpml_current_language', NULL );
    $element_type = 'post';
    $return_original_if_missing = true;
    return apply_filters( 'wpml_object_id', $id, $element_type, $return_original_if_missing, $my_current_lang );
}
