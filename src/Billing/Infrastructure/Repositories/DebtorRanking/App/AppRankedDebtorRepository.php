<?php

declare(strict_types=1);

namespace App\Billing\Infrastructure\Repositories\DebtorRanking\App;

use App\Billing\Domain\DTO\DebtorRanking\RankedDebtorDTO;
use App\Billing\Domain\Repositories\DebtorRanking\DebtorRankingRepository;

class AppRankedDebtorRepository implements DebtorRankingRepository
{
    /**
     * @param RankedDebtorDTO[] $debtors
     */
    public function listRankedDebtors(): array
    {
        return [];
    }
}
