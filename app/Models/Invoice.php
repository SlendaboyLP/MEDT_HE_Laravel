<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    
 
    public $timestamps = true;
    // Optional: Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'invoice';
    
    // Optional: Specify the fillable fields
    protected $fillable = [
        'Name',
        'PriceNet',
        'PriceGross',
        'Vat',
        'UserClearing',
        'ClearingDate',
    ];
}
