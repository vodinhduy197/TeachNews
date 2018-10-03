<?php
function ShortenText($text) { // Function name ShortenText
    $chars_limit = 80; // Character length
    $chars_text = strlen($text);
    $text = $text." ";
    $text = substr($text,0,$chars_limit);
    $text = substr($text,0,strrpos($text,' '));
    if ($chars_text > $chars_limit)
    { $text = $text."..."; } // Ellipsis
    return $text;
}