<?php

namespace App\Actions\Dish;

use App\Models\Dish;
use App\Support\Traits\PaginatesAndSearches;
use Illuminate\Http\Request;

class ListAllDishes
{
    use PaginatesAndSearches;
    /**
     * List all Dishs
     *
     * @param Request $request
     * @return mixed
     */
    public function handle(Request $request): mixed
    {
        return $this->addPaginationAndSearch(
            request: $request,
            query: Dish::query(),
            fieldsToSearch: ['name']
        );
    }
}
