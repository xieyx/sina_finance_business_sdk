<?php
/**
 * RsaTest
 * Rsa sdk api测试类
 */

namespace JROpen\Tests;

use JROpen\Service\Aes;
use \PHPUnit\Framework\TestCase;

class AesTest extends TestCase
{
    public $key = 'USJBTDIIWwttUZ+7q6B0vmmXzwNO5ggPeFeC1KqtdhEkKZ3JOxvF7C00La/nIJbWvKmjyC4APHOzomrrf/H7d6stqcpXpfJ39oai2hSY4vZNWXIHRVnNQK+EvgqKU3/h91xW5s37OKWFNSmUpgh5Sn7ThJjqHaoffJZzVAMBpu8=';
    public function testEncrypt()
    {
        $sign = Aes::encrypt('13717503886', $this->key);
        $this->assertNotEmpty($sign);
        return $sign;
    }

    /**
     * @depends testEncrypt
     */
    public function testDecrypt($sign)
    {
        $data = Aes::decrypt($sign, $this->key);
        return $this->assertEquals($data, '13717503886');
    }
}
