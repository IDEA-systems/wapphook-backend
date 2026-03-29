<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappNumber extends Model
{
    use HasFactory;
    protected $table = 'whatsapp_numbers';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id',
        'company_id',
        'whatsapp_account_id',
        'name_visible',
        'phone_number',
        'api_key',
        'pin',
    ];

    protected $casts = [
        'id' => 'string',
        'company_id' => 'string',
        'whatsapp_account_id' => 'string',
        'name_visible' => 'string',
        'phone_number' => 'string',
        'api_key' => 'string',
        'pin' => 'string',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function account()
    {
        return $this->belongsTo(WhatsappAccount::class, 'whatsapp_account_id', 'id');
    }

    // El id del numero sera el que whatsapp le asigne, 
    // por lo que no se genera un id único al crear una nueva instancia
}
