<?php
if (! function_exists('vi_slug')) {
    function vi_slug($text) {
		$strlow = trim(mb_strtolower($text));
		$slug = str_replace(" ","-",$strlow);
		return $slug;
    }
}