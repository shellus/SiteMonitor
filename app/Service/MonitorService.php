<?php
/**
 * Created by PhpStorm.
 * User: shellus
 * Date: 2018/1/3
 * Time: 16:46
 */

namespace App\Service;


use App\Monitor;
use App\Snapshot;

class MonitorService
{

    static public function runMonitor()
    {
        $jobs = Monitor::all();
        foreach ($jobs as $job) {
            self::joinQueue($job);
        }
        return true;
    }
    /**
     * 讲一个监控任务加入列队，会自动设置
     * @param Monitor $monitor
     * @return void
     */
    static public function joinQueue(Monitor $monitor)
    {

    }

    /**
     * 执行一个监控，返回一个监控快照
     * @param Monitor $monitor
     * @return Snapshot
     */
    static public function request(Monitor $monitor)
    {
        $curlHandle = curl_init();

        curl_setopt($curlHandle, CURLOPT_FORBID_REUSE, true); // 不重用TCP连接
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, true); // 返回数据，不输出
        curl_setopt($curlHandle, CURLOPT_HEADER, true); // 输出header
        curl_setopt($curlHandle, CURLOPT_FOLLOWLOCATION, true); // 跟随跳转
        curl_setopt($curlHandle, CURLOPT_MAXREDIRS, 5); // 跳转次数



        curl_setopt($curlHandle, CURLOPT_URL, $monitor->request_url);
        curl_setopt($curlHandle, CURLOPT_CUSTOMREQUEST, $monitor->request_method);
        if ($monitor->request_method != "GET") {
            curl_setopt($curlHandle, CURLOPT_POSTFIELDS, $monitor->request_body);
        }
        // CURLOPT_AUTOREFERER 重定向时，自动设置 header 中的Referer:信息。
        // CURLOPT_CONNECT_ONLY 仅连接

        if ("timeout" == $monitor->match_type) {
            curl_setopt($curlHandle, CURLOPT_TIMEOUT_MS, $monitor->match_content);
        }

        $response = curl_exec($curlHandle);


        $curlInfo = curl_getinfo($curlHandle);


        $snapshot = new Snapshot();
        $snapshot->monitor_id = $monitor->id;
        $curlErrorNo = curl_errno($curlHandle);
        $curlErrorMessage = curl_error($curlHandle);


        curl_close($curlHandle);


        $snapshot->http_status_code = $curlInfo['http_code'];

        $headerSize = $curlInfo['header_size'];
        $headers = substr($response, 0, $headerSize);
        $body = substr($response, $headerSize);


        $snapshot->headers = $headers;
        $snapshot->body_content = $body;

        $snapshot->time_total = $curlInfo['total_time'];
        $snapshot->time_dns = $curlInfo['namelookup_time'];
        $snapshot->time_connection = $curlInfo['connect_time'];
        $snapshot->time_transport = 0;

        if ($curlErrorNo !== 0) {
            $snapshot->is_error = true;
        }
        $snapshot->error_message = "curl error[$curlErrorNo]: " . $curlErrorMessage;

        if ($snapshot->is_error) {
            $snapshot->is_notice = true;
        }

        $snapshot->buildFull();
        $snapshot->saveOrFail();

        return $snapshot;
    }


}