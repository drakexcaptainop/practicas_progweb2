<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    use \Eloquence\Behaviours\CamelCasing;
    protected $fillable = [
        'firstName',
        'lastName',
        'city',
        'address',
        'photo',
        'birthDate',
        'userId'
    ];
}
