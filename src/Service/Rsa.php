<?php

namespace JROpen\Service;

class Rsa
{
    public function descypt($string, $pri_key, $padding=OPENSSL_PKCS1_PADDING)
    {
        if(openssl_private_decrypt(base64_decode($string), $result, $pri_key, $padding))
        {
            return $result;
        }

        return false;
    }
}
