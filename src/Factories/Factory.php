<?php

namespace OxygenSuite\DigitalClient\Factories;

use Faker\Generator;
use OxygenSuite\DigitalClient\Models\Model;

/**
 * @template TModel of Model
 */
abstract class Factory
{
    private static Generator $faker;

    protected string $modelName;
    protected array $state = [];
    protected array $except = [];
    protected int $count = 1;

    public static function factoryForModel(string $modelName, int $count = 1): Factory
    {
        $factoryModelName = substr($modelName, strrpos($modelName, '\\') + 1);

        $factoryName = __NAMESPACE__.'\\'.$factoryModelName.'Factory';

        $factory = self::newFactory($factoryName);
        $factory->modelName = $modelName;
        $factory->count = $count;
        return $factory;
    }

    public static function newFactory($factoryName): Factory
    {
        return new $factoryName();
    }

    /**
     * @return TModel[]|TModel
     */
    public function make(array $attributes = [])
    {
        $instances = [];
        for ($i = 0; $i < $this->count; $i++) {
            $attributes = array_merge($this->definition(), $attributes, $this->state);

            if (! empty($this->except)) {
                $attributes = array_diff_key($attributes, array_flip($this->except));
            }

            $instance = new $this->modelName();

            foreach ($attributes as $key => $value) {
                if ($value instanceof Factory) {
                    $value = $value->make();
                }

                $instance->set($key, $value);
            }

            $instances[] = $instance;
        }

        return $this->count === 1 ? $instances[0] : $instances;
    }

    public function except(array $fields): self
    {
        $this->except = $fields;

        return $this;
    }

    public function state(array $attributes): self
    {
        $this->state = array_merge($attributes);

        return $this;
    }

    public static function fake(): Generator
    {
        if (isset(self::$faker)) {
            return self::$faker;
        }

        $faker = \Faker\Factory::create();
        $faker->addProvider(new GreekLettersProvider($faker));

        return self::$faker = $faker;
    }

    abstract public function definition(): array;
}
