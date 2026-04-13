<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InputData extends Model
{
    use HasFactory;

    protected $table = 'input_data';

    protected $fillable = [
        'company_id',
        'data',
    ];

    protected $casts = [
        'company_id' => 'string',
        'data' => 'array',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}
