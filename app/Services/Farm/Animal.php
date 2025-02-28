<?php

namespace App\Services\Farm;

abstract class Animal
{
    /**
     * Уникальный идентификатор животного
     *
     * @var string
     */
    public string $id;

    /**
     * Тип животного
     *
     * @var string
     */
    public string $type;

    /**
     * Инициализация идентификатора
     */
    public function __construct(string $type)
    {
        $this->id = uniqid();
        $this->type = $type;
    }

    /**
     * Количество продукции животного
     *
     * @return int
     */
    abstract public function getProducts(): int;
}
