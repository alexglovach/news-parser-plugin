<?php

namespace NewsParserPlugin\Controllers;


use NewsParserPlugin\Controllers\Admin\AdminCronController;
use NewsParserPlugin\Controllers\Admin\AdminPageController;
use NewsParserPlugin\Controllers\Admin\AdminParserController;
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

        $adminCronController = new AdminCronController();
        $this->loader->add_filter('cron_schedules', $adminCronController, 'addTwoHoursInterval');
        $this->loader->add_action('admin_head', $adminCronController, 'addParserCronTask');

        $adminParserController = new AdminParserController();
        $this->loader->add_action('parserCheckNewPosts', $adminParserController, 'checkYahooNews');
        $this->loader->add_action('parserCheckNewPosts', $adminParserController, 'checkYahooEntertainment');
    }

    private function definePublicHooks(): void
    {

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
