<?php

namespace OxygenSuite\OxygenDcl\Traits;

use OxygenSuite\OxygenDcl\Factories\Factory;

trait HasFactory
{
    /**
     * @return Factory<static>
     */
    public static function factory(int $count = 1): Factory
    {
        return Factory::factoryForModel(get_called_class(), $count);
    }
}
