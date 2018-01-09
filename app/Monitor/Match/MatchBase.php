<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2018-01-05
 * Time: 21:43
 */

namespace App\Monitor\Match;


class MatchBase
{
    /** @var  $isMatch boolean 不包含反向检测 */
    protected $isMatch;
    protected $matchReverse;

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
        if ($this->matchReverse) {
            return !$this->isMatch;
        }
        return $this->isMatch;
    }
}