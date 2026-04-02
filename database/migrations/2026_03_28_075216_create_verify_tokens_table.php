<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Esta tabla almacena los tokens de verificación para los números de WhatsApp asociados a las empresas. 
     * Cada token es único y se utiliza para verificar la propiedad del número de WhatsApp antes de permitir su uso en la plataforma. 
     * La tabla incluye referencias a la empresa y a la aplicación de Meta, así como marcas de tiempo para el seguimiento de su creación y actualización.
     */
    public function up(): void
    {
        Schema::create('verify_tokens', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('company_id');
            $table->string('application_id');
            $table->timestamps();

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade')
                ->onUpdate('cascade');
                
            $table->foreign('application_id')
                ->references('id')
                ->on('applications')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verify_tokens');
    }
};
