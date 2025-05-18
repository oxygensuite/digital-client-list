<?php

namespace Tests\Models;

use OxygenSuite\DigitalClient\Models\ClientCorrelation;
use OxygenSuite\DigitalClient\Models\FIMDetail;
use Tests\TestCase;

class ClientCorrelationTest extends TestCase
{
    public function test_it_can_create_a_client_correlation_model_with_mark()
    {
        $clientCorrelation = ClientCorrelation::make()
            ->setCorrelateId('123456789')
            ->setEntityVatNumber('987654321')
            ->setMark('555555555')
            ->setCorrelatedDCLids(['111111', '222222']);

        $this->assertEquals('123456789', $clientCorrelation->getCorrelateId());
        $this->assertEquals('987654321', $clientCorrelation->getEntityVatNumber());
        $this->assertEquals('555555555', $clientCorrelation->getMark());
        $this->assertNull($clientCorrelation->getFIM());
        $this->assertEquals(['111111', '222222'], $clientCorrelation->getCorrelatedDCLids());
    }

    public function test_it_can_create_a_client_correlation_model_with_fim()
    {
        $clientCorrelation = ClientCorrelation::make()
            ->setCorrelateId('123456789')
            ->setEntityVatNumber('987654321')
            ->setFIM(
                FIMDetail::make()
                    ->setFIMNumber('AB123456789')
                    ->setFIMAA('12345')
                    ->setFIMIssueDate('2025-04-10')
                    ->setFIMIssueTime('20:59:00'),
            )
            ->setCorrelatedDCLids(['111111', '222222']);

        $this->assertEquals('123456789', $clientCorrelation->getCorrelateId());
        $this->assertEquals('987654321', $clientCorrelation->getEntityVatNumber());
        $this->assertNull($clientCorrelation->getMark());
        $this->assertInstanceOf(FIMDetail::class, $clientCorrelation->getFIM());
        $this->assertEquals('AB123456789', $clientCorrelation->getFIM()->getFIMNumber());
        $this->assertEquals(['111111', '222222'], $clientCorrelation->getCorrelatedDCLids());
    }

    public function test_it_can_add_correlated_dcl_id()
    {
        $clientCorrelation = ClientCorrelation::make()
            ->setCorrelateId('123456789')
            ->setEntityVatNumber('987654321')
            ->setMark('555555555')
            ->setCorrelatedDCLids(['111111']);

        $clientCorrelation->addCorrelatedDCLid('222222');

        $this->assertEquals(['111111', '222222'], $clientCorrelation->getCorrelatedDCLids());
    }

    public function test_it_can_create_a_client_correlation_model_from_factory()
    {
        $clientCorrelation = ClientCorrelation::factory()->make();

        $this->assertInstanceOf(ClientCorrelation::class, $clientCorrelation);
        $this->assertNotEmpty($clientCorrelation->getCorrelateId());
        $this->assertNotEmpty($clientCorrelation->getEntityVatNumber());
        $this->assertNotEmpty($clientCorrelation->getMark());
        $this->assertInstanceOf(FIMDetail::class, $clientCorrelation->getFIM());
        $this->assertIsArray($clientCorrelation->getCorrelatedDCLids());
        $this->assertNotEmpty($clientCorrelation->getCorrelatedDCLids());
    }

    public function test_it_returns_null_for_unset_properties()
    {
        $clientCorrelation = ClientCorrelation::make();

        $this->assertNull($clientCorrelation->getCorrelateId());
        $this->assertNull($clientCorrelation->getEntityVatNumber());
        $this->assertNull($clientCorrelation->getMark());
        $this->assertNull($clientCorrelation->getFIM());
        $this->assertNull($clientCorrelation->getCorrelatedDCLids());
    }

    public function test_it_can_be_converted_to_array()
    {
        $clientCorrelationArray = ClientCorrelation::make()
            ->setCorrelateId('123456789')
            ->setEntityVatNumber('987654321')
            ->setMark('555555555')
            ->setFIM(
                FIMDetail::make()
                    ->setFIMNumber('AB123456789')
                    ->setFIMAA('12345')
                    ->setFIMIssueDate('2025-04-10')
                    ->setFIMIssueTime('20:59:00'),
            )
            ->setCorrelatedDCLids(['111111', '222222'])
            ->toArray();

        $this->assertIsArray($clientCorrelationArray);
        $this->assertEquals('123456789', $clientCorrelationArray['correlateId']);
        $this->assertEquals('987654321', $clientCorrelationArray['entityVatNumber']);
        $this->assertEquals('555555555', $clientCorrelationArray['mark']);
        $this->assertIsArray($clientCorrelationArray['FIM']);
        $this->assertEquals('AB123456789', $clientCorrelationArray['FIM']['FIMNumber']);
        $this->assertEquals('12345', $clientCorrelationArray['FIM']['FIMAA']);
        $this->assertEquals('2025-04-10', $clientCorrelationArray['FIM']['FIMIssueDate']);
        $this->assertEquals('20:59:00', $clientCorrelationArray['FIM']['FIMIssueTime']);
        $this->assertEquals(['111111', '222222'], $clientCorrelationArray['correlatedDCLids']);
    }
}
