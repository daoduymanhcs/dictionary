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
		$removeLinks = preg_replace('/:/', '', $removeLinks);
		$removeLinks = preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $removeLinks);
		return $removeLinks;
		// return $string;
	}
}