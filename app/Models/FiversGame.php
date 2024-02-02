<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FiversGame extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'fivers_games';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fivers_provider_id',
        'casino_category_id',
        'game_code',
        'game_name',
        'banner',
        'status',
        'views',
    ];


    /**
     * @return BelongsTo
     */
    public function provider(): BelongsTo
    {
        return $this->belongsTo(FiversProvider::class, 'fivers_provider_id', 'id');
    }


    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'casino_category_id', 'id');
    }
}
