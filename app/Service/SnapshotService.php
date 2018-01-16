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
     * @return bool
     * @throws \Exception
     */
    static public function deleteSnapshot($snapshotId){
        /** @var Snapshot $snapshot */
        $snapshot = Snapshot::findOrFail($snapshotId);
        $snapshot->deleteResponseFile();
        return $snapshot->delete();
    }

    /**
     * @param array $attributes
     * @return Snapshot
     */
    static public function createSnapshot(array $attributes = []){
        return Snapshot::create($attributes);
    }
    /**
     * 按监控批量删除快照
     * @param $userId
     * @param $monitorId
     * @return bool|mixed|null
     * @throws \Exception
     */
    static public function deleteSnapshotByMonitorId($userId, $monitorId){
        $path = "/$userId/$monitorId/";
        if (!\Storage::disk('snapshot')->deleteDirectory($path)){
            throw new \Exception("Delete snapshot by monitor id dir {$path} return false !");
        }
        return Snapshot::whereMonitorId($monitorId)->delete();
    }
}