<?php
/**
 * Created by PhpStorm.
 * User: zwj
 * Date: 2016/1/6
 * Time: 12:47
 */
error_reporting( E_ALL&~E_NOTICE );
//设置中国时区
date_default_timezone_set('PRC');
//生成唯一标识符（GUID）方
function getGuid()
{
//    $charid = strtoupper(md5(uniqid(mt_rand(), true)));
//    $hyphen = chr(45);
//    $uuid = substr($charid, 0, 8) . $hyphen
//        . substr($charid, 8, 4) . $hyphen
//        . substr($charid, 12, 4) . $hyphen
//        . substr($charid, 16, 4) . $hyphen
//        . substr($charid, 20, 12);
//    return $uuid;
    $uniqid = uniqid(null);
    usleep(1);//延迟1微妙
    return $uniqid;
}

//fwrite(STDOUT, "Enter your number: ");
//$number = trim(fgets(STDIN));
$fp = fopen(date('YmdHis') . ".csv", "a");//
$number = $_SERVER["argv"][1];
function createfirst($fp)
{
    $data_arr1 = "二维码第一列,二维码第二列"; //插入第一行数
    $data_str5 = iconv('utf-8', 'gb2312', $data_arr1);
    fwrite($fp, $data_str5);
}

function createurl($fp)
{
    $urlstr = 'http://weixin.qq.com/r/uzpudh3EOEBHrVkV92_p?trace_code=';
    $uniqid = getGuid();
    $uniqid2 = getGuid();
    $url = $urlstr . "" . $uniqid;
    $url2 = $urlstr . "" . $uniqid2;
    $data_end = $url . "," . $url2;
    $data_arr3 = "\r\n" . $data_end;
    $data_str4 = iconv('utf-8', 'gb2312', $data_arr3);
    return $data_str4;
}


function createcsv($number, $fp)
{
    if ($number == null) {
        createfirst($fp);
        fwrite($fp, createurl($fp));
        fclose($fp);
        $str = mb_convert_encoding("测试成功", "GBK", "UTF-8");
        echo $str;
    }

    if (is_numeric("$number")) {
        createfirst($fp);
        for ($i = $number / 2; $i < $number; $i++) {
            fwrite($fp, createurl($fp));
        }
        fclose($fp);
        echo mb_convert_encoding("生成成功", "GBK", "UTF-8");
    }
}
createcsv($number, $fp);
?>


