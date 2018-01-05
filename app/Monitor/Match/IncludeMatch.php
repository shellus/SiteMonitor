<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2018-01-05
 * Time: 21:39
 */

namespace App\Monitor\Match;

use App\Snapshot;

/**
 * 网页包含内容匹配器
 * Class IncludeMatch
 * @package Monitor\Match
 */
class IncludeMatch extends MatchBase {
	protected $snapshot;

	public function __construct( Snapshot $snapshot ) {
		$this->snapshot = $snapshot;
		$this->isMatch  = strpos( $this->snapshot->body_content, $this->snapshot->monitor->match_content ) !== false;
	}

	public function getMessage() {
		$text = "网页中";
		if ( $this->snapshot->monitor->match_reverse ) {
			$text = $text . "不包含";
		} else {
			$text = $text . "包含";
		}
		$text = $text . "[{$this->snapshot->monitor->match_content}]";

		return $text;
	}
}