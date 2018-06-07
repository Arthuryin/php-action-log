<?php

namespace arthuryinzhen\ActionLog;

use Illuminate\Support\ServiceProvider;
use ActionLog;

class ActionLogServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish configuration files

        $this->publishes([
            __DIR__.'/migrations' => database_path('migrations'),
        ], 'migrations');


        $this->publishes([
            __DIR__.'/config/action-log.php' => config_path('action-log.php'),
        ], 'config');

        $model = config("action-log.models");
		if($model){
			foreach($model as $k => $v) {
				
			$v::updated(function($data){
					ActionLog::createActionLog('update',"更新的id:".$data->id);
				});
			
			$v::saved(function($data){
				ActionLog::createActionLog('add',"添加的id:".$data->id);
			});
			
			$v::deleted(function($data){
				ActionLog::createActionLog('delete',"删除的id:".$data->id);

			});
			
			}
		}
        

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton("ActionLog",function($app){
            return new \arthuryinzhen\ActionLog\Repositories\ActionLogRepository();
        });
    }
}
