<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappChat extends Model
{
    use HasFactory;
    protected $table = 'whatsapp_chats';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'number_id',
        'company_id',
        'from',
        'contact_name',
        'user_name',
        'last_message',
        'unread_messages',
        'status',
    ];

    protected $casts = [
        'id' => 'string',
        'number_id' => 'string',
        'company_id' => 'string',
        'from' => 'string',
        'contact_name' => 'string',
        'user_name' => 'string',
        'last_message' => 'string',
        'unread_messages' => 'integer',
        'status' => 'string',
    ];

    public function number()
    {
        return $this->belongsTo(WhatsappNumber::class, 'number_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    // Crear un id único para cada chat al crear una nueva instancia
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $total = self::count() + 1;
            $date = date('Ymdis');
            $model->id = "CHAT-{$date}-". str_pad($total, 8, '0', STR_PAD_LEFT);
        });
    }
}
