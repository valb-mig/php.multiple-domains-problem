<?php

declare(strict_types=1);

namespace App\Application\Domain\ValueObjects;

/**
 * @template T
 */
class Result
{
    public const SUCCESS = 'success';
    public const ERROR   = 'error';

    /**
     * @var string
     */
    private $status;

    /**
     * @var string|null
     */
    private $message;

    /**
     * @var T
     */
    private $data;

    /**
     * @param T $data
     */
    public function __construct(
        string $status,
        string $message = null,
        $data = null
    ) {
        if (!in_array($status, [self::SUCCESS, self::ERROR])) {
            throw new \InvalidArgumentException('Status inválido');
        }

        $this->status  = $status;
        $this->message = $message;
        $this->data    = $data;
    }

    /**
     * @return bool
     */

    public function isSuccess(): bool
    {
        return $this->status === self::SUCCESS;
    }

    /**
     * @return bool
     */

    public function isError(): bool
    {
        return $this->status === self::ERROR;
    }

    /**
     * @return string
     */

    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * @return T|null
     */
    public function getData()
    {
        return $this->data;
    }
}
