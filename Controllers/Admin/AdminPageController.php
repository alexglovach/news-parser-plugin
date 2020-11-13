<?php

namespace NewsParserPlugin\Controllers\Admin;

use NewsParserPlugin\Controllers\RenderController;
use NewsParserPlugin\Services\Admin\AdminService;

class AdminPageController
{

    private $NewsParserPlugin;
    private $version;

    public function __construct(string $NewsParserPlugin, string $version)
    {
        $this->NewsParserPlugin = $NewsParserPlugin;
        $this->version = $version;
    }

    public function NewsParserPluginOptions(): void
    {
        add_options_page(' news parser plugin', ' news parser plugin', 'manage_options', 'news-parser-plugin', array($this, 'NewsParserPluginPage'));
    }

    public function NewsParserPluginPage(): void
    {
        RenderController::render('Admin/BaseAdminView.php',AdminService::NewsParserPluginPageData());
    }
}
