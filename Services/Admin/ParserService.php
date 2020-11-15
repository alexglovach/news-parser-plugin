<?php

namespace NewsParserPlugin\Services\Admin;


use NewsParserPlugin\Models\OptionsModel;
use phpQuery;

class ParserService
{
    const PARSED_POSTS_LIMIT = 10;

    /**
     * @return false|array
     */
    public function parseYahooNews()
    {
        $lastPostLink = $this->getLastParsedPost('news');
        $allNewsLinks = $this->parseLinks("https://finance.yahoo.com/?guccounter=1","#atomic .My\(0\)");
        $content = false;
        foreach ($allNewsLinks as $newsLink){
            if($newsLink != $lastPostLink){
                $content[] = $this->parseContent($newsLink,'???');
            }else{
                break;
            }
        }
        return $content;
    }

    /**
     * @return false|array
     */
    public function parseYahooEntertainment()
    {
        $lastPostLink = $this->getLastParsedPost('news');
        $allNewsLinks = $this->parseLinks("https://www.yahoo.com/entertainment/","#atomic .Wow\(bw\)");
        $content = false;
        foreach ($allNewsLinks as $newsLink){
            if($newsLink != $lastPostLink){
                $content[] = $this->parseContent($newsLink,'???');
            }else{
                break;
            }
        }
        return $content;
    }

    /**
     * @param string $postCategory
     * @return string|false
     */
    private function getLastParsedPost(string $postCategory):string
    {
        $lastPosts = OptionsModel::getOptions();
        return $lastPosts['lastPosts'][$postCategory] ?? false;
    }

    private function parseLinks(string $link, string $queryString):array
    {
        $html = file_get_contents($link);
        phpQuery::newDocument($html);
        $newsLinks = pq($queryString)->find("a");
        $i = 1;
        foreach ($newsLinks as $newsLink){
            if($i < PARSED_POSTS_LIMIT){
                $links[] = pq($newsLink);
                $i++;
            }
        }
        phpQuery::unloadDocuments();
        return $links;
    }
    private function parseContent(string $link, string $queryString):array
    {
        $html = file_get_contents($link);
        phpQuery::newDocument($html);
        $content = [
            'title'=>pq($queryString)->find("title"),
            'content'=>pq($queryString)->find("content"),
            'thumbnail'=>pq($queryString)->find("thumbnail")
        ];
        phpQuery::unloadDocuments();
        return $content;
    }
}