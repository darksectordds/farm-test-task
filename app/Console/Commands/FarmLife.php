<?php

namespace App\Console\Commands;

use App\Services\Farm\Chicken;
use App\Services\Farm\Cow;
use App\Services\Farm\Farm;
use Illuminate\Console\Command;

use function App\Services\mapper;

class FarmLife extends Command
{
    const COW_COUNT = 10;
    const CHICKEN_COUNT = 20;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'farm:life';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '- Система должна добавить животных в хлев (10 коров и 20 кур).
             - Вывести на экран информацию о количестве каждого типа животных на ферме.
             - 7 раз (неделю) произвести сбор продукции (подоить коров и собрать яйца у кур).
             - Вывести на экран общее кол-во собранной за неделю продукции каждого типа.
             - Добавить на ферму ещё 5 кур и 1 корову (съездили на рынок, купили животных).
             - Снова вывести информацию о количестве каждого типа животных на ферме.
             - Снова 7 раз (неделю) производим сбор продукции и выводим результат на экран.';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $farm = new Farm();

        $funRegisterAnimals = function (int $count, string $class) use (&$farm) {
            for($i = 1; $i <= $count; $i++) {
                $farm->addAnimal(new $class);
            }
        };
        $funcMergeAndSumProductByType = function (array $product,array &$res) {
            foreach ($product as $type => $count) {
                if (!array_key_exists($type, $res)) {
                    $res[$type] = 0;
                }

                $res[$type] += $count;
            }
        };
        $funcPrintAnimalsByGroup = function (array $animalsGroupByType) {
            $translate = [
                strtolower(Cow::class) => 'Коров',
                strtolower(Chicken::class) => 'Курочек',
            ];

            foreach ($animalsGroupByType as $type => $animals) {
                $trans = $translate[$type];
                echo "$trans: ".count($animals).PHP_EOL;
            }
        };
        $funcPrintProductByType = function (array $product) {
            $translate = [
                strtolower(Cow::class) => 'Молока',
                strtolower(Chicken::class) => 'Яиц',
            ];

            foreach ($product as $type => $count) {
                $trans = $translate[$type];
                echo "$trans: $count".PHP_EOL;
            }
        };

        // - Система должна добавить животных в хлев (10 коров и 20 кур).
        $funRegisterAnimals(self::COW_COUNT, Cow::class);
        $funRegisterAnimals(self::CHICKEN_COUNT, Chicken::class);

        // - Вывести на экран информацию о количестве каждого типа животных на ферме.
        $animals = $farm->getAnimals();
        $animalsGroupByType = mapper($animals, 'type', true);
        $funcPrintAnimalsByGroup($animalsGroupByType);

        $weakProduct = [];

        // - 7 раз (неделю) произвести сбор продукции (подоить коров и собрать яйца у кур).
        for($day = 1; $day <= 7; $day++) {
            $product = $farm->collectProduct();

            $funcMergeAndSumProductByType($product, $weakProduct);
        }
        // - Вывести на экран общее кол-во собранной за неделю продукции каждого типа.
        $funcPrintProductByType($weakProduct);


        // визуальный разделитель
        echo str_repeat('-', 10).PHP_EOL;


        // - Добавить на ферму ещё 5 кур и 1 корову (съездили на рынок, купили животных).
        $funRegisterAnimals(1, Cow::class);
        $funRegisterAnimals(5, Chicken::class);

        // - Снова вывести информацию о количестве каждого типа животных на ферме.
        $animals = $farm->getAnimals();
        $animalsGroupByType = mapper($animals, 'type', true);
        $funcPrintAnimalsByGroup($animalsGroupByType);

        // - Снова 7 раз (неделю) производим сбор продукции и выводим результат на экран.
        for($day = 1; $day <= 7; $day++) {
            $product = $farm->collectProduct();

            $funcMergeAndSumProductByType($product, $weakProduct);
        }
        $funcPrintProductByType($weakProduct);
    }
}
