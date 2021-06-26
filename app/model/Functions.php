<?php

class Functions
{
    public static function escapeSingleQuote($s)
    {
        return str_replace('\'','\\\'',$s);
    }
}