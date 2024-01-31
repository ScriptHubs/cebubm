<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;

    protected $table = 'table_tickets'; // Specify the actual table name in the database

    protected $fillable = [
        'event_id',
        'ticket_names',
        'ticket_prices',
        'payment_links',
        'member_types',
    ];
}
