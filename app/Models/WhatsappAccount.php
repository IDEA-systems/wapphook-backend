<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappAccount extends Model
{
    use HasFactory;
    
    protected $table = 'whatsapp_accounts';
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'company_id',
        'application_id',
        'name',
    ];

    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
        'id' => 'string',
        'company_id' => 'string',
        'application_id' => 'string',
        'name' => 'string',
    ];

    /**
     * Get the company that owns the WhatsApp account.
     */
    public function companyData()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    /**
     * Get the Application associated with the WhatsApp account.
     */
    public function applicationData()
    {
        return $this->belongsTo(Application::class, 'application_id', 'id');
    }

    /**
    * Get the WhatsApp numbers associated with the WhatsApp account.
    */
    public function whatsappNumbers()
    {
        return $this->hasMany(WhatsappNumber::class, 'whatsapp_account_id', 'id');
    }
}
