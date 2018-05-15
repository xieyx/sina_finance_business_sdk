<?php

namespace JROpen\Service;

class Rsa
{
    public static function decrypt($string, $pri_key, $padding = OPENSSL_PKCS1_PADDING)
    {
        $crypto = '';
        foreach (str_split(base64_decode($string), 128) as $chunk) {
            openssl_private_decrypt($chunk, $result, $pri_key);
            $crypto .= $result;
        }

        return json_decode($crypto, true);
    }

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
