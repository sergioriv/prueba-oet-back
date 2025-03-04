<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;
    protected $fillable = [
        'document',
        'first_name',
        'second_name',
        'last_names',
        'address',
        'city',
        'phone'
    ];
    protected $appends = ['full_name'];

    public function getFullNameAttribute() { return "{$this->first_name} {$this->second_name} {$this->last_names}"; }
}
