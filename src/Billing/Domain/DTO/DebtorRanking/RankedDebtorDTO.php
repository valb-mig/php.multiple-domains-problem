<?php

declare(strict_types=1);

namespace App\Billing\Domain\DTO\DebtorRanking;

use App\Application\Domain\ValueObjects\Result;

final class RankedDebtorDTO
{
    private function __construct(
        private readonly int $id,
        private readonly string $contractNumber,
        private readonly int $debtorRank,
        private readonly int $phoneCallCount
    ) {
    }

    public static function from(
        int $id,
        string $contractNumber,
        int $debtorRank,
        int $phoneCallCount
    ): Result {
        try {
            if (empty($id)) {
                throw new \InvalidArgumentException('Invalid id');
            }

            if (empty($contractNumber)) {
                throw new \InvalidArgumentException('Invalid contract number');
            }

            if (empty($debtorRank)) {
                throw new \InvalidArgumentException('Invalid debtor rank');
            }

            if (!isset($phoneCallCount)) {
                throw new \InvalidArgumentException('Invalid phone call count');
            }

            return new Result(Result::SUCCESS, 'Billing debtor created', new self(
                $id,
                $contractNumber,
                $debtorRank,
                $phoneCallCount
            ));

        } catch (\Throwable $e) {
            return new Result(Result::ERROR, $e->getMessage());
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getContractNumber(): string
    {
        return $this->contractNumber;
    }

    public function getDebtorRank(): int
    {
        return $this->debtorRank;
    }

    public function getPhoneCallCount(): int
    {
        return $this->phoneCallCount;
    }
}
