<?php

    const BASE_URL = 'http://localhost/arman/';

    function asset($file)
    {
        return trim(BASE_URL, '/ ') . '/' . trim($file, '/ ');
    }

    function redirect($url)
    {
        header('Location: ' . trim(BASE_URL, '/ ') . '/' . trim($url, '/ '));
        exit();
    }


    function url($url)
    {
        return trim(BASE_URL, '/ ') . '/' . trim($url, '/ ');
    }
?>