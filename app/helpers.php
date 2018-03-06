<?php
if (! function_exists('vi_slug')) {
    function vi_slug($text) {
		$strlow = trim(mb_strtolower($text));
		$slug = str_replace(" ","-",$strlow);
		return $slug;
    }
}

if(! function_exists('remove_text')) {
	function remove_text($string) {
		return preg_replace('/<[^>]+>/', '', $string);
		// return $string;
	}
}