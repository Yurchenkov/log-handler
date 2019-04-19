<?php
/**
 * Created by PhpStorm.
 * User: mefia
 * Date: 19.04.2019
 * Time: 19:50
 */

class File
{
    public static $path = './files/access_log';

    /**
     * @param $path - путь к файлу с access_log'ом
     * @return Generator
     */
    public static function readFile($path) {
        $handle = fopen($path, "r");

        while(!feof($handle)) {
            yield trim(fgets($handle));
        }

        fclose($handle);
    }
}