<?php

declare(strict_types=1);

namespace Framework\Container;

use Exception;

class Container
{
    private array $results = [];

    public function __construct(private array $definitions = [])
    {
    }

    public function get(string $id): mixed
    {
        // Если сервис уже создавался, возвращает его из кэша
        if (array_key_exists($id, $this->results)) {
            return $this->results[$id];
        }

        // Если сервис определен в конфигурации
        if (array_key_exists($id, $this->definitions)) {
            $definition = $this->definitions[$id];
            // Выполняет коллбек или возвращает простое значение
            $result = is_callable($definition) ? $definition($this) : $definition;
            // Сохраняет в кеше
            $this->results[$id] = $result;

            return $result;
        }

        // Если не определен в конфигураци
        throw new Exception('Service '.$id.' not found');
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->definitions);
    }

    public function set(string $id, mixed $value): void
    {
        $this->definitions[$id] = $value;
    }
}
