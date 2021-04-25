<?php

class Template
{
    public static function render($view, $dataset)
    {
        foreach ($dataset as $key => $value) $$key = $value;
        include 'views/' . $view . '.php';
    }
}
