<?php

namespace NewsParserPlugin\Services\Admin;

use NewsParserPlugin\Models\BaseModel;

class AdminService
{
    public static function newsParserPluginPageData(): array
    {
        $data = [
            'title' => ' News Parser Plugin Settings Page Title',
            //'data'=> BaseModel::getSettings()
        ];
        return $data;
    }

}