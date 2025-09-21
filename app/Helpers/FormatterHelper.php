<?php

if (!function_exists('rupiah')) {
    function rupiah($value)
    {
        return 'Rp. ' . number_format((int) $value, 0, ',', '.');
    }
}