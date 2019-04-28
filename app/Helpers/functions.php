<?php
/**
 * Created by PhpStorm.
 * User: Kison
 * Date: 2018/11/18 0018
 * Time: 下午 10:26
 */

if( ! function_exists('random_key_int') ){
    function random_key_int($length){
        $key='';
        $pattern='1234567890';
        for($i=0;$i<$length;++$i) {
            $key .= $pattern{mt_rand(0,9)};    // 生成php随机数
        }
        return $key;
    }
}