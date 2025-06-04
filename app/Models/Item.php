<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Item extends Model
{
    protected $guarded = ['id'];

    /**
     * Get all of the comments for the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function stockCards(): HasMany
    {
        return $this->hasMany(StockCard::class);
    }
}
