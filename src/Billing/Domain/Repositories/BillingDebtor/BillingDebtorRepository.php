<?php

declare(strict_types=1);

namespace App\Billing\Domain\Repositories\BillingDebtor;

use App\Application\Domain\ValueObjects\Result;
use App\Billing\Domain\DTO\BillingDebtorDTO;

interface BillingDebtorRepository
{
    /**
     * @param Result<BillingDebtorDTO[]> $debtors
     */
    public function listBillingDebtors(): Result;
}
