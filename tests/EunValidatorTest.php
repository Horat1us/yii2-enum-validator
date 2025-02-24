<?php

declare(strict_types=1);

namespace Horat1us\Yii\Tests;

use Horat1us\Yii\EnumValidator;
use PHPUnit\Framework\TestCase;

class EunValidatorTest extends TestCase
{
    public function testValidatorRequiresEnumClass()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('EnumClass must be set');

        new EnumValidator();
    }

    public function testValidatorRequiresValidEnumClass()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('NonExistentEnum is not a valid enum class');

        $validator = new EnumValidator([
            'enumClass' => 'NonExistentEnum',
        ]);
    }

    public function testValidatesStringEnum()
    {
        $validator = new EnumValidator([
            'enumClass' => TestEnum::class,
        ]);

        $this->assertTrue($validator->validate('one'));
        $this->assertTrue($validator->validate('two'));
        $this->assertTrue($validator->validate('three'));
        $this->assertFalse($validator->validate('four'));
        $this->assertFalse($validator->validate(''));
        $this->assertFalse($validator->validate(null));
    }

    public function testValidatesIntEnum()
    {
        $validator = new EnumValidator([
            'enumClass' => TestIntEnum::class,
            'strict' => true,
        ]);

        $this->assertTrue($validator->validate(1));
        $this->assertTrue($validator->validate(2));
        $this->assertTrue($validator->validate(3));
        $this->assertFalse($validator->validate(4));
        $this->assertFalse($validator->validate('1'));
        $this->assertFalse($validator->validate(null));
    }
}
