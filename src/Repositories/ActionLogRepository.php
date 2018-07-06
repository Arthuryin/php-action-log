<?php
namespace arthuryinzhen\ActionLog\Repositories;

use arthuryinzhen\ActionLog\Services\clientService;

class ActionLogRepository {


    /**
     * 记录用户操作日志
     * @param $type
     * @param $content
     * @return bool
     */
    public function createActionLog($type,$content)
    {
    	$actionLog = new \arthuryinzhen\ActionLog\Models\ActionLog();

		$actionLog->uid = 0;
		$actionLog->username = "访客";
		$actionLog->guard = '访客';

		foreach (config('action-log.guards') as $guard) {
			if (auth()->guard($guard)->check()) {
				$actionLog->uid = auth()->guard($guard)->user()->id;
				$actionLog->username = auth()->guard($guard)->user()->name;
				$actionLog->guard = $guard;
				break;
			}
		}

       	$actionLog->url = request()->getRequestUri();
        $actionLog->ip = request()->getClientIp();
        $actionLog->type = $type;
        $actionLog->content = $content;
        $res = $actionLog->save();

        return $res;
    }
}