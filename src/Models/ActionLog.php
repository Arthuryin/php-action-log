<?php
namespace arthuryinzhen\ActionLog\Models;

use Illuminate\Database\Eloquent\Model;

class ActionLog extends Model
{
    protected $table = "action_log";

    protected $fillable = ['uid', 'username', 'type', 'ip', 'content', 'guard', 'browser', 'system', 'url', 'content'];
}