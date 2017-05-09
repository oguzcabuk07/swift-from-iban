<?php

namespace OguzCabuk\SwiftFromIban\Test;


use OguzCabuk\SwiftFromIban\SwiftCode;

class SwiftCodeTest extends \PHPUnit_Framework_TestCase
{
    public function testClassLoad()
    {
        $swift = new SwiftCode();

        $this->assertInstanceOf(SwiftCode::class, $swift);
    }

    public function testGetCode()
    {
        $swift = new SwiftCode();

        $code = $swift->getCode("PL69102042870000000000000000");

        $this->assertSame("BPKOPLPWXXX", $code);
    }

}