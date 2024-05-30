<?php

namespace App\Http\Controllers;

use App\Actions\Dish\CreateDish;
use App\Actions\Dish\ListAllDishes;
use App\Actions\Dish\RemoveDish;
use App\Actions\Dish\UpdateDish;

use App\Http\Requests\DishRequest;
use App\Http\Requests\DishUpdateRequest;
use App\Http\Resources\DishResource;

use App\Models\Dish;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class DishController extends Controller
{
    public function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, ListAllDishes $listAllDishes): AnonymousResourceCollection
    {
        return DishResource::collection($listAllDishes->handle(request: $request));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DishRequest $request, CreateDish $DishCreator): DishResource
    {
        $Dish = $DishCreator->handle($request->safe()->toArray());
        return DishResource::make($Dish);
    }

    /**
     * Display the specified resource.
     */
    public function show(Dish $Dish): DishResource
    {
        return DishResource::make($Dish);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DishUpdateRequest $request, Dish $Dish, UpdateDish $DishUpdater): DishResource
    {
        $updatedDish = $DishUpdater->handle(Dish: $Dish, data: $request->safe()->toArray());
        return DishResource::make($updatedDish);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Dish $Dish, RemoveDish $DishRemover): JsonResponse
    {
        if ($DishRemover->handle($Dish)) {
            return response()->json([
                'message' => 'Order status removed sucessfully.',
            ]);
        }

        return response()->json([
            'error' => 'An error occurred removing order status.'
        ]);
    }

    public function rate(Request $request, $dishId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5', // Assuming a 1-5 rating scale
        ]);

        $dish = Dish::findOrFail($dishId);
        // Calculate new average rating
        $newCount = $dish->ratings_count + 1;
        $newAverage = (($dish->average_rating * $dish->ratings_count) + $request->rating) / $newCount;

        $dish->update([
            'average_rating' => $newAverage,
            'ratings_count' => $newCount,
        ]);

        return response()->json(['message' => 'Rating submitted successfully', 'dish' => $dish]);
    }
}
