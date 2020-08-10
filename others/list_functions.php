<?php
echo 'Function sets supported in this install are: <br />';

$extensions = get_loaded_extensions();

foreach ($extensions as $each_ext) {
    echo $each_ext . '<br />';
    echo '<ul>';

    $ext_funs = get_extension_funcs($each_ext);
    foreach ($ext_funs as $func) {
        echo '<li>' . $func . '</li>';
    }
    echo '</ul>';
}
