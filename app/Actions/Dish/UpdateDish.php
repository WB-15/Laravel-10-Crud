<?php

namespace App\Actions\Dish;

use App\Models\Dish;

class UpdateDish
{
    public function handle(Dish $Dish, array $data): bool|Dish
    {
        $Dish->forceFill($data);
        if ($Dish->save()) {
            return $Dish->refresh();
        }

        return false;
    }
}
