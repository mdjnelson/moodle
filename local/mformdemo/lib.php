<?php

function local_mformdemo_extend_navigation(global_navigation $navigation) {
    $navigation->add(get_string('pluginname', 'local_mformdemo'), new moodle_url('/local/mformdemo/index.php'));
}
