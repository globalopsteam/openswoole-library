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
class EndRequestTest extends TestCase
{
    protected static $rawMessage = '01030001000800000000006400000000';

    public function testPacking(): void
    {
        $request = new EndRequest(FastCGI::REQUEST_COMPLETE, 100);
        $this->assertEquals(FastCGI::END_REQUEST, $request->getType());
        $this->assertEquals(FastCGI::REQUEST_COMPLETE, $request->getProtocolStatus());
        $this->assertEquals(100, $request->getAppStatus());

        $this->assertSame(self::$rawMessage, bin2hex((string) $request));
    }

    public function testUnpacking(): void
    {
        $request = EndRequest::unpack(hex2bin(self::$rawMessage));

        $this->assertEquals(FastCGI::END_REQUEST, $request->getType());
        $this->assertEquals(FastCGI::REQUEST_COMPLETE, $request->getProtocolStatus());
        $this->assertEquals(100, $request->getAppStatus());
    }
}
