<?php

use Illuminate\Database\Seeder;
use App\TypeOfPlace;

class TypeOfPlaceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typesOfPlace = [
            [
                'name' => 'Полицейский участок',
                'path_to_icon' => 'https://img.icons8.com/office/40/000000/police-station.png'
            ],
            [
                'name' => 'Аптека',
                'path_to_icon' => 'https://img.icons8.com/office/40/000000/hospital.png'
            ],
            [
                'name' => 'Оружейный магазин',
                'path_to_icon' => 'https://img.icons8.com/office/40/000000/gun.png'
            ],
            [
                'name' => 'Продуктовый магазин',
                'path_to_icon' => 'https://img.icons8.com/office/40/000000/shop.png'
            ],
            [
                'name' => 'Больница',
                'path_to_icon' => 'https://img.icons8.com/office/40/000000/hospital-2.png'
            ],
        ];

        foreach ($typesOfPlace as $typeOfPlace){
            TypeOfPlace::create($typeOfPlace);
        }
    }
}
