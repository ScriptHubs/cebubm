<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    use HasFactory;
    protected $table = 'table_events';

    protected $fillable = [
        'event_name',
        'event_description',
        'event_date_from',
        'event_date_to',
        'active',
        'poster'
    ];
}
 	