<?php

use Faker\Generator;
use OxygenSuite\OxygenDcl\Factories\Factory;

if (! function_exists('fake')) {
    function fake(): Generator
    {
        return Factory::fake();
    }
}
