<?php
// Adding Translation Option
add_action('after_setup_theme', 'load_translations');
function load_translations(){
	load_theme_textdomain( 'divi_child', CHILD_THEME_DIRECTORY .'/assets/translation' );
}
