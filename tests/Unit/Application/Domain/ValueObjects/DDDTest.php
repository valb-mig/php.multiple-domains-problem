<?php

declare(strict_types=1);

namespace Tests\Unit\Application\Domain\ValueObjects;

use App\Application\Domain\ValueObjects\Contact\DDD;
use App\Application\Domain\ValueObjects\Result;
use PHPUnit\Framework\TestCase;

final class DDDTest extends TestCase
{
    public function testFrom(): void
    {
        $code = 11;
        $result = DDD::from($code);

        self::assertInstanceOf(Result::class, $result);
        self::assertSame($code, $result->getData()->getCode());
    }

    public function testFromWithInvalidCode(): void
    {
        $result = DDD::from(999);

        self::assertInstanceOf(Result::class, $result);
        self::assertTrue($result->isError());
        self::assertSame('Código DDD inválido: 999', $result->getMessage());
        self::assertNull($result->getData());
    }
}
