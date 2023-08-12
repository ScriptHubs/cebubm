<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guests extends Model
{
    use HasFactory;
    protected $table = 'guests';

    protected $fillable = [
        'name_first',
        'name_last',
        'name_middle',
        'selectedMembership',
        'email_address',
        'company',
        'industry',
        'expectation',
        'reference',
        'reference_text',
        'connect_text',
        'sectorBoxoption',
        'connect',
        'tickets'
    ];
}
