<?php

namespace Pkboom\ColumnsInfo\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ShowColumnsCommand extends Command
{
    protected $signature = 'db-columns:show {table}';

    public function handle()
    {
        $table = $this->argument('table');

        $columns = DB::connection()->getSchemaBuilder()->getColumnListing($table);

        $columns = collect($columns)->map(function ($column) use ($table) {
            $doctrineColumn = DB::connection()->getDoctrineColumn($table, $column);

            return [
                $doctrineColumn->getName(),
                $doctrineColumn->getType()->getName(),
                $doctrineColumn->getDefault(),
                $doctrineColumn->getNotnull() ? null : 'nullable',
            ];
        });

        $headers = ['Name', 'Type', 'Default', 'Nullable'];

        $this->table($headers, $columns);
    }
}
