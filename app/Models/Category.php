<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'slug'
    ];

    /**
     * Games Slotegrator
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gamesSlotgrator() : HasMany
    {
        return $this->hasMany(Game::class);
    }

    /**
     * Games Slotegrator
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gamesSalsa() : HasMany
    {
        return $this->hasMany(CasinoGamesSalsa::class);
    }

    /**
     * Games Slotegrator
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function gamesFivers() : HasMany
    {
        return $this->hasMany(CasinoGamesSalsa::class);
    }
}
