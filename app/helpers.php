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
		$removeLinks =  preg_replace('/<[^>]+>/', '', $string);
		// remove unexpected words in beginning and ending
		// $string = preg_replace('/(^([^a-zA-Z0-9])*|([^a-zA-Z0-9])*$)/', '', $removeLinks);
		return $removeLinks;
		// return $string;
	}
}