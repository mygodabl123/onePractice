<?php
/**
 * Created by PhpStorm.
 * User: Zhangbaili
 * Date: 2022/5/22
 * Time: 13:51
 */

class Common
{
    public static function objectToArray($e) {
        $e = ( array ) $e;
        foreach ( $e as $k => $v ) {
            if (gettype ( $v ) == 'resource')
                return;
            if (gettype ( $v ) == 'object' || gettype ( $v ) == 'array')
                $e [$k] = ( array ) self::objectToArray ( $v );
        }
        return $e;
    }
    /**
     * 直接返回一个json 数组
     * @param unknown $arr
     * @return Ambigous <$arr, void, array>
     */
    public static function objectToJson($arr){
        //ob_end_clean();
        return json_encode(self::objectToArray($arr));
    }

}