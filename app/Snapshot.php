<?php

namespace App;

use App\Monitor\Match\MatchBase;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Snapshot
 *
 * @property int $id
 * @property int $monitor_id
 * @property int $is_match 匹配中了就为1，至于发不发邮件通知，那是另一回事
 * @property int $is_error 如果有错误，匹配就肯定是false
 * @property string $error_message
 * @property string $http_status_code
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereErrorMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereHttpStatusCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereIsError($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereIsNotice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereMonitorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $time_total
 * @property int $time_dns
 * @property int $time_connection
 * @property int $time_transport
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereTimeConnection($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereTimeDns($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereTimeTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereTimeTransport($value)
 * @property-read \App\Monitor $monitor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereIsMatch($value)
 * @property int $is_done
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereIsDone($value)
 * @property int $is_notice
 * @property int $status_level
 * @property string|null $status_text
 * @property string|null $status_message
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereStatusLevel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereStatusMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereStatusText($value)
 * @property int|null $header_size
 * @property string|null $response_path
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereHeaderSize($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereResponsePath($value)
 */
class Snapshot extends Model
{
    protected $casts = [
        'is_match' => 'boolean',
        'is_error' => 'boolean',
        'is_done' => 'boolean',
        'is_notice' => 'boolean',
    ];

    protected $fillable = ['monitor_id'];

    /**
     * 显示用的、
     * @return mixed
     */
    public function getLabel(){
        $arr = [
            "primary",
            "warning",
            "danger",
        ];
        return $arr[$this->status_level];
    }

    /**
     * 快照所属的监控
     */
    public function monitor()
    {
        return $this->belongsTo('App\Monitor');
    }

    /**
     * 插入数据库记录前调用此方法
     * @param $userId
     * @param $response
     * @return string
     * @throws \Exception
     */
    public function storeSnapshotResponse($userId, $response){
        if (empty($response)){
            return "";
        }

        $date = date('Y-m-d');
        $path = "/$userId/{$this->monitor_id}/$date/{$this->id}.bin";
        if (!\Storage::disk('snapshot')->put($path, $response)){
            throw new \Exception("Put a file $path to storage return false !");
        }
        return $path;
    }

    /**
     * 删除数据库记录前调用这个方法
     * @throws \Exception
     */
    public function deleteResponseFile(){
        if (!empty($this->response_path) && !\Storage::disk('snapshot')->delete($this->response_path)){
            throw new \Exception("Delete a file {$this->response_path} return false !");
        }
    }

    /**
     *
     * @return string
     */
    public function getResponse()
    {
        return \Storage::disk('snapshot')->get($this->response_path);
    }

    /**
     * @return bool|string
     */
    public function getHeaderStr()
    {
        $response = \Storage::disk('snapshot')->get($this->response_path);
        return substr($response, 0, $this->header_size);
    }

    /**
     * @return bool|string
     */
    public function getBody()
    {
        $response = \Storage::disk('snapshot')->get($this->response_path);
        return substr($response, $this->header_size);
    }

	/**
	 * @return MatchBase
	 * @throws \Exception
	 */
	public function getMatcher(){
		$matchClass = "\\App\\Monitor\\Match\\".Str::ucfirst( Str::camel( $this->monitor->match_type."_match" ) );
		if ( ! class_exists( $matchClass ) ) {
			throw new \Exception( "monitor match_type[{$matchClass}] not found!" );
		}
		return new $matchClass($this);
	}
}
