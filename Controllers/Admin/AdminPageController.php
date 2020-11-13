<?php

namespace NewsParserPlugin\Controllers\Admin;

use NewsParserPlugin\Controllers\RenderController;
use NewsParserPlugin\Services\Admin\AdminService;

class AdminPageController
{

    private $newsParserPlugin;
    private $version;

    public function __construct(string $newsParserPlugin, string $version)
    {
        $this->newsParserPlugin = $newsParserPlugin;
        $this->version = $version;
    }

    public function newsParserPluginOptions(): void
    {
        add_options_page('News parser plugin', 'News parser plugin', 'manage_options', 'news-parser-plugin', array($this, 'newsParserPluginPage'));
    }

    public function newsParserPluginPage(): void
    {
        RenderController::render('Admin/BaseAdminView.php',AdminService::newsParserPluginPageData());
    }
}
