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
        "id",
        'whatsapp_number_id',
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
        'whatsapp_number_id' => 'string',
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
        return $this->belongsTo(WhatsappNumber::class, 'whatsapp_number_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }
}
