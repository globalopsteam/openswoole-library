<?php
/**
 * This file is part of Open Swoole.
 *
 * @link     https://www.swoole.co.uk
 * @contact  hello@swoole.co.uk
 * @license  https://github.com/openswoole/library/blob/master/LICENSE
 */

declare(strict_types=1);

require __DIR__ . '/../bootstrap.php';

$str = _mbstring('我是中国人');
var_dump((string) $str->substr(0));
var_dump((string) $str->substr(2, 2));
var_dump($str->contains('中国'));
var_dump($str->contains('美国'));
var_dump($str->startsWith('我'));
var_dump($str->endsWith('不是'));
var_dump($str->length());
