<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappMessage extends Model
{
    use HasFactory;
    
    protected $table = 'whatsapp_messages';
    protected $primaryKey = 'id';
    public $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'company_id',
        'whatsapp_chat_id',
        'type',
        'badge',
        'audio',
        'contacts',
        'document',
        'image',
        'location',
        'text',
        'video',
        'error',
        'messages',
        'status',
        'sent_by'
    ];

    protected $casts = [
        'id' => 'string',
        'company_id' => 'string',
        'whatsapp_chat_id' => 'string',
        'type' => 'string',
        'badge' => 'string',
        'audio' => 'string',
        'contacts' => 'string',
        'document' => 'string',
        'image' => 'string',
        'location' => 'string',
        'text' => 'string',
        'video' => 'string',
        'error' => 'string',
        'messages' => 'array',
        'status' => 'string',
        'sent_by' => 'string'
    ];

    public function companyData()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function chatData()
    {
        return $this->belongsTo(WhatsappChat::class, 'whatsapp_chat_id', 'id');
    }

    public function senderData()
    {
        return $this->belongsTo(User::class, 'sent_by', 'id');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($whatsappMessage) {
            $total = self::count() + 1;
            $date = date('Ymdis');
            $whatsappMessage->id = "MSG-{$date}-".str_pad($total, 8, '0', STR_PAD_LEFT);
        });
    }
}
