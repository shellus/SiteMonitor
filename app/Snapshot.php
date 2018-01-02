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
 */
class Snapshot extends Model
{
    //
}
