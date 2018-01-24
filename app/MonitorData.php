<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * 监控的热数据，用来冷热垂直分表
 * App\MonitorData
 *
 * @property int $monitor_id
 * @property string|null $last_1hour_table_cache
 * @property int $last_error
 * @property int $last_match
 * @property Carbon|null $last_error_time
 * @property Carbon|null $last_match_time
 * @property Carbon|null $last_request_time
 * @property int $time_total_average_15minute
 * @property int $time_total_average_30minute
 * @property int $time_total_average_1hour
 * @property int $time_total_average_12hour
 * @property int $time_total_average_24hour
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MonitorData whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MonitorData whereLast1hourTableCache($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MonitorData whereLastError($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MonitorData whereLastErrorTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MonitorData whereLastMatch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MonitorData whereLastMatchTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MonitorData whereLastRequestTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MonitorData whereMonitorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MonitorData whereTimeTotalAverage12hour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MonitorData whereTimeTotalAverage15minute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MonitorData whereTimeTotalAverage1hour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MonitorData whereTimeTotalAverage24hour($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MonitorData whereTimeTotalAverage30minute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MonitorData whereUpdatedAt($value)
 * @mixin \Eloquent
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MonitorData whereStatusText($value)
 * @property string|null $status_text
 * @property int $last_status_level
 * @property string|null $last_status_text
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MonitorData whereLastStatusLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MonitorData whereLastStatusText($value)
 */
class MonitorData extends Model
{
	protected $dates = ['created_at', 'updated_at', 'last_match_time', 'last_error_time', 'last_request_time'];
	protected $primaryKey = 'monitor_id';
    //
    public function lastStatusLevelLabel(){
        $arr = [
            "primary",
            "warning",
            "danger",
        ];
        return $arr[$this->last_status_level];
    }
}
