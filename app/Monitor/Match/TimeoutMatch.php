<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2018-01-05
 * Time: 21:26
 */

namespace App\Monitor\Match;


use App\Snapshot;

/**
 * 超时匹配器
 * Class TimeOutMatch
 * @package Monitor\Match
 */
class TimeoutMatch extends MatchBase
{

    protected $snapshot;

    public function __construct(Snapshot $snapshot)
    {
        $this->snapshot = $snapshot;
        $this->isMatch = $this->snapshot->time_total > $this->snapshot->monitor->match_content;
    }

    public function getMessage()
    {
        $text = "访问时间";
        if ($this->snapshot->monitor->match_reverse) {
            $text = $text . "快于";
        } else {
            $text = $text . "慢于";
        }
        $text = $text . $this->snapshot->monitor->match_content . "毫秒";

        return $text;
    }
}