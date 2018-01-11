<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\User
 *
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $remember_token
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * 快速增加监控任务
     * @param $url
     * @param $matchType
     * @param $matchContent
     * @param $matchReverse
     * @return Monitor
     */
    public function quickGenerateMonitor($url, $matchType, $matchContent, $matchReverse)
    {
        $monitor = new Monitor();
        $monitor->user_id = $this->id;
        $monitor->title = Monitor::generateTitle();
        $monitor->request_url = $url;
        $monitor->request_method = "GET";
        $monitor->request_headers = "";
        $monitor->request_body = "";

        $monitor->is_enable = true;
        $monitor->request_nobody = true;
        $monitor->interval_normal = 60 * 5;
        $monitor->interval_match = 60 * 5;
        $monitor->interval_error = 30;

        $monitor->match_reverse = $matchReverse;
        $monitor->match_type = $matchType;
        $monitor->match_content = $matchContent;

        $monitor->saveOrFail();
        return $monitor;
    }

}
