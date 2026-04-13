<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;
    
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'company_id',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected $casts = [
        'id' => 'string',
        'company_id' => 'string',
        'name' => 'string',
        'email' => 'string',
        'email_verified_at' => 'datetime',
        'password' => 'string',
        'remember_token' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define the relationship with the Company model
    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    // Método para verificar la contraseña de la empresa
    public function checkPassword($password)
    {
        return Hash::check($password, $this->password);
    }

    // Autohash de la contraseña al asignarla
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    // Generar id único para cada usuario al crear una nueva instancia
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $total = self::count() + 1;
            $date = date('Ymdis');
            $user->id = "USR-{$date}-".str_pad($total, 8, '0', STR_PAD_LEFT);
        });
    }
}
