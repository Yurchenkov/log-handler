<?php
/**
 * Created by PhpStorm.
 * User: mefia
 * Date: 19.04.2019
 * Time: 19:47
 */

require_once('Parser.php');
require_once('File.php');

class LogHandler
{
    /**
     * @var array - массив необходимых для вывода результатов
     */
    public $attributes = [
        'views' => 0,
        'urls' => 0,
        'traffic' => 0,
        'lines' => 0,
        'statusCodes' => [],
        'crawlers' => [
            'Google' => 0,
            'Bing' => 0,
            'Yandex' => 0,
            'Baidu' => 0,
        ]
    ];

    /**
     * @var array - массив Url'ов, хранящий уникальные Url'ы
     */
    public static $uniqueUrls = [];

    /**
     * @return array - массив запрашиваемых параметров для вывода
     */
    public function result():array
    {
        foreach (File::readFile(File::$path) as $value){
            $logRecordInfo = Parser::accessLogRecordInfo($value,Parser::$patterns);
            $this->attributes['views']++;

            if(self::uniqueUrls($logRecordInfo['url'])){
                $this->attributes['urls']++;
            }

            $this->attributes['traffic'] += $logRecordInfo['traffic'];
            $this->attributes['lines']++;
            if(!empty($logRecordInfo['crawlers'])){
                $this->attributes['crawlers'][$logRecordInfo['crawlers']]++;
            }
            $this->attributes['statusCodes'][$logRecordInfo['status_code']]++;
        }

        return $this->attributes;
    }

    /**
     * @param $url - Url, проверяемый на уникальность
     * @return bool
     */
    private static function uniqueUrls(string $url):bool
    {
        if(in_array($url,self::$uniqueUrls)){
            return false;
        }

        self::$uniqueUrls[] = $url;
        return true;
    }
}