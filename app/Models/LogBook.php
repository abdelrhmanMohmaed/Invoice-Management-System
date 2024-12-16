<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LogBook extends Model
{
    use HasFactory;
    protected $fillable = ['created_by', 'action_taken', 'user_role'];

    public function create_by(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
