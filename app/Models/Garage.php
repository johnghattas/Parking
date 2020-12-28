<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{

    protected $fillable = [
        'id', 'city', 'street', 'b_number', 'capacity', 'name', 'owner_id'
    ];

    /**
 * The attributes that should be cast.
 *
 * @var array
 */
protected $casts = [
    'created_at' => 'datetime:Y-m-d',
    'updated_at' => 'datetime:Y-m-d',
];
}
