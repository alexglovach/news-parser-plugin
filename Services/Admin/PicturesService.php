<?php

namespace NewsParserPlugin\Services\Admin;

use NewsParserPlugin\Models\PicturesModel;

class PicturesService
{
    public function save(string $url, int $postId = 0, string $description): int
    {
        return PicturesModel::create($url, $postId, $description);
    }
}