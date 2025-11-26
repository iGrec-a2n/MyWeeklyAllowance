<?php

namespace MyWeeklyAllowance\Tests;

use MyWeeklyAllowance\Teenager;
use PHPUnit\Framework\TestCase;

class TeenagerTest extends TestCase
{
    public function testCanCreateTeenagerAccount(): void
    {
        $teenager = new Teenager('John Doe', 'john@example.com');
        
        $this->assertInstanceOf(Teenager::class, $teenager);
        $this->assertEquals('John Doe', $teenager->getName());
        $this->assertEquals('john@example.com', $teenager->getEmail());
        $this->assertEquals(0.0, $teenager->getBalance());
    }

    public function testTeenagerHasInitialBalanceOfZero(): void
    {
        $teenager = new Teenager('Jane Doe', 'jane@example.com');
        
        $this->assertEquals(0.0, $teenager->getBalance());
    }

    public function testSetWeeklyAllocationRejectsNegative(): void
    {
        $teenager = new Teenager('Test', 'test@example.com');

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Weekly allocation cannot be negative');

        $teenager->setWeeklyAllocation(-5.0);
    }

    public function testIncreaseBalanceRejectsNegative(): void
    {
        $teenager = new Teenager('Test', 'test@example.com');

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Amount must be positive');

        $teenager->increaseBalance(-10.0);
    }

    public function testDecreaseBalanceRejectsNegative(): void
    {
        $teenager = new Teenager('Test', 'test@example.com');

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Amount must be positive');

        $teenager->decreaseBalance(-3.0);
    }

    public function testDecreaseBalanceThrowsWhenInsufficient(): void
    {
        $teenager = new Teenager('Test', 'test@example.com');

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Insufficient balance');

        $teenager->decreaseBalance(1.0);
    }
}

