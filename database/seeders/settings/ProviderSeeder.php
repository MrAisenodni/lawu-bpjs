<?php

namespace Database\Seeders\Settings;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class ProviderSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/csv/settings/Provider.csv';
        if (env('DB_CONNECTION') == 'sqlsrv') $this->tablename = 'bpjs.stg_provider';
        if (env('DB_CONNECTION') == 'mysql') $this->tablename = 'stg_provider';
        $this->defaults = [
            'created_by'    => 'Migrasi',
        ];
        $this->mapping = [
            'id', 'name', 'phone', 'email', 'web', 'cons_id', 'cons_secret', 'user_key', 'token', 'username', 
            'password', 'disabled'
        ];
        $this->header = false;
    }

    public function run()
    {
        if (env('DB_CONNECTION') == 'sqlsrv') DB::unprepared('SET IDENTITY_INSERT bpjs.stg_provider ON');
        parent::run();
        if (env('DB_CONNECTION') == 'sqlsrv') DB::unprepared('SET IDENTITY_INSERT bpjs.stg_provider OFF');
    }
}
