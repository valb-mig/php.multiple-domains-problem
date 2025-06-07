<?php

declare(strict_types=1);

namespace Tests\Unit\Billing\Domain\DTO\BillingDebtor;

use App\Application\Domain\ValueObjects\Contact\{
    DDD,
    PhoneNumber
};
use App\Application\Domain\ValueObjects\Result;
use App\Billing\Domain\DTO\BillingContactType;
use App\Billing\Domain\DTO\BillingDebtor\{
    BillingDebtorContactHistoryDTO,
    BillingDebtorDTO
};
use PHPUnit\Framework\TestCase;

final class BillingDebtorTest extends TestCase
{
    public function testFrom(): void
    {
        $id = 1;
        $contractNumber = '123456789';
        $name = 'Debtor 1';
        $telephones = [
            PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData(),
            PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData(),
            PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData(),
            PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData(),
            PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData()
        ];
        $billingContactHistory = [
            BillingDebtorContactHistoryDTO::from(1, BillingContactType::PAYMENT_COLLECTION, 'Description 1', '2023-01-01'),
            BillingDebtorContactHistoryDTO::from(2, BillingContactType::PAYMENT_COLLECTION, 'Description 2', '2023-01-01'),
        ];

        $result = BillingDebtorDTO::from($id, $contractNumber, $name, $telephones, $billingContactHistory)->getData();

        self::assertInstanceOf(BillingDebtorDTO::class, $result);
        self::assertSame($id, $result->getId());
        self::assertSame($contractNumber, $result->getContractNumber());
        self::assertSame($name, $result->getName());
        self::assertSame($telephones, $result->getTelephones());
        self::assertSame($billingContactHistory, $result->getBillingDebtorContactHistory());
    }

    public function testFromWithInvalidId(): void
    {
        $id = 0;
        $contractNumber = '123456789';
        $name = 'Debtor 1';
        $telephones = [
            PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData(),
            PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData(),
        ];
        $billingContactHistory = [];
        $result = BillingDebtorDTO::from($id, $contractNumber, $name, $telephones, $billingContactHistory);

        self::assertInstanceOf(Result::class, $result);
        self::assertTrue($result->isError());
        self::assertSame('Invalid id', $result->getMessage());
    }

    public function testFromWithInvalidContractNumber(): void
    {
        $id = 1;
        $contractNumber = '';
        $name = 'Debtor 1';
        $telephones = [
            PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData(),
            PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData(),
            PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData(),
            PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData(),
            PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData()
        ];
        $billingContactHistory = [
            BillingDebtorContactHistoryDTO::from(1, BillingContactType::PAYMENT_COLLECTION, 'Description 1', '2023-01-01'),
            BillingDebtorContactHistoryDTO::from(2, BillingContactType::PAYMENT_COLLECTION, 'Description 2', '2023-01-01'),
        ];

        $result = BillingDebtorDTO::from($id, $contractNumber, $name, $telephones, $billingContactHistory);

        self::assertInstanceOf(Result::class, $result);
        self::assertTrue($result->isError());
        self::assertSame('Invalid contract number', $result->getMessage());
    }

    public function testFromWithInvalidName(): void
    {
        $id = 1;
        $contractNumber = '123456789';
        $name = '';
        $telephones = [
            PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData(),
            PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData(),
            PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData(),
            PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData(),
            PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData()
        ];
        $billingContactHistory = [
            BillingDebtorContactHistoryDTO::from(1, BillingContactType::PAYMENT_COLLECTION, 'Description 1', '2023-01-01'),
            BillingDebtorContactHistoryDTO::from(2, BillingContactType::PAYMENT_COLLECTION, 'Description 2', '2023-01-01'),
        ];

        $result = BillingDebtorDTO::from($id, $contractNumber, $name, $telephones, $billingContactHistory);

        self::assertInstanceOf(Result::class, $result);
        self::assertTrue($result->isError());
        self::assertSame('Invalid name', $result->getMessage());
    }
}
