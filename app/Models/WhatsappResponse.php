<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappResponse extends Model
{
    use HasFactory;

    protected $table = "whatsapp_responses";
    protected $primaryKey = "id";
    protected $keyType = "string";
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        "company_id",
        "name",
        "default",
        "message",
    ];

    protected $casts = [
        "id" => "string",
        "company_id" => "string",
        "name" => "string",
        "default" => "boolean",
        "message" => "string",
        "created_at" => "datetime",
        "updated_at" => "datetime",
    ];

    public function company()
    {
        return $this->belongsTo(Company::class, "company_id", "id");
    }

    // Generate a custom ID when creating a new record
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $total = self::count() + 1;
            $date = date('Ymdis');
            $model->id = "MSG-{$date}-".str_pad($total, 8, '0', STR_PAD_LEFT);
        });
    }
}
