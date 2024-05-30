<?php

namespace App\Models;

use App\Contracts\Usage;
// use App\Traits\HasTransaction;
// use App\Traits\HasUsage;
// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
//  implements Usage
class Dish extends Model
{
    // use HasFactory, HasTransaction, HasUsage;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'name',
        'description',
        'image',
        'price',
        'average_rating',
        'ratings_count'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'average_rating' => 'float',
        'ratings_count' => 'integer'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
