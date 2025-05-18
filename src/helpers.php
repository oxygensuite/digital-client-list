<?php

use Faker\Generator;
use OxygenSuite\DigitalClient\Factories\Factory;

if (! function_exists('fake')) {
    function fake(): Generator
    {
        return Factory::fake();
    }
}
