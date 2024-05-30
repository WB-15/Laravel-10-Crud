<?php

namespace App\Actions\Dish;

use App\Models\Dish;

class RemoveDish
{
    public function handle(Dish $Dish): ?bool
    {
        return $Dish->delete();
    }
}
