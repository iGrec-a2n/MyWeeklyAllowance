<?php

namespace MyWeeklyAllowance\Tests;

use MyWeeklyAllowance\ParentUser;
use MyWeeklyAllowance\Teenager;
use PHPUnit\Framework\TestCase;

class ParentTest extends TestCase
{
    public function testCanCreateParent(): void
    {
        $parent = new ParentUser('Alice Smith', 'alice@example.com');
        
        $this->assertInstanceOf(ParentUser::class, $parent);
        $this->assertEquals('Alice Smith', $parent->getName());
        $this->assertEquals('alice@example.com', $parent->getEmail());
    }

    public function testParentCanCreateTeenagerAccount(): void
    {
        $parent = new ParentUser('Alice Smith', 'alice@example.com');
        $teenager = $parent->createTeenagerAccount('John Doe', 'john@example.com');
        
        $this->assertInstanceOf(Teenager::class, $teenager);
        $this->assertEquals('John Doe', $teenager->getName());
        $this->assertEquals('john@example.com', $teenager->getEmail());
    }

    public function testParentCanDepositMoney(): void
    {
        $parent = new ParentUser('Alice Smith', 'alice@example.com');
        $teenager = $parent->createTeenagerAccount('John Doe', 'john@example.com');
        
        $parent->deposit($teenager, 50.0);
        
        $this->assertEquals(50.0, $teenager->getBalance());
    }

    public function testParentCanDepositMultipleTimes(): void
    {
        $parent = new ParentUser('Alice Smith', 'alice@example.com');
        $teenager = $parent->createTeenagerAccount('John Doe', 'john@example.com');
        
        $parent->deposit($teenager, 30.0);
        $parent->deposit($teenager, 20.0);
        
        $this->assertEquals(50.0, $teenager->getBalance());
    }

    public function testParentCanRecordExpense(): void
    {
        $parent = new ParentUser('Alice Smith', 'alice@example.com');
        $teenager = $parent->createTeenagerAccount('John Doe', 'john@example.com');
        $parent->deposit($teenager, 100.0);
        
        $parent->recordExpense($teenager, 25.0, 'Lunch');
        
        $this->assertEquals(75.0, $teenager->getBalance());
    }

    public function testCannotRecordExpenseIfInsufficientBalance(): void
    {
        $parent = new ParentUser('Alice Smith', 'alice@example.com');
        $teenager = $parent->createTeenagerAccount('John Doe', 'john@example.com');
        $parent->deposit($teenager, 10.0);
        
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Insufficient balance');
        
        $parent->recordExpense($teenager, 25.0, 'Lunch');
    }

    public function testParentCanSetWeeklyAllocation(): void
    {
        $parent = new ParentUser('Alice Smith', 'alice@example.com');
        $teenager = $parent->createTeenagerAccount('John Doe', 'john@example.com');
        
        $parent->setWeeklyAllocation($teenager, 20.0);
        
        $this->assertEquals(20.0, $teenager->getWeeklyAllocation());
    }

    public function testWeeklyAllocationIsAppliedAutomatically(): void
    {
        $parent = new ParentUser('Alice Smith', 'alice@example.com');
        $teenager = $parent->createTeenagerAccount('John Doe', 'john@example.com');
        $parent->setWeeklyAllocation($teenager, 20.0);
        
        $teenager->applyWeeklyAllocation();
        
        $this->assertEquals(20.0, $teenager->getBalance());
    }

    public function testWeeklyAllocationCanBeAppliedMultipleTimes(): void
    {
        $parent = new ParentUser('Alice Smith', 'alice@example.com');
        $teenager = $parent->createTeenagerAccount('John Doe', 'john@example.com');
        $parent->setWeeklyAllocation($teenager, 20.0);
        
        $teenager->applyWeeklyAllocation();
        $teenager->applyWeeklyAllocation();
        
        $this->assertEquals(40.0, $teenager->getBalance());
    }
}
