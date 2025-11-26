<?php

namespace MyWeeklyAllowance;

use InvalidArgumentException;

/**
 * Représente un parent qui peut gérer des comptes adolescents.
 */
class ParentUser
{
    private string $name;
    private string $email;

    public function __construct(string $name, string $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function createTeenagerAccount(string $name, string $email): Teenager
    {
        return new Teenager($name, $email);
    }

    public function deposit(Teenager $teenager, float $amount): void
    {
        if ($amount < 0) {
            throw new InvalidArgumentException('Amount must be positive');
        }

        $teenager->increaseBalance($amount);
    }

    public function recordExpense(Teenager $teenager, float $amount, string $description): void
    {
        try {
            $teenager->decreaseBalance($amount);
        } catch (InvalidArgumentException $e) {
            // Normalize message expected by tests
            if ($e->getMessage() === 'Insufficient balance') {
                throw $e;
            }

            throw $e;
        }
    }

    public function setWeeklyAllocation(Teenager $teenager, float $amount): void
    {
        $teenager->setWeeklyAllocation($amount);
    }
}
