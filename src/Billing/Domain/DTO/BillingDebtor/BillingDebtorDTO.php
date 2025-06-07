<?php

declare(strict_types=1);

namespace App\Billing\Domain\DTO\BillingDebtor;

use App\Billing\Domain\DTO\BillingDebtor\BillingDebtorContactHistoryDTO;
use App\Application\Domain\ValueObjects\Contact\PhoneNumber;
use App\Application\Domain\ValueObjects\Result;

final class BillingDebtorDTO
{
    /**
     * @param int $id
     * @param string $contractNumber
     * @param string $name
     * @param PhoneNumber[] $telephones
     * @param BillingDebtorContactHistoryDTO[] $billingContactHistory
     */

    private function __construct(
        private readonly int $id,
        private readonly string $contractNumber,
        private readonly string $name,
        private readonly array $telephones,
        private readonly array $billingDebtorContactHistory,
    ) {
    }

    public static function from(
        int $id,
        string $contractNumber,
        string $name,
        array $telephones,
        array $billingDebtorContactHistory
    ): Result {
        try {
            // INFO: isolated rule for debtor in Billing
            if (count($telephones) > 10) {
                throw new \InvalidArgumentException('Max 10 telephones');
            }

            if (empty($id)) {
                throw new \InvalidArgumentException('Invalid id');
            }

            if (empty($contractNumber)) {
                throw new \InvalidArgumentException('Invalid contract number');
            }

            if (empty($name)) {
                throw new \InvalidArgumentException('Invalid name');
            }

            return new Result(Result::SUCCESS, 'Billing debtor created', new self(
                $id,
                $contractNumber,
                $name,
                $telephones,
                $billingDebtorContactHistory
            ));
        } catch (\Throwable $e) {
            return new Result(Result::ERROR, $e->getMessage());
        }
    }

    /**
     * @return BillingDebtorContactHistoryDTO[]
     */

    public function getBillingDebtorContactHistory(): array
    {
        return $this->billingDebtorContactHistory;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getContractNumber(): string
    {
        return $this->contractNumber;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return PhoneNumber[]
     */

    public function getTelephones(): array
    {
        return $this->telephones;
    }
}
