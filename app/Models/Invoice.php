<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'created_by',
        'invoice_number',
        'customer_name',
        'amount',
        'date',
        'description',
        'currency',
        'payment_status',
    ];

    public function create_by(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
