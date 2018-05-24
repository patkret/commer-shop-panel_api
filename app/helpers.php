<?php

/**
 * Created by PhpStorm.
 * User: patrycja
 * Date: 21.05.18
 * Time: 17:07
 */

if (! function_exists('escape_like')) {
    /**
     * @param $string
     * @return mixed
     */
    function escape_like($string)
    {
        $search = array('%', '_', '.', '/', ',', '-');
        $replace   = '';
        return str_replace($search, $replace, $string);
    }
}
