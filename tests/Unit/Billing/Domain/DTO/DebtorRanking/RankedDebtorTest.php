<?php

declare(strict_types=1);

namespace Tests\Unit\Billing\Domain\DTO\DebtorRanking;

use App\Application\Domain\ValueObjects\Result;
use App\Billing\Domain\DTO\DebtorRanking\RankedDebtorDTO;
use PHPUnit\Framework\TestCase;

final class RankedDebtorTest extends TestCase
{
    public function testFrom(): void
    {
        $id = 1;
        $contractNumber = '123456789';
        $debtorRank = 1;
        $phoneCallCount = 1;

        $result = RankedDebtorDTO::from($id, $contractNumber, $debtorRank, $phoneCallCount)->getData();

        self::assertInstanceOf(RankedDebtorDTO::class, $result);
        self::assertSame($id, $result->getId());
        self::assertSame($contractNumber, $result->getContractNumber());
        self::assertSame($debtorRank, $result->getDebtorRank());
        self::assertSame($phoneCallCount, $result->getPhoneCallCount());
    }

    public function testFromWithInvalidId(): void
    {
        $id = 0;
        $contractNumber = '123456789';
        $debtorRank = 1;
        $phoneCallCount = 1;

        $result = RankedDebtorDTO::from($id, $contractNumber, $debtorRank, $phoneCallCount);

        self::assertInstanceOf(Result::class, $result);
        self::assertTrue($result->isError());
        self::assertSame('Invalid id', $result->getMessage());
    }

    public function testFromWithInvalidContractNumber(): void
    {
        $id = 1;
        $contractNumber = '';
        $debtorRank = 1;
        $phoneCallCount = 1;

        $result = RankedDebtorDTO::from($id, $contractNumber, $debtorRank, $phoneCallCount);

        self::assertInstanceOf(Result::class, $result);
        self::assertTrue($result->isError());
        self::assertSame('Invalid contract number', $result->getMessage());
    }

    public function testFromWithInvalidDebtorRank(): void
    {
        $id = 1;
        $contractNumber = '123456789';
        $debtorRank = 0;
        $phoneCallCount = 1;

        $result = RankedDebtorDTO::from($id, $contractNumber, $debtorRank, $phoneCallCount);

        self::assertInstanceOf(Result::class, $result);
        self::assertTrue($result->isError());
        self::assertSame('Invalid debtor rank', $result->getMessage());
    }
}
