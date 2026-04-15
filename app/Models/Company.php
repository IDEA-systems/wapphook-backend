<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    
    protected $table = 'companies';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'email'
    ];

    protected $casts = [
        'id' => 'string',
        'name' => 'string',
        'email' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define the relationship with the User model
    public function users()
    {
        return $this->hasMany(User::class, 'company_id', 'id');
    }

    // Crear un id único para cada empresa al crear una nueva instancia
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $total = self::count() + 1;
            $date = date('Ymdis');
            $model->id = "COMP-{$date}-".str_pad($total, 8, '0', STR_PAD_LEFT);
        });
    }
}
