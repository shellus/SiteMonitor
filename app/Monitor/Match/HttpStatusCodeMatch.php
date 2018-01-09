<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2018-01-05
 * Time: 21:36
 */

namespace App\Monitor\Match;


use App\Snapshot;

/**
 * HTTP状态匹配器
 * Class HttpStatusCodeMatch
 * @package Monitor\Match
 */
class HttpStatusCodeMatch extends MatchBase
{

    protected $snapshot;

    public function __construct(Snapshot $snapshot)
    {
        $this->snapshot = $snapshot;
        $this->isMatch = $this->snapshot->http_status_code == $this->snapshot->monitor->match_content;
    }


    public function getMessage()
    {
        $text = "HTTP状态代码";
        if ($this->snapshot->monitor->match_reverse) {
            $text = $text . "不等于";
        } else {
            $text = $text . "等于";
        }
        $text = $text . $this->snapshot->monitor->match_content;
        return $text;
    }
}