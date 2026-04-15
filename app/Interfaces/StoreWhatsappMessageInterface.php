<?php

namespace App\Interfaces;

use App\Models\WhatsappMessage;
use Illuminate\Http\Request;

interface StoreWhatsappMessageInterface
{
    public static function store(Request $data, string $companyId): WhatsappMessage;
}
