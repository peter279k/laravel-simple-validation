<?php

namespace Lee\LaraSimpleValidation\Tests;

use Lee\LaraSimpleValidation\LaraSimpleValidation;
use PHPUnit\Framework\TestCase;

class LaraSimpleValidationTest extends TestCase
{
    public function testIsString()
    {
        $validation = new LaraSimpleValidation();
        $validation->setValidationType('string');

        $this->assertTrue($validation->passes('string', '123456'));
    }

    public function testIsEmailFormat()
    {
        $validation = new LaraSimpleValidation();
        $validation->setValidationType('email');

        $this->assertTrue($validation->passes('email', 'peter279k@gmail.com'));
        $this->assertFalse($validation->passes('email', '123456'));
    }

    public function testIsIpFormat()
    {
        $validation = new LaraSimpleValidation();
        $validation->setValidationType('ip');

        $this->assertTrue($validation->passes('ip_address', '192.168.1.1'));
        $this->assertFalse($validation->passes('ip_address', '192.168.1'));
    }

    public function testIsValidLength()
    {
        $validation = new LaraSimpleValidation();
        $validation->setValidationType('length');
        $validation->setValidationLength(6);

        $this->assertTrue($validation->passes('length', ''));
    }

    public function testPassesOnUnsupportedType()
    {
        $validation = new LaraSimpleValidation();
        $validation->setValidationType('unsupported_type');

        $this->assertFalse($validation->passes('attribute_name', 'value'));
    }

    public function testSetValidationType()
    {
        $validation = new LaraSimpleValidation();
        $validation->setValidationType('ip');

        $this->assertSame('ip', $validation->getValidationType());
    }

    public function invalidMessageFormatProvider()
    {
        return [
            [
                [
                    'validation.rule.name' => 'rule_name',
                ]
            ],
            [
                [
                    'invalid_rule' => 'rule_name',
                ],
            ],
        ];
    }

    /**
     * @dataProvider invalidMessageFormatProvider
     */
    public function testSetMessageFormatOnInvalidMessageFormat($messageFormat)
    {
        $validation = new LaraSimpleValidation();

        $this->expectException(\InvalidArgumentException::class);

        $validation->setMessageFormat($messageFormat);
    }

    public function testSetMessageFormat()
    {
        $validation = new LaraSimpleValidation();
        $expectedMessageFormat = [
            'validation.rule.name' => 'rule_name',
            'validation.rule.message' => 'rule_message',
        ];
        $validation->setMessageFormat($expectedMessageFormat);

        $this->assertSame($expectedMessageFormat, $validation->getMessageFormat());
    }
}
