<?php
/**
 * Rsa
 * Rsa加密/解密
 *
 * @link https://github.com/xieyx/sina_finance_business_sdk
 * @author shelf <xieyanxin93@gmail.com>
 */

namespace JROpen\Service;

class Rsa
{
    /**
     * 解密
     *
     * @param string $string
     * @param string $pri_key
     * @param int $padding
     * @return array
     */
    public static function decrypt($string, $pri_key, $padding = OPENSSL_PKCS1_PADDING)
    {
        $crypto = '';
        foreach (str_split(base64_decode($string), 128) as $chunk) {
            openssl_private_decrypt($chunk, $result, $pri_key);
            $crypto .= $result;
        }

        return json_decode($crypto, true);
    }

    /**
     * 加密
     *
     * @param array $data
     * @param string $pub_key
     * @param int $padding
     * @return string
     */
    public static function encrypt($data, $pub_key, $padding = OPENSSL_PKCS1_PADDING)
    {
        $crypto = '';
        foreach (str_split(json_encode($data), 117) as $chunk) {
            openssl_public_encrypt($chunk, $result, $pub_key);
            $crypto .= $result;
        }

        return base64_encode($crypto);
    }
}
