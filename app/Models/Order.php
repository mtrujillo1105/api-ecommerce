<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

       protected $fillable = [
        'user_id',
        'total',
        'status',
        'delivery_name',
        'delivery_address',
        'delivery_city',
        'delivery_phone',
    ];

    protected $casts = [
        'total' => 'decimal:2',
    ];

    // Relaciones
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    // Scopes
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    // Accessors
    public function getStatusTextAttribute()
    {
        $statuses = [
            'pending' => 'Pendiente',
            'processing' => 'Procesando',
            'shipped' => 'Enviado',
            'delivered' => 'Entregado',
            'cancelled' => 'Cancelado',
        ];

        return $statuses[$this->status] ?? $this->status;
    }

    public function getTotalItemsAttribute()
    {
        return $this->items->sum('quantity');
    }
    
}
