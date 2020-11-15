<?php

namespace NewsParserPlugin\Controllers\Admin;


use NewsParserPlugin\Services\Admin\ParserService;

class AdminParserController
{
    public function checkYahooNews()
    {
        //get new posts (after checking)
        $parser = new ParserService();
        $parser->parseYahooNews();

        // public if have new (create category if exist, and public post)
    }
    public function checkYahooEntertainment()
    {
        $parser = new ParserService();
        $parser->parseYahooEntertainment();
    }
}