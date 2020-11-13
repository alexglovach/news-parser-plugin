<?php

namespace NewsParserPlugin\Controllers;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class RenderController
{
    public static function render(string $templateName, array $data)
    {
        $loader = new FilesystemLoader(NEWS_PARSER_PLUGIN_PATH.'Views/');
        $twig = new Environment($loader, [
            'cache' => NEWS_PARSER_PLUGIN_PATH.'public/cache/',
        ]);
        $template = $twig->load($templateName);
        echo $template->render($data);
    }
}