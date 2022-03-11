<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppRepositoryProvider extends ServiceProvider
{

    public function boot()
    {
    }

    public function register()
    {
        $models = array(
            'Example',
        );

        foreach ($models as $model) {
            $this->app->bind(
                "App\\Repositories\\$model\\I{$model}Repository",
                "App\\Repositories\\$model\\{$model}Repository"
            );
        }
    }
}
