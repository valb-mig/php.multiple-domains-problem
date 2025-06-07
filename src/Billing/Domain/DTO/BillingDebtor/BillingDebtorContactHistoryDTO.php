<?php

declare(strict_types=1);

namespace App\Billing\Domain\DTO\BillingDebtor;

use App\Billing\Domain\DTO\BillingContactType;
use App\Application\Domain\ValueObjects\Result;

class BillingDebtorContactHistoryDTO
{
    private function __construct(
        private readonly int $id,
        private readonly string $type,
        private readonly string $description,
        private readonly string $date,
    ) {
    }

    public static function from(
        int $id,
        string $type,
        string $description,
        string $date
    ): Result {
        try {
            if (empty($id)) {
                throw new \InvalidArgumentException('Invalid id');
            }

            if (empty($type) || !in_array($type, BillingContactType::ALL, true)) {
                throw new \InvalidArgumentException('Invalid type');
            }

            if (empty($description)) {
                throw new \InvalidArgumentException('Invalid description');
            }

            if (empty($date)) {
                throw new \InvalidArgumentException('Invalid date');
            }

            return new Result(Result::SUCCESS, 'Billing history debtor created', new self(
                $id,
                $type,
                $description,
                $date
            ));
        } catch (\Throwable $e) {
            return new Result(Result::ERROR, $e->getMessage());
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getDate(): string
    {
        return $this->date;
    }
}
