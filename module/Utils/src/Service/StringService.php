<?php
namespace Utils\Service;


class StringService
{
    /**
     *
     * @param $string
     * @return array
     */
    public static function explodeStringWhiteSpaces($string)
    {
        $parts = preg_split('/\s+/', $string);

        return $parts;
    }
}