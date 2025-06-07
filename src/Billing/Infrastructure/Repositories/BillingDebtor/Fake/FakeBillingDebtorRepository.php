<?php

declare(strict_types=1);

namespace App\Billing\Infrastructure\Repositories\BillingDebtor\Fake;

use App\Application\Domain\ValueObjects\Contact\{
    DDD,
    PhoneNumber
};
use App\Application\Domain\ValueObjects\Result;
use App\Billing\Domain\DTO\BillingContactType;
use App\Billing\Domain\DTO\BillingDebtor\BillingDebtorContactHistoryDTO;
use App\Billing\Domain\DTO\BillingDebtorDTO;
use App\Billing\Domain\Repositories\BillingDebtor\BillingDebtorRepository;

class FakeBillingDebtorRepository implements BillingDebtorRepository
{
    /**
     * @param Result<BillingDebtorDTO[]> $debtors
     */
    public function listBillingDebtors(): Result
    {
        $debtors = [
            BillingDebtorDTO::from(
                1,
                '123456789',
                'Debtor 1',
                [
                PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData(),
                PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData(),
                PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData(),
                PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData(),
                PhoneNumber::from(DDD::from(11)->getData(), 23456789)->getData()
            ],
                [
                BillingDebtorContactHistoryDTO::from(1, BillingContactType::PAYMENT_COLLECTION, 'Description 1', '2023-01-01'),
                BillingDebtorContactHistoryDTO::from(2, BillingContactType::PAYMENT_COLLECTION, 'Description 2', '2023-01-01'),
            ]
            )
        ];

        return new Result(Result::SUCCESS, 'Debtors list', $debtors);
    }
}
