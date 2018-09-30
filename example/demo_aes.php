<?php
require 'vendor/autoload.php';

use JROpen\Service\Aes;

$key = 'USJBTDIIWwttUZ+7q6B0vmmXzwNO5ggPeFeC1KqtdhEkKZ3JOxvF7C00La/nIJbWvKmjyC4APHOzomrrf/H7d6stqcpXpfJ39oai2hSY4vZNWXIHRVnNQK+EvgqKU3/h91xW5s37OKWFNSmUpgh5Sn7ThJjqHaoffJZzVAMBpu8=';

$sign = Aes::encrypt('13717503886', $key);
echo $sign.PHP_EOL;
var_dump(Aes::decrypt($sign, $key));
