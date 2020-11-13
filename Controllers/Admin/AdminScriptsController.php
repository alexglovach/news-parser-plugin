<?php

namespace NewsParserPlugin\Controllers\Admin;

class AdminScriptsController
{

    private $NewsParserPlugin;
    private $version;

    public function __construct(string $NewsParserPlugin, string $version)
    {
        $this->NewsParserPlugin = $NewsParserPlugin;
        $this->version = $version;
    }

    public function enqueueStyles(): void
    {
        wp_enqueue_style($this->NewsParserPlugin, NEWS_PARSER_PLUGIN_URL . 'admin/css/news-parser-plugin-admin.css', array(), $this->version, 'all');
    }

    public function enqueueScripts(): void
    {
        wp_enqueue_script($this->NewsParserPlugin, NEWS_PARSER_PLUGIN_URL . 'admin/js/news-parser-plugin-admin.js', array('jquery'), $this->version, false);
    }
}
