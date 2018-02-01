<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * App\Monitor
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $request_url
 * @property string $request_method
 * @property string $request_headers
 * @property string $request_body
 * @property int $request_nobody
 * @property bool $is_enable
 * @property int $interval_normal
 * @property int $interval_match
 * @property int $interval_error
 * @property string $match_type
 * @property int $match_reverse
 * @property string $match_content
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @property-read \App\MonitorData $data
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Snapshot[] $snapshots
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereIntervalError($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereIntervalMatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereIntervalNormal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereIsEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereMatchContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereMatchReverse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereMatchType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereRequestBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereRequestHeaders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereRequestMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereRequestNobody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereRequestUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereUserId($value)
 * @mixin \Eloquent
 * @property int $project_id
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereProjectId($value)
 * @property-read \App\Project $project
 * @property int $request_follow_location
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereRequestFollowLocation($value)
 * @property bool $is_public
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $watchUsers
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereIsPublic($value)
 */
class Monitor extends Model
{
    protected $casts = [
        'is_public' => 'boolean',
        'is_enable' => 'boolean',
        'request_nobody' => 'boolean',
        'match_reverse' => 'boolean',
        'request_follow_location' => 'boolean',
        'no_notice_error' => 'boolean',
        'no_notice_match' => 'boolean',
    ];
    protected $fillable = ['project_id',
        'title',
        'request_url',
        'request_method',
        'request_headers',
        'request_body',
        'is_enable',
        'request_nobody',
        'interval_normal',
        'interval_match',
        'interval_error',
        'match_reverse',
        'match_type',
        'match_content',
        'request_follow_location',
        'is_public',
        'no_notice_error',
        'no_notice_match',
        ];

    /**
     * 最后一个快照，如果没有快照，将抛出异常
     * @return Snapshot
     * @throws ModelNotFoundException
     */
    public function lastSnapshot(){
        return $this->snapshots()->orderBy('id', 'desc')->firstOrFail();
    }
	public function project()
	{
		return $this->belongsTo('App\Project');
	}
	/**
	 * @return Snapshot
	 */
    public function snapshots()
    {
        return $this->hasMany('App\Snapshot');
    }
	public function data()
	{
		return $this->hasOne('App\MonitorData');
	}
    static public function generateTitle(){
        return "M-" . str_pad(self::count()+3823, 5, '0', STR_PAD_LEFT);
    }
    public function flotData(){
        $snaps = $this->snapshots()->whereIsDone(1)->orderBy('id', 'desc')->where('created_at', '>', Carbon::now()->subHour(1))->get(['id', 'time_total', 'created_at']);
        $flotData = [];
        for($i=0;$i<count($snaps);$i++){
            $flotData[] = [$snaps[$i]->created_at->getTimestamp(), $snaps[$i]->time_total];
        }
        return $flotData;
    }

    /**
     * 查看关注的用户
     */
    public function watchUsers()
    {
        return $this->belongsToMany('App\User','watch_monitor', 'user_id', 'monitor_id');
    }
}