<?php
/**
 * This file is part of Open Swoole.
 *
 * @link     https://www.swoole.co.uk
 * @contact  hello@swoole.co.uk
 * @license  https://github.com/openswoole/library/blob/master/LICENSE
 */

declare(strict_types=1);

namespace Swoole\FastCGI\Record;

use PHPUnit\Framework\TestCase;
use Swoole\FastCGI;

/**
 * @internal
 * @coversNothing
 */
class GetValuesResultTest extends TestCase
{
    protected static $rawMessage = '010a0001001206000f01464347495f4d5058535f434f4e4e5331000000000000';

    public function testPacking(): void
    {
        $request = new GetValuesResult(['FCGI_MPXS_CONNS' => 1]);
        $this->assertEquals(FastCGI::GET_VALUES_RESULT, $request->getType());
        $this->assertEquals(['FCGI_MPXS_CONNS' => 1], $request->getValues());

        $this->assertSame(self::$rawMessage, bin2hex((string) $request));
    }

    public function testUnpacking(): void
    {
        $request = GetValuesResult::unpack(hex2bin(self::$rawMessage));

        $this->assertEquals(FastCGI::GET_VALUES_RESULT, $request->getType());
        $this->assertEquals(['FCGI_MPXS_CONNS' => 1], $request->getValues());
    }
}
