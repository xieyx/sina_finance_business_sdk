<?php
/**
 * AES 加密解密
 *
 * @link https://github.com/xieyx/sina_finance_business_sdk
 * @author shelf <xieyanxin93@gmail.com>
 */
namespace JROpen\Service;

class Aes
{
    /**
     * @var string 加密方法
     */
    private static $method = 'AES-128-ECB';

    /**
     * @var int 填充方式
     */
    private static $options = OPENSSL_RAW_DATA;

    /**
     * 加密
     *
     * @param string $str
     * @param string $key
     * @return string
     */
    public static function encrypt($str, $key)
    {
        $real_key = self::transformKey($key);
        $res = openssl_encrypt($str, self::$method, $real_key, self::$options);

        return base64_encode($res);
    }

    /**
     * 解密
     *
     * @param string $str
     * @param string $key
     * @return string
     */
    public static function decrypt($str, $key)
    {
        $real_key = self::transformKey($key);
        $real_str = base64_decode($str);

        return openssl_decrypt($real_str, self::$method, $real_key, self::$options);
    }

    /**
     * 盐加密
     *
     * @param string $key
     * @return string
     */
    private static function transformKey($key)
    {
        return hash('MD5', $key, true);
    }
}
