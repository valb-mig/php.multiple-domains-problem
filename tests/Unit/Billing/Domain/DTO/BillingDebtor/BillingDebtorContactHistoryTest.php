<?php

declare(strict_types=1);

namespace Tests\Unit\Billing\Domain\DTO\BillingDebtor;

use App\Application\Domain\ValueObjects\Result;
use App\Billing\Domain\DTO\BillingContactType;
use App\Billing\Domain\DTO\BillingDebtor\BillingDebtorContactHistoryDTO;
use PHPUnit\Framework\TestCase;

final class BillingDebtorContactHistoryTest extends TestCase
{
    public function testFrom(): void
    {
        $id = 1;
        $type = BillingContactType::PAYMENT_COLLECTION;
        $description = 'Description 1';
        $date = '2023-01-01';

        $result = BillingDebtorContactHistoryDTO::from($id, $type, $description, $date)->getData();

        self::assertInstanceOf(BillingDebtorContactHistoryDTO::class, $result);
        self::assertSame($id, $result->getId());
        self::assertSame($type, $result->getType());
        self::assertSame($description, $result->getDescription());
        self::assertSame($date, $result->getDate());
    }

    public function testFromWithInvalidId(): void
    {
        $id = 0;
        $type = BillingContactType::PAYMENT_COLLECTION;
        $description = 'Description 1';
        $date = '2023-01-01';

        $result = BillingDebtorContactHistoryDTO::from($id, $type, $description, $date);

        self::assertInstanceOf(Result::class, $result);
        self::assertTrue($result->isError());
        self::assertSame('Invalid id', $result->getMessage());
    }

    public function testFromWithInvalidType(): void
    {
        $id = 1;
        $type = 'invalid';
        $description = 'Description 1';
        $date = '2023-01-01';

        $result = BillingDebtorContactHistoryDTO::from($id, $type, $description, $date);

        self::assertInstanceOf(Result::class, $result);
        self::assertTrue($result->isError());
        self::assertSame('Invalid type', $result->getMessage());
    }

    public function testFromWithInvalidDescription(): void
    {
        $id = 1;
        $type = BillingContactType::PAYMENT_COLLECTION;
        $description = '';
        $date = '2023-01-01';

        $result = BillingDebtorContactHistoryDTO::from($id, $type, $description, $date);

        self::assertInstanceOf(Result::class, $result);
        self::assertTrue($result->isError());
        self::assertSame('Invalid description', $result->getMessage());
    }

    public function testFromWithInvalidDate(): void
    {
        $id = 1;
        $type = BillingContactType::PAYMENT_COLLECTION;
        $description = 'Description 1';
        $date = '';

        $result = BillingDebtorContactHistoryDTO::from($id, $type, $description, $date);

        self::assertInstanceOf(Result::class, $result);
        self::assertTrue($result->isError());
        self::assertSame('Invalid date', $result->getMessage());
    }
}
