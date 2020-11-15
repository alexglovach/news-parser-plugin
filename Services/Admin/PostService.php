<?php

namespace NewsParserPlugin\Services\Admin;

use NewsParserPlugin\Models\PostModel;

class PostService
{
    public function create(string $title, string $content, string $categories = ''): int
    {
        $postData = [
            'post_title' => $title,
            'post_content' => $content,
            'post_status' => 'publish',
            'post_author' => 1,
            'post_category' => array($categories)
        ];

        return PostModel::create($postData);
    }
}