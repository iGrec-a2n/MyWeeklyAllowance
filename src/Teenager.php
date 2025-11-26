<?php

namespace MyWeeklyAllowance;

use InvalidArgumentException;

/**
 * Représente un compte adolescent.
 */
class Teenager
{
    private string $name;
    private string $email;
    private float $balance = 0.0;
    private float $weeklyAllocation = 0.0;

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
        $this->balance = 0.0;
        $this->weeklyAllocation = 0.0;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function getWeeklyAllocation(): float
    {
        return $this->weeklyAllocation;
    }

    public function setWeeklyAllocation(float $amount): void
    {
        if ($amount < 0) {
            throw new InvalidArgumentException('Weekly allocation cannot be negative');
        }

        $this->weeklyAllocation = $amount;
    }

    public function applyWeeklyAllocation(): void
    {
        $this->balance += $this->weeklyAllocation;
    }

    public function increaseBalance(float $amount): void
    {
        if ($amount < 0) {
            throw new InvalidArgumentException('Amount must be positive');
        }

        $this->balance += $amount;
    }

    public function decreaseBalance(float $amount): void
    {
        if ($amount < 0) {
            throw new InvalidArgumentException('Amount must be positive');
        }

        if ($amount > $this->balance) {
            throw new InvalidArgumentException('Insufficient balance');
        }

        $this->balance -= $amount;
    }
}
