<?php

namespace App\Actions\Dish;

use App\Models\Dish;

class CreateDish
{
    public function handle(array $data): Dish
    {
        return Dish::create($data);
    }
}
