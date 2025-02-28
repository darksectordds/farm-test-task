<?php

namespace App\Services\Farm;

class Chicken extends Animal
{
    /**
     * Минимальное количество яиц за кладку
     */
    const MIN_EGGS_AMOUNT = 0;
    /**
     * Максимальное количество яиц за кладку
     */
    const MAX_EGGS_AMOUNT = 1;

    /**
     * Передаем тип животного
     * PS: решение не очень, потому что типы животного должны быть доступны из вне
     */
    public function __construct()
    {
        parent::__construct(strtolower(__CLASS__));
    }

    /**
     * Рандомное количество яиц от курицы
     *
     * @return int
     * @throws \Random\RandomException
     */
    public function getProducts(): int
    {
        return random_int(self::MIN_EGGS_AMOUNT, self::MAX_EGGS_AMOUNT);
    }
}
