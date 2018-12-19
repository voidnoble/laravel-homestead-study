<?php

function markdown($text)
{
    return app(ParsedownExtra::class)->text($text);
}

if (! function_exists('icon')) {
    function icon($class, $additon = 'icon', $inline = null)
    {
        $icon = config('icons.' . $class);
        $inline = $inline ? 'style="'. $inline .'""' : null;

        return sprintf('<i class="%s %s" %s></i>', $icon, $additon, $inline);
    }
}

if (! function_exists('attachment_path')) {
    function attachment_path($path = '')
    {
        return public_path($path ? 'attachments'. DIRECTORY_SEPARATOR . $path : 'attachments');
    }
}

