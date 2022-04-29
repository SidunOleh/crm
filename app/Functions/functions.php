<?php

if(!function_exists('getPassword'))
{
    function getPassword(int $pass_length): string
    {
        $str = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $str_length = mb_strlen($str) - 1;

        $password = '';
        for($i=0; $i < $pass_length; $i++)
        {
            $password .= $str[rand(0, $str_length)];
        }

        return $password;
    }
}

if(!function_exists('cutStr'))
{
    function cutStr(string $str, int $start, int $length): string
    {
       if (mb_strlen($str) > $length) {
            $str = mb_substr($str, $start, $length) . '...';
       }

       return $str;
    }
}
