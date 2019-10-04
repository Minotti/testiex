<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoricalPrices extends Model
{
    protected $table = 'historical_prices';
    protected $guarded = ['id'];
}
