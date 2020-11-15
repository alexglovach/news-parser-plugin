<?php

namespace NewsParserPlugin\Models;

class PicturesModel
{
    public static function create(string $url, int $postId, string $description): int
    {
        $tmp = download_url( $url );
        $fileData = [
            'name' => basename($url),
            'tmp_name' => $tmp,
            'error' => 0,
            'size' => filesize($tmp),
        ];
        $id = media_handle_sideload($fileData, $postId, $description);
        @unlink($tmp);
        return $id;
    }
}