<?php
/*
 * Copyright (c) 2021.
 *  @author Stephen Ngari <sngari57@gmail.com>
 */

namespace App\Core;

class Log
{
    public static function Info($request)
    {
            file_put_contents(Application::$ROOT_DIR.'/Storage/Logs.log', $request, FILE_APPEND);
    }

    public static function Dump($data,$data2 =null, $data3 = null){
        echo '<pre>';
        var_dump($data,$data2, $data3);
        echo '</pre>';

    }
}
