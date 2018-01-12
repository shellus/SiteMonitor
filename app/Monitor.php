<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * App\Monitor
 *
 * @mixin \Eloquent
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string $request_url
 * @property string $request_method
 * @property string $request_headers
 * @property int $request_interval_second
 * @property string $match_type
 * @property string $match_content
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereMatchContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereMatchType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereRequestHeaders($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereRequestIntervalSecond($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereRequestMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereRequestUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereUserId($value)
 * @property string $request_body
 * @property int $match_reverse
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereMatchReverse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereRequestBody($value)
 * @property int $request_nobody
 * @property int $is_enable
 * @property int $interval_normal
 * @property int $interval_match
 * @property int $interval_error
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereIntervalError($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereIntervalMatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereIntervalNormal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereIsEnable($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereRequestNobody($value)
 * @property int $last_error
 * @property int $last_match
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Snapshot[] $snapshots
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereLastError($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereLastMatch($value)
 * @property string|null $last_error_time
 * @property string|null $last_match_time
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereLastErrorTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereLastMatchTime($value)
 * @property int|null $time_total_average_15minute
 * @property int|null $time_total_average_30minute
 * @property int|null $time_total_average_1hour
 * @property int|null $time_total_average_12hour
 * @property int|null $time_total_average_24hour
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereTimeTotalAverage12hour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereTimeTotalAverage15minute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereTimeTotalAverage1hour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereTimeTotalAverage24hour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Monitor whereTimeTotalAverage30minute($value)
 */
class Monitor extends Model
{
    protected $dates = ['created_at', 'updated_at', 'last_match_time', 'last_error_time', 'last_request_time'];
    protected $casts = [
        'is_enable' => 'boolean',
    ];
    /**
     * 最后一个快照，如果没有快照，将抛出异常
     * @return Snapshot
     * @throws ModelNotFoundException
     */
    public function lastSnapshot(){
        return $this->snapshots()->orderBy('id', 'desc')->firstOrFail();
    }
    public function snapshots()
    {
        return $this->hasMany('App\Snapshot');
    }
    static public function generateTitle(){
        return "M-" . str_pad(self::count(), 5, '0', STR_PAD_LEFT);
    }
}