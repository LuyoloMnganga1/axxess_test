<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice_lines extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice_id',
        'description',
        'date_created',
        'amount'
    ];
}
