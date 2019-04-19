<?php
/**
 * Created by PhpStorm.
 * User: mefia
 * Date: 19.04.2019
 * Time: 19:47
 */

class Parser
{
    /**
     * @var $patterns - массив шаблонов по которым будет производиться поиск нужной информации в записи из access_log'а
     */
    public static $patterns = [
        'url' => '/\S+[^"]+"[^"\[\]]+"\s\d+\s\d+\s+("[^"\[\]]+")/', //значения url(заключены в кавычки)
        'ip' => '/(\S+)[^"]+"[^"\[\]]+"\s\d+\s\d+/', //значения не содержащие пробелов,IP-адреса,статусы ответа,размер
        'status_code' => '/\S+[^"]+"[^"\[\]]+"\s(\d+)\s\d+/', //значения кода ответа
        'traffic' => '/\S+[^"]+"[^"\[\]]+"\s\d+\s(\d+)/' //объём траффика
    ];

    /**
     * @param string $recordFromAccessLog - строка соответствующая отдельной записи в access_log
     * @param array $patterns - массив шаблонов по которым будет производиться поиск нужной информации в записи из access_log'а
     * @return array - массив содержащий необходимую информацию по записи в access_log (url,ip,status_code,traffic)
     */
    public static function accessLogRecordInfo(string $recordFromAccessLog,array $patterns):array
    {
        $result = [];

        foreach($patterns as $key => $pattern){
            preg_match($pattern,$recordFromAccessLog,$matches);
            $result[$key] = $matches[1];
        }

        return $result;
    }
}