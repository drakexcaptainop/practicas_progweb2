<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    use \Eloquence\Behaviours\CamelCasing;

    protected $fillable = [
        'firstName',
        'lastName',
        'nit',
        'address',
        'birthDate',
        'userId'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'id');
    }
}
