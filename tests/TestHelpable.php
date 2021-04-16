<?php

namespace Tests;

use Illuminate\Support\Str;

trait TestHelpable
{
    /**
     *  Determine if a string should be truncated or not.
     * 
     *  @param string $string
     *  @param int $length
     *  @return string
     */
    private function stringLimitOrNot(string $string, int $length)
    {
        if (strlen($string) > $length) {
            return Str::limit($string, $length);
        } else {
            return $string;
        }
    }
}