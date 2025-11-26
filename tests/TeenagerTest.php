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
}

