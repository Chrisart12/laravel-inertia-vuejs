<?php
if (function_exists('cut_string')) {
    function cut_string(string $string, int $offset, int $length) 
    {
        if (strlen($string) <= $length) {
            $newString = $string;
        } else {
            $newString = substr($string, $offset, $length). '...';
        }
        
        return $newString;
    }
}

