<?php

namespace App\Services\Farm;

class Farm
{
    /**
     * Коллекция животных
     *
     * @var array
     */
    private array $animals = [];

    /**
     * Возвращает хранилище животных
     *
     * @return array
     */
    public function getAnimals(): array
    {
        return $this->animals;
    }

    /**
     * Добавление животного в ферму учета
     *
     * @param Animal $animal
     * @return void
     */
    public function addAnimal(Animal $animal): void
    {
        $this->animals[] = $animal;
    }

    /**
     * Количество животных
     *
     * @return int
     */
    public function countAnimals(): int
    {
        return count($this->animals);
    }

    /**
     * Сбор продукции фермы за день
     *
     * @param string $key
     * @return array
     */
    public function collectProduct(string $key = 'type'): array
    {
        $product = [];

        foreach ($this->animals as $animal) {
            /** @var Animal $animal */
            if (!array_key_exists($animal->{$key}, $product)) {
                $product[$animal->{$key}] = 0;
            }

            $product[$animal->{$key}] += $animal->getProducts();
        }

        return $product;
    }
}
