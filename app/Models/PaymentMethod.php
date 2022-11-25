<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;
    /**
     * Get the Deposit that owns by PaymentMethod.
     */
    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }
}
