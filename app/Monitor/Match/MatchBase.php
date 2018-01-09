<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2018-01-05
 * Time: 21:43
 */

namespace App\Monitor\Match;


use App\Snapshot;

class MatchBase
{
    /** @var  $isMatch boolean 不包含反向检测 */
    protected $isMatch;
    /** @var  Snapshot */
    protected $snapshot;

    /**
     * @throws \Exception
     * @return string
     */
    public function getMessage()
    {
        throw new \Exception();
    }

    public function isMatch()
    {
        return $this->checkReverse();
    }

    /**
     * 检查反向，会修改类成员值。
     */
    protected function checkReverse()
    {
        if ($this->snapshot->monitor->match_reverse) {
            return !$this->isMatch;
        }
        return $this->isMatch;
    }
}