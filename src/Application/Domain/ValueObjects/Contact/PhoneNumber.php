<?php

declare(strict_types=1);

namespace App\Application\Domain\ValueObjects\Contact;

use App\Application\Domain\ValueObjects\Contact\DDD;
use App\Application\Domain\ValueObjects\Result;

final class PhoneNumber
{
    private function __construct(
        private readonly DDD $ddd,
        private readonly int $number,
    ) {
    }

    /**
     * @return Result<self>
     */

    public static function from(
        DDD $ddd,
        int $number
    ): Result {
        try {
            if (strlen((string) $number) > 9 || strlen((string) $number) < 8) {
                throw new \Exception('Invalid number, must be 8 digits, got: ' . $number);
            }

            if (strlen((string) $number) == 9) {
                $number = (int) substr((string) $number, 1); // remove the first digit
            }

            return new Result(Result::SUCCESS, 'Phone number created', new self($ddd, $number));
        } catch (\Throwable $e) {
            return new Result(Result::ERROR, $e->getMessage());
        }
    }

    public function getDDD(): DDD
    {
        return $this->ddd;
    }

    public function getNumber(): int
    {
        return $this->number;
    }
}
