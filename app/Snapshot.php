<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Snapshot
 *
 * @property int $id
 * @property int $monitor_id
 * @property int $is_notice
 * @property int $is_error
 * @property string $error_message
 * @property string $http_status_code
 * @property string $headers
 * @property string $body_content
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereBodyContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereErrorMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Snapshot whereHeaders($value)
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
 */
class Snapshot extends Model
{
    //
    public function buildFull(){
        is_null($this->http_status_code) && $this->http_status_code=0;
        is_null($this->headers) && $this->headers="";
        is_null($this->body_content) && $this->body_content="";
        is_null($this->time_total) && $this->time_total=0;
        is_null($this->time_connection) && $this->time_connection=0;
        is_null($this->time_dns) && $this->time_dns=0;
        is_null($this->time_transport) && $this->time_transport=0;

    }
}
