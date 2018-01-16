<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2018/1/16
 * Time: 16:28
 */

namespace App\Service;


use App\Snapshot;

class SnapshotService
{
    /**
     * @param $snapshotId
     * @return boolean
     */
    static public function deleteSnapshot($snapshotId){
        return Snapshot::findOrFail($snapshotId)->delete();
    }
}