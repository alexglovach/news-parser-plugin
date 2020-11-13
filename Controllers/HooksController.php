<?php

namespace NewsParserPlugin\Controllers;


use NewsParserPlugin\Controllers\Admin\AdminPageController;
use NewsParserPlugin\Controllers\Admin\AdminScriptsController;
use NewsParserPlugin\Controllers\Frontend\FrontendScriptsController;


class HooksController
{

    protected $loader;
    protected $newsParserPlugin;
    protected $version;

    public function __construct()
    {
        if (defined('NEWS_PARSER_PLUGIN_VERSION')) {
            $this->version = NEWS_PARSER_PLUGIN_VERSION;
        } else {
            $this->version = '1.0.0';
        }
        $this->newsParserPlugin = 'news-parser-plugin';

        $this->loadDependencies();
        $this->defineAdminHooks();
        $this->definePublicHooks();
    }

    public function getNewsParserPlugin(): string
    {
        return $this->newsParserPlugin;
    }

    public function getVersion(): string
    {
        return $this->version;
    }

    private function loadDependencies(): void
    {
        $this->loader = new LoaderController();
    }

    private function defineAdminHooks(): void
    {

        $adminScriptsController = new AdminScriptsController($this->getNewsParserPlugin(), $this->getVersion());

        $this->loader->add_action('admin_enqueue_scripts', $adminScriptsController, 'enqueueStyles');
        $this->loader->add_action('admin_enqueue_scripts', $adminScriptsController, 'enqueueScripts');

        $adminPageController = new AdminPageController($this->getNewsParserPlugin(), $this->getVersion());
        $this->loader->add_action('admin_menu', $adminPageController, 'newsParserPluginOptions');

    }

    private function definePublicHooks(): void
    {

        $pluginPublic = new FrontendScriptsController($this->getNewsParserPlugin(), $this->getVersion());
        // this files temporary not used
        $this->loader->add_action('wp_enqueue_scripts', $pluginPublic, 'enqueueScripts');
        $this->loader->add_action('wp_enqueue_scripts', $pluginPublic, 'enqueueStyles');
    }

    public function run(): void
    {
        $this->loader->run();
    }

    public function getLoader(): LoaderController
    {
        return $this->loader;
    }
}
