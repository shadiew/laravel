<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_code',
        'provider_order_id',
        'service_id',
        'quantity',
        'link',
        'username',
        'start_count',
        'remains',
        'price',
        'refill',
        'refund',
        'status',
        'note',
        'note_check',
        'created_by',
    ];

    /**
     * Get the service that owns the order.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
    /**
     * Get the user that owns the order.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
