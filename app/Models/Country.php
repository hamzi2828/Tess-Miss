<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    // Define the table name (if it's not the plural of the model name)
    protected $table = 'countries';

    // Specify the fillable attributes for mass assignment
    protected $fillable = [
        'country_code', 
        'country_name', 
        'country_status'
    ];

    // You can define relationships here if needed, for example, if a country has states, users, etc.
    // public function states() {
    //     return $this->hasMany(State::class);
    // }
}
