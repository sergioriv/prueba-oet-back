<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    protected $fillable = [
        'license_plate',
        'color',
        'make',
        'is_private',
        'driver_id',
        'owner_id'
    ];
    protected $casts = ['is_private' => 'int'];
    protected $appends = ['type'];

    public function getTypeAttribute() { return $this->is_private ? 'particular' : 'público';  }

    public function driver() { return $this->belongsTo(Driver::class); }
    public function owner() { return $this->belongsTo(Owner::class); }

}
