<?php

declare(strict_types=1);

namespace App\Billing\Infrastructure\Repositories\BillingDebtor\Fake;

use App\Application\Domain\ValueObjects\Result;
use App\Billing\Domain\DTO\BillingContactType;
use App\Billing\Domain\DTO\BillingDebtor\BillingDebtorContactHistoryDTO;
use App\Billing\Domain\Repositories\BillingDebtor\BillingDebtorContactHistoryRepository;

class FakeBillingDebtorContactHistoryRepository implements BillingDebtorContactHistoryRepository
{
    /**
     * @param Result<BillingDebtorContactHistoryDTO[]> $contactHistory
     */
    public function listBillingDebtorContactHistory(int $debtorId): Result
    {
        $contactHistory = [
            BillingDebtorContactHistoryDTO::from(1, BillingContactType::PAYMENT_COLLECTION, 'Description 1', '2023-01-01'),
            BillingDebtorContactHistoryDTO::from(2, BillingContactType::PAYMENT_COLLECTION, 'Description 2', '2023-01-01'),
        ];

        return new Result(Result::SUCCESS, 'Contact history', $contactHistory);
    }
}
