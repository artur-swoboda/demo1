<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{

    use HasFactory;

    protected $table = 'slots';

    protected $fillable = [
        'date',
        'time',
        'is_available',
    ];

    protected function casts(): array
    {
        return [
            'date' => 'date:m/d/Y',
        ];
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
