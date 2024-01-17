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

    /**
     * Mass assignment protection. Specify which fields are fillable
     */
    protected $fillable = [
        'event_title',
        'start_date',
        'start_time',
        'end_date',
        'end_time',
        'description',
        'location',
        'google_calendar_id', //add this line
    ];
    
}
