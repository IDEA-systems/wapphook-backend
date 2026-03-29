<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsappMessage extends Model
{
    protected $table = 'whatsapp_messages';
    protected $primaryKey = 'id';
    public $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'chat_id',
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
        'status'
    ];

    protected $casts = [
        'audio' => 'array',
        'contacts' => 'array',
        'document' => 'array',
        'image' => 'array',
        'location' => 'array',
        'text' => 'array',
        'video' => 'array',
        'error' => 'array'
    ];

    public function chat()
    {
        return $this->belongsTo(WhatsappChat::class, 'chat_id', 'id');
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
