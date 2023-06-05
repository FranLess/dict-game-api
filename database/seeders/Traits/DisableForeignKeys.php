<?php

namespace Database\Seeders\Traits;

use Illuminate\Support\Facades\DB;

trait DisableForeignKeys
{
    protected function disableForeignKeys()
    {
        $db = app()->make('db');
        $db->getSchemaBuilder()->disableForeignKeyConstraints();
        // DB::statement('SET FOREIGN_KEY_CHECKS=0');
    }
    protected function enableForeignKeys()
    {
        $db = app()->make('db');
        $db->getSchemaBuilder()->enableForeignKeyConstraints();
        // DB::statement('SET FOREIGN_KEY_CHECKS=1');
    }
}
