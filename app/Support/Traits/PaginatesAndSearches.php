<?php

namespace App\Support\Traits;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder as EloquentBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

trait PaginatesAndSearches
{
    /**
     * Adds pagination and search functionality to a query.
     *
     * @param Request $request The request object.
     * @param EloquentBuilder|QueryBuilder $query The query object to add pagination and search to.
     * @param array $fieldsToSearch An array of fields to search.
     * @return Collection|LengthAwarePaginator|array The result of the query with pagination and search applied.
     * @throws \Exception If the 'per_page' parameter is not an integer.
     */
    public function addPaginationAndSearch(
        Request $request,
        EloquentBuilder|QueryBuilder $query,
        array $fieldsToSearch
    ): Collection|LengthAwarePaginator|array {
        // Request parameters
        $orderColumn = $request->input(key: 'order_col');
        $orderDirection = $request->input(key: 'order_dir');
        $search = $request->input(key: 'search');
        $perPage = $request->input('per_page');

        if (isset($perPage) && !is_numeric($perPage)) {
            throw new \InvalidArgumentException('per_page must be an integer');
        }

        $query
            // Ordering
            ->when(
                value: $orderColumn,
                callback: function (EloquentBuilder|QueryBuilder $query, $orderColumn) use ($orderDirection) {
                    $query->orderBy(column: $orderColumn, direction: $orderDirection ?? 'asc');
                }
            )
            // Search
            ->when(
                value: $search,
                callback: function (EloquentBuilder|QueryBuilder $query, $search) use ($fieldsToSearch) {
                    $query->where(function (EloquentBuilder|QueryBuilder $query) use (
                        $search,
                        $fieldsToSearch
                    ) {
                        foreach ($fieldsToSearch as $field) {
                            $query->orWhere(column: $field, operator: 'ILIKE', value: "%$search%");
                        }
                    });
                }
            );

        // Only adds pagination if the 'per_page' parameter is set
        return $perPage ? $query->paginate($perPage) : $query->get();
    }
}
