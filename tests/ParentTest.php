<?php

namespace MyWeeklyAllowance\Tests;

use MyWeeklyAllowance\Guardian;
use MyWeeklyAllowance\Teenager;
use PHPUnit\Framework\TestCase;

class GuardianTest extends TestCase
{
    public function testCanCreateGuardian(): void
    {
        $guardian = new Guardian('Alice Smith', 'alice@example.com');
        
        $this->assertInstanceOf(Guardian::class, $guardian);
        $this->assertEquals('Alice Smith', $guardian->getName());
        $this->assertEquals('alice@example.com', $guardian->getEmail());
    }

    public function testGuardianCanCreateTeenagerAccount(): void
    {
        $guardian = new Guardian('Alice Smith', 'alice@example.com');
        $teenager = $guardian->createTeenagerAccount('John Doe', 'john@example.com');
        
        $this->assertInstanceOf(Teenager::class, $teenager);
        $this->assertEquals('John Doe', $teenager->getName());
        $this->assertEquals('john@example.com', $teenager->getEmail());
    }

    public function testGuardianCanDepositMoney(): void
    {
        $guardian = new Guardian('Alice Smith', 'alice@example.com');
        $teenager = $guardian->createTeenagerAccount('John Doe', 'john@example.com');
        
        $guardian->deposit($teenager, 50.0);
        
        $this->assertEquals(50.0, $teenager->getBalance());
    }

    public function testGuardianCanDepositMultipleTimes(): void
    {
        $guardian = new Guardian('Alice Smith', 'alice@example.com');
        $teenager = $guardian->createTeenagerAccount('John Doe', 'john@example.com');
        
        $guardian->deposit($teenager, 30.0);
        $guardian->deposit($teenager, 20.0);
        
        $this->assertEquals(50.0, $teenager->getBalance());
    }

    public function testGuardianCanRecordExpense(): void
    {
        $guardian = new Guardian('Alice Smith', 'alice@example.com');
        $teenager = $guardian->createTeenagerAccount('John Doe', 'john@example.com');
        $guardian->deposit($teenager, 100.0);
        
        $guardian->recordExpense($teenager, 25.0, 'Lunch');
        
        $this->assertEquals(75.0, $teenager->getBalance());
    }

    public function testCannotRecordExpenseIfInsufficientBalance(): void
    {
        $guardian = new Guardian('Alice Smith', 'alice@example.com');
        $teenager = $guardian->createTeenagerAccount('John Doe', 'john@example.com');
        $guardian->deposit($teenager, 10.0);
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Insufficient balance');
        
        $guardian->recordExpense($teenager, 25.0, 'Lunch');
    }

    public function testGuardianCanSetWeeklyAllocation(): void
    {
        $guardian = new Guardian('Alice Smith', 'alice@example.com');
        $teenager = $guardian->createTeenagerAccount('John Doe', 'john@example.com');
        
        $guardian->setWeeklyAllocation($teenager, 20.0);
        
        $this->assertEquals(20.0, $teenager->getWeeklyAllocation());
    }

    public function testWeeklyAllocationIsAppliedAutomatically(): void
    {
        $guardian = new Guardian('Alice Smith', 'alice@example.com');
        $teenager = $guardian->createTeenagerAccount('John Doe', 'john@example.com');
        $guardian->setWeeklyAllocation($teenager, 20.0);
        
        $teenager->applyWeeklyAllocation();
        
        $this->assertEquals(20.0, $teenager->getBalance());
    }

    public function testWeeklyAllocationCanBeAppliedMultipleTimes(): void
    {
        $guardian = new Guardian('Alice Smith', 'alice@example.com');
        $teenager = $guardian->createTeenagerAccount('John Doe', 'john@example.com');
        $guardian->setWeeklyAllocation($teenager, 20.0);
        
        $teenager->applyWeeklyAllocation();
        $teenager->applyWeeklyAllocation();
        
        $this->assertEquals(40.0, $teenager->getBalance());
    }
}

