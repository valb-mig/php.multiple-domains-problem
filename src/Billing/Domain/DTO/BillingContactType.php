<?php

declare(strict_types=1);

namespace App\Billing\Domain\DTO;

final class BillingContactType
{
    public const INFORMACTION = 'informaction';
    public const PAYMENT_COLLECTION = 'payment_collection';

    public const ALL = [
        self::INFORMACTION,
        self::PAYMENT_COLLECTION
    ];
}
