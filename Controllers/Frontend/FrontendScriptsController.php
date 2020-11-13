<?php

namespace NewsParserPlugin\Controllers\Frontend;

class FrontendScriptsController
{

    private $newsParserPlugin;
    private $version;

    public function __construct($newsParserPlugin, $version)
    {
        $this->newsParserPlugin = $newsParserPlugin;
        $this->version = $version;
    }

    public function enqueueStyles(): void
    {

       // wp_enqueue_style( $this->NewsParserPlugin, plugin_dir_url( __FILE__ ) . 'css/news-parser-plugin-public.css', array(), $this->version, 'all' );
    }

    public function enqueueScripts(): void
    {
       // wp_enqueue_script( $this->NewsParserPlugin, plugin_dir_url( __FILE__ ) . 'js/news-parser-plugin-public.js', array( 'jquery' ), $this->version, false );
    }

}