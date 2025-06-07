<?php

declare(strict_types=1);

namespace App\Billing\Domain\Repositories\BillingDebtor;

use App\Application\Domain\ValueObjects\Result;
use App\Billing\Domain\DTO\BillingDebtor\BillingDebtorContactHistoryDTO;

interface BillingDebtorContactHistoryRepository
{
    /**
     * @param Result<BillingDebtorContactHistoryDTO[]> $contactHistory
     */
    public function listBillingDebtorContactHistory(int $debtorId): Result;
}
