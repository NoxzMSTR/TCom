<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/admin.php';

require __DIR__ . '/public.php';


Route::get('/theme-dynamic-css', function () {
    $headingColor = null;
    $textColor = null;
    $sTextColor = null;
    $borderColor = null;
    $backgroundColor = null;
    $contentColor = null;
    $cardColor = null;

    if (defined('system_config')) {
        $headingColor = isset(system_config['color.heading']) ? system_config['color.heading']->value : null;
        $textColor = isset(system_config['color.text']) ? system_config['color.text']->value : null;
        $sTextColor = isset(system_config['color.secondaryText']) ? system_config['color.secondaryText']->value : null;
        $borderColor = isset(system_config['color.border']) ? system_config['color.border']->value : null;
        $backgroundColor = isset(system_config['color.background']) ? system_config['color.background']->value : null;
        $contentColor = isset(system_config['color.content']) ? system_config['color.content']->value : null;
        $cardColor = isset(system_config['color.card']) ? system_config['color.card']->value : null;
    }

    return response()->view('components.theme', compact('headingColor', 'textColor', 'sTextColor', 'borderColor', 'backgroundColor', 'contentColor', 'cardColor'))
        ->header('Content-Type', 'text/css');
});
