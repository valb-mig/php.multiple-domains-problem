<?php

declare(strict_types=1);

namespace App\Billing\Infrastructure\Repositories\DebtorRanking\Fake;

use App\Application\Domain\ValueObjects\Result;
use App\Billing\Domain\DTO\DebtorRanking\RankedDebtorDTO;
use App\Billing\Domain\Repositories\DebtorRanking\DebtorRankingRepository;

class FakeRankedDebtorRepository implements DebtorRankingRepository
{
    /**
     * @param Result<RankedDebtorDTO[]> $debtors
     */
    public function listRankedDebtors(): Result
    {
        $debtors = [
            RankedDebtorDTO::from(1, '123456789', 1, 1),
            RankedDebtorDTO::from(2, '123456789', 2, 2),
            RankedDebtorDTO::from(3, '123456789', 3, 3),
            RankedDebtorDTO::from(4, '123456789', 4, 4),
            RankedDebtorDTO::from(5, '123456789', 5, 5),
            RankedDebtorDTO::from(6, '123456789', 6, 6),
            RankedDebtorDTO::from(7, '123456789', 7, 7),
            RankedDebtorDTO::from(8, '123456789', 8, 8),
            RankedDebtorDTO::from(9, '123456789', 9, 9),
            RankedDebtorDTO::from(10, '123456789', 10, 10),
        ];

        return new Result(Result::SUCCESS, 'Debtors ranked', $debtors);
    }
}
