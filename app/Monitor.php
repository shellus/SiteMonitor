<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
 */
class Monitor extends Model
{
    static public function generateTitle(){
        return "M-" . str_pad(self::count(), 5, '0', STR_PAD_LEFT);
    }
    static public function parseMatchMessage($type, $reverse){
        switch ($type){
            case "include":
                $statusText = "包含文本";
                break;
            case "http_status_code":
                $statusText = "HTTP状态码";
                break;
            case "timeout":
                $statusText = "请求超时";
                break;
            default:
                throw new \Exception("Match Message type[{$type}] not found!");
                break;
        }
        if ($reverse){
            $statusText = "[反向]".$statusText;
        }
        return $statusText;
    }
}