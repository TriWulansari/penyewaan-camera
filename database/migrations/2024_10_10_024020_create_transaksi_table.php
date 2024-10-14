<?php

use App\Models\Camera;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Camera::class);
            $table->string('nama')->nullable();
            $table->enum('jenis' , ['canon' , 'samsung' , 'sony']);
            $table->string('kapasitas')->nullable();
            $table->string('noponsel')->nullable();
            $table->text('alamat')->nullable();
            $table->string('lama')->nullable();
            $table->date('tgl_pesan')->nullable();
            $table->string('total')->nullable();
            $table->enum('status' , ['WAIT' , 'PROSES' , 'SELESAI'])->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
