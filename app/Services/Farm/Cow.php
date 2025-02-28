<?php

namespace App\Services\Farm;

use Random\RandomException;

class Cow extends Animal
{
    /**
     * Минимальное количество молока за дой
     */
    const MIN_MILK_AMOUNT = 8;

    /**
     * Максимальное количество молока за дой
     */
    const MAX_MILK_AMOUNT = 12;

    /**
     * Передаем тип животного
     * PS: решение не очень, потому что типы животного должны быть доступны из вне
     */
    public function __construct()
    {
        parent::__construct(strtolower(__CLASS__));
    }

    /**
     * Рандомное количество молока от коровы
     *
     * @return int
     * @throws RandomException
     */
    public function getProducts(): int
    {
        return random_int(self::MIN_MILK_AMOUNT, self::MAX_MILK_AMOUNT);
    }
}
