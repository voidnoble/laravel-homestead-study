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

function gravatar_profile_url($email)
{
    return sprintf("//www.gravatar.com/%s", md5($email));
}

function gravatar_url($email, $size = 72)
{
    return sprintf("//www.gravatar.com/avatar/%s?s=%s", md5($email), $size);
}
