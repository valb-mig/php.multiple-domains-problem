<?php

declare(strict_types=1);

namespace Tests\Unit\Application\Domain\ValueObjects;

use App\Application\Domain\ValueObjects\Contact\{
    PhoneNumber,
    DDD
};
use App\Application\Domain\ValueObjects\Result;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class PhoneNumberTest extends TestCase
{
    public function testFrom(): void
    {
        $ddd = DDD::from(11);
        $number = 23456789;

        $result = PhoneNumber::from($ddd->getData(), $number);

        self::assertInstanceOf(Result::class, $result);
        self::assertTrue($result->isSuccess());
        self::assertSame('Phone number created', $result->getMessage());
        self::assertInstanceOf(PhoneNumber::class, $result->getData());

        $phoneNumber = $result->getData();

        self::assertSame($ddd->getData(), $phoneNumber->getDDD());
        self::assertSame($number, $phoneNumber->getNumber());
    }

    public function testFromWithInvalidDdd(): void
    {
        $ddd = DDD::from(999);
        $number = 23456789;

        self::expectException(\Throwable::class);

        PhoneNumber::from($ddd->getData(), $number); // INFO: Misstyped DDD
    }

    public function testFromWithInvalidNumber(): void
    {
        $number = 999;

        $result = PhoneNumber::from(DDD::from(11)->getData(), $number);

        self::assertInstanceOf(Result::class, $result);
        self::assertTrue($result->isError());
        self::assertSame('Invalid number, must be 8 digits, got: 999', $result->getMessage());
    }
}
