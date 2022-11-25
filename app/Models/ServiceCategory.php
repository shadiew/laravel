<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'active',
        'provider_id',
        'created_by'
    ];

    /**
     * Get the Deposit that owns by PaymentMethod.
     */
    public function services()
    {
        return $this->hasMany(Service::class);
    }

    /**
     * Get the order for the service.
     */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
