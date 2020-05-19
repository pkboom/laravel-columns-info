<?php

namespace Pkboom\ColumnsInfo;

use Illuminate\Support\ServiceProvider;
use Pkboom\ColumnsInfo\Commands\ShowColumnsCommand;

class ColumnsInfoServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ShowColumnsCommand::class,
            ]);
        }
    }
}
