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
class GetValuesTest extends TestCase
{
    protected static $rawMessage = '01090001001107000f00464347495f4d5058535f434f4e4e5300000000000000';

    public function testPacking(): void
    {
        $request = new GetValues(['FCGI_MPXS_CONNS']);
        $this->assertEquals(FastCGI::GET_VALUES, $request->getType());
        $this->assertEquals(['FCGI_MPXS_CONNS' => ''], $request->getValues());

        $this->assertSame(self::$rawMessage, bin2hex((string) $request));
    }

    public function testUnpacking(): void
    {
        $request = GetValues::unpack(hex2bin(self::$rawMessage));

        $this->assertEquals(FastCGI::GET_VALUES, $request->getType());
        $this->assertEquals(['FCGI_MPXS_CONNS' => ''], $request->getValues());
    }
}
