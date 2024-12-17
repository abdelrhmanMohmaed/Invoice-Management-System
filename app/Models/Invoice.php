<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'created_by',
        'customer_id',
        'invoice_number',
        'amount',
        'date',
        'description',
        'currency',
        'payment_status',
    ];

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class,'created_by','id');
    }
    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
