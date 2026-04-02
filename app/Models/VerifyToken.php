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
        'application_id',
    ];

    protected $casts = [
        'id' => 'string',
        'company_id' => 'string',
        'application_id' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function metaApp()
    {
        return $this->belongsTo(Application::class);
    }

    // Agregar el id único al crear una nueva instancia
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->id = Str::random(40);
        });
    }
}
