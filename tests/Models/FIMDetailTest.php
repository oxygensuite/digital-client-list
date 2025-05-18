<?php

namespace Tests\Models;

use OxygenSuite\DigitalClient\Models\FIMDetail;
use Tests\TestCase;

class FIMDetailTest extends TestCase
{
    public function test_it_can_create_a_fim_detail_model()
    {
        $fimDetail = FIMDetail::make()
            ->setFIMNumber('AB123456789')
            ->setFIMAA('12345')
            ->setFIMIssueDate('2025-04-10')
            ->setFIMIssueTime('20:59:00');

        $this->assertEquals('AB123456789', $fimDetail->getFIMNumber());
        $this->assertEquals('12345', $fimDetail->getFIMAA());
        $this->assertEquals('2025-04-10', $fimDetail->getFIMIssueDate());
        $this->assertEquals('20:59:00', $fimDetail->getFIMIssueTime());
    }

    public function test_it_can_create_a_fim_detail_model_from_factory()
    {
        $fimDetail = FIMDetail::factory()->make();

        $this->assertInstanceOf(FIMDetail::class, $fimDetail);
        $this->assertNotEmpty($fimDetail->getFIMNumber());
        $this->assertNotEmpty($fimDetail->getFIMAA());
        $this->assertNotEmpty($fimDetail->getFIMIssueDate());
        $this->assertNotEmpty($fimDetail->getFIMIssueTime());
    }

    public function test_it_returns_null_for_unset_properties()
    {
        $fimDetail = new FIMDetail();

        $this->assertNull($fimDetail->getFIMNumber());
        $this->assertNull($fimDetail->getFIMAA());
        $this->assertNull($fimDetail->getFIMIssueDate());
        $this->assertNull($fimDetail->getFIMIssueTime());
    }

    public function test_it_can_be_converted_to_array()
    {
        $fimDetailArray = FIMDetail::make()
            ->setFIMNumber('AB123456789')
            ->setFIMAA('12345')
            ->setFIMIssueDate('2025-04-10')
            ->setFIMIssueTime('20:59:00')
            ->toArray();


        $this->assertIsArray($fimDetailArray);
        $this->assertEquals('AB123456789', $fimDetailArray['FIMNumber']);
        $this->assertEquals('12345', $fimDetailArray['FIMAA']);
        $this->assertEquals('2025-04-10', $fimDetailArray['FIMIssueDate']);
        $this->assertEquals('20:59:00', $fimDetailArray['FIMIssueTime']);
    }
}
