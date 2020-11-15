<?php

namespace NewsParserPlugin\Models;

class OptionsModel
{
    const OPTIONS_NAME = 'news-parser-plugin-option';
    protected static $options;

    public static function getOptions()
    {
        self::$options = json_decode(get_option(self::OPTIONS_NAME), true);
        return self::$options;
    }

    public static function setOptions(array $options)
    {
        self::updateOptions($options);
    }

    public static function updateOptions(array $options)
    {
        self::$options = json_encode($options);
        update_option(self::OPTIONS_NAME, self::$options);
    }

    public static function deleteOptions()
    {
        self::$options = '';
        delete_option(self::OPTIONS_NAME);
    }
}
