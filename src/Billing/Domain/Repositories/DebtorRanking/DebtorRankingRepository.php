<?php

declare(strict_types=1);

namespace App\Billing\Domain\Repositories\DebtorRanking;

use App\Application\Domain\ValueObjects\Result;
use App\Billing\Domain\DTO\DebtorRanking\RankedDebtorDTO;

interface DebtorRankingRepository
{
    /**
     * @param Result<RankedDebtorDTO[]> $debtors
     */
    public function listRankedDebtors(): Result;
}
