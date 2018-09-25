<?php

namespace App\Services\Log;

use Storage;

/**
 * Created by PhpStorm.
 * User: ANH
 * Date: 5/26/2017
 * Time: 4:04 PM
 */
class Logging
{
    const LOG_DIR = "log";
    const LOG_FORMAT = "log-%s.txt"; //log-mm-yyyy;

    const FORMAT_UPDATE_SHEDULE       = "Log name";
    public static function format($format, $valueArr)
    {
        $string = $format;
        foreach ($valueArr as $key => $value) {
            $string = str_replace(":".$key, $value, $string);
        }
        return $string;
    }

    private static function get_log_path($monthyear)
    {
        return sprintf(self::LOG_DIR.'/'.self::LOG_FORMAT, $monthyear);
    }

    private static function get_current_log()
    {
        return sprintf(self::LOG_DIR.'/'.self::LOG_FORMAT, date_create()->format('n-Y'));
    }
    /**
     * get logging
     *
     * @return loging content
     */
    public static function load($monthyear)
    {
        $path = self::get_log_path($monthyear);
        $content = null;
        if (Storage::exists($path))
        {
            $content = Storage::get($path);
        }
        return $content;
    }
    /**
     * append content to current log
     *
     * @param $content the content need to append
     */

    public static function append($content)
    {
        Storage::append(self::get_current_log(), $content);
    }

    public static function appendWithTimestamp($content)
    {
        $logContent = $content.' at '.date('d-m-Y');
        Storage::append(self::get_current_log(), $logContent);
    }
    public static function reset($monthyear)
    {
        Storage::delete(self::get_log_path($monthyear));
    }
}