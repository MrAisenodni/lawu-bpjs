<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Create Provider Table
        if (env('DB_CONNECTION') == 'mysql')
        {
            Schema::create('stg_provider', function (Blueprint $table) {
                $table->id();
    
                // Main Profile
                $table->string('type', 100)->nullable();
                $table->string('code', 100)->nullable();
                $table->string('shape')->nullable();
                $table->string('name')->nullable();
                $table->string('phone')->nullable();
                $table->string('email')->nullable();
                $table->string('web')->nullable();
    
                // Address
                $table->string('country', 50)->nullable();
                $table->bigInteger('province_id')->nullable();
                $table->string('province', 50)->nullable();
                $table->bigInteger('city_id')->nullable();
                $table->string('city', 50)->nullable();
                $table->bigInteger('district_id')->nullable();
                $table->string('district', 50)->nullable();
                $table->bigInteger('sub_district_id')->nullable();
                $table->string('sub_district', 50)->nullable();
                $table->string('post_code', 10)->nullable();
                $table->string('longitude')->nullable();
                $table->string('latitude')->nullable();
                $table->string('address_1')->nullable();
                $table->string('address_2', 3)->nullable();
                $table->string('address_3', 3)->nullable();
    
                // Access BPJS
                $table->string('cons_id')->unique();
                $table->string('cons_secret')->unique();
                $table->string('user_key')->unique();
                $table->string('token')->unique();
                $table->string('username')->unique();
                $table->string('password')->unique();
    
                // Standard Structure
                $table->boolean('disabled')->default(0);
                $table->dateTime('created_at');
                $table->string('created_by')->nullable();
                $table->dateTime('updated_at')->nullable();
                $table->string('updated_by')->nullable();
                $table->dateTime('deleted_at')->nullable();
                $table->string('deleted_by')->nullable();
            });
        }
        if (env('DB_CONNECTION') == 'sqlsrv')
        {
            Schema::create('bpjs.stg_provider', function (Blueprint $table) {
                $table->id();
    
                // Main Profile
                $table->string('type', 100)->nullable();
                $table->string('code', 100)->nullable();
                $table->string('shape')->nullable();
                $table->string('name')->nullable();
                $table->string('phone')->nullable();
                $table->string('email')->nullable();
                $table->string('web')->nullable();
    
                // Address
                $table->string('country', 50)->nullable();
                $table->bigInteger('province_id')->nullable();
                $table->string('province', 50)->nullable();
                $table->bigInteger('city_id')->nullable();
                $table->string('city', 50)->nullable();
                $table->bigInteger('district_id')->nullable();
                $table->string('district', 50)->nullable();
                $table->bigInteger('sub_district_id')->nullable();
                $table->string('sub_district', 50)->nullable();
                $table->string('post_code', 10)->nullable();
                $table->string('longitude')->nullable();
                $table->string('latitude')->nullable();
                $table->string('address_1')->nullable();
                $table->string('address_2', 3)->nullable();
                $table->string('address_3', 3)->nullable();
    
                // Access BPJS
                $table->string('cons_id')->unique();
                $table->string('cons_secret')->unique();
                $table->string('user_key')->unique();
                $table->string('token')->unique();
                $table->string('username')->unique();
                $table->string('password')->unique();
    
                // Standard Structure
                $table->boolean('disabled')->default(0);
                $table->dateTime('created_at');
                $table->string('created_by')->nullable();
                $table->dateTime('updated_at')->nullable();
                $table->string('updated_by')->nullable();
                $table->dateTime('deleted_at')->nullable();
                $table->string('deleted_by')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (env('DB_CONNECTION') == 'mysql') Schema::dropIfExists('stg_provider');
        if (env('DB_CONNECTION') == 'sqlsrv') Schema::dropIfExists('bpjs.stg_provider');
    }
}
