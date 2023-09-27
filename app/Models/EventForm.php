<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EventForm extends Model
{
    use HasFactory;
    
    /**
     * Define database relationships. Each event belongs to one user.
     */
    public function user(): BelongsTo
    {
        return $this -> belongsTo(User::class);
    }
}
