<?php

namespace OxygenSuite\DigitalClient\Models;

use ArrayAccess;
use ArrayIterator;
use Countable;
use IteratorAggregate;
use Traversable;

/**
 * @template TModel
 *
 * @template-implements IteratorAggregate<int, TModel>
 * @template-implements ArrayAccess<int, TModel>
 */
class ModelArray extends Model implements IteratorAggregate, ArrayAccess, Countable
{
    protected string $childKey;

    /**
     * @param string $childKey
     * @param TModel|TModel[] $items
     */
    public function __construct(string $childKey, mixed $items = null)
    {
        parent::__construct();

        $this->childKey = $childKey;

        if ($items !== null) {
            $this->set($childKey, $items);
        }
    }

    /**
     * @param  int  $key
     * @param  TModel|TModel[]  $value
     * @return static
     */
    public function set($key, $value): static
    {
        $value = is_array($value) ? $value : [$value];
        $this->attributes[$this->childKey] = $value;
        return $this;
    }

    /**
     * @param TModel $value
     * @return void
     */
    public function add($value): void
    {
        $this->push($this->childKey, $value);
    }

    /**
     * @return ?TModel
     */
    public function first()
    {
        return $this->offsetGet(0);
    }

    /**
     * @param  int  $key
     * @param  null  $value
     * @return ModelArray
     */
    public function push($key, $value = null): static
    {
        if (is_array($value)) {
            $this->attributes[$this->childKey] = array_merge($this->attributes[$this->childKey], $value);
        } else {
            $this->attributes[$this->childKey][] = $value;
        }

        return $this;
    }

    /**
     * @return Traversable<int, TModel>
     */
    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->attributes[$this->childKey]);
    }

    /**
     * @param int $offset
     * @return bool
     */
    public function offsetExists($offset): bool
    {
        return isset($this->attributes[$this->childKey][$offset]);
    }

    /**
     * @param int $offset
     * @return TModel
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->attributes[$this->childKey][$offset];
    }

    /**
     * @param int $offset
     * @param TModel $value
     * @return void
     */
    public function offsetSet($offset, $value): void
    {
        $this->attributes[$this->childKey][$offset] = $value;
    }

    /**
     * @param int $offset
     * @return void
     */
    public function offsetUnset($offset): void
    {
        unset($this->attributes[$this->childKey][$offset]);
    }

    public function count(): int
    {
        return count($this->attributes[$this->childKey] ?? []);
    }

    /**
     * @return TModel[]
     */
    public function all(): array
    {
        return $this->attributes[$this->childKey] ?? [];
    }
}
