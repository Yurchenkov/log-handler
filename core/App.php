<?php
/**
 * Created by PhpStorm.
 * User: mefia
 * Date: 19.04.2019
 * Time: 19:24
 */

require_once ('./components/LogHandler.php');

class App
{

    public static function logInfo()
    {
        $handler = new LogHandler();
        $result = $handler->result();
        $jsonResult = json_encode($result);
        return $jsonResult;
    }

}