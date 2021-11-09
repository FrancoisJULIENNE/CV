<?php
$filename = '\dev.env';
//var_dump(is_file(dirname(__FILE__).$filename));
//exit;
if (is_file(dirname(__FILE__).$filename)) {
    include('wp-config-dev.php');
} else {
    include('wp-config-prod.php');
}
