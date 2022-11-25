<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'provider_service_id',
        'name',
        'type',
        'category_id',
        'provider_service_price',
        'price',
        'min',
        'max',
        'note',
        'refill',
        'dripfeed',
        'provider_id',
        'active',
        'created_by',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'provider_service_price',
    ];

    /**
     * Get the Payment Method associated with the deposit.
     */
    public function category()
    {
        return $this->belongsTo(ServiceCategory::class, 'category_id');
    }
}
