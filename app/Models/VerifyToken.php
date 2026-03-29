<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class VerifyToken extends Model
{
    use HasFactory;
    protected $table = 'verify_tokens';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'company_id',
        'meta_app_id',
    ];

    protected $casts = [
        'id' => 'string',
        'company_id' => 'string',
        'meta_app_id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function metaApp()
    {
        return $this->belongsTo(MetaApp::class);
    }

    // Agregar el id único al crear una nueva instancia
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($verifyToken) {
            $verifyToken->id = Str::random(40);
        });
    }
}
