<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;

      protected $fillable = [
        'user_id',
        'address',
        'city',
        'phone',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    // Relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Event para asegurar que solo una dirección sea la predeterminada
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($address) {
            if ($address->is_default) {
                // Desactivar otras direcciones predeterminadas del mismo usuario
                static::where('user_id', $address->user_id)
                    ->where('id', '!=', $address->id)
                    ->update(['is_default' => false]);
            }
        });
    }
    
}
