<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\MonitorData
 *
 * @property int $monitor_id
 * @property string|null $last_1hour_table_cache
 * @property int $last_error
 * @property int $last_match
 * @property string|null $last_error_time
 * @property string|null $last_match_time
 * @property string|null $last_request_time
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
 * @property string|null $status_text
 * @method static \Illuminate\Database\Eloquent\Builder|\App\MonitorData whereStatusText($value)
 */
class MonitorData extends Model
{
	protected $dates = ['created_at', 'updated_at', 'last_match_time', 'last_error_time', 'last_request_time'];
	protected $primaryKey = 'monitor_id';
    //
}
