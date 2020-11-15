<?php

namespace NewsParserPlugin\Models;

class PostModel
{
    public static function create(array $postData): int
    {
        return wp_insert_post(wp_slash($postData));
    }
}