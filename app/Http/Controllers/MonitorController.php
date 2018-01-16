<?php

namespace App\Http\Controllers;

use App\Monitor;
use App\Project;
use App\Service\MonitorService;
use App\User;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function index(Request $request)
    {
        $project = MonitorService::rememberProject(\Auth::user());
        $projects = \Auth::user()->projects;

	    return view('monitor.index')->with('project', $project)->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    $projects = \Auth::User()->projects;
        return view('monitor.create')->with('projects', $projects)->with('monitor', new Monitor());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

	    $projectId = $request->input('project_id');
	    $commitData = array_merge($request->all());

	    $this->validate( $request, [
		    'interval_normal' => 'required|integer|min:30|max:86400',
		    'interval_match'  => 'required|integer|min:30|max:86400',
		    'interval_error'  => 'required|integer|min:30|max:86400',
		    'title'           => 'required|string|min:1|max:255',
		    'request_url'     => 'required|url',
		    'request_method'  => 'required|in:GET,POST,HEAD,PUT,DELETE',
		    'match_type'      => 'required|in:include,http_status_code,timeout',
		    'match_content'   => 'required|string|min:1|max:255',
	    ] );

	    if (!\Auth::user()->projects()->whereId($projectId)->exists()){
		    $message = "项目ID错误，项目不存在，或不属于你";
	    }elseif ($monitorId = $request->input('id')){
	    	Monitor::findOrFail($monitorId)->update($commitData);
		    $message = "修改监控成功";
	    }else{
		    MonitorService::createMonitor($commitData);
		    $message = "新增监控成功";
	    }
	    return redirect()->route('monitor.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function show(Monitor $monitor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function edit(Monitor $monitor)
    {
	    $projects = \Auth::User()->projects;
	    return view('monitor.create')->with('projects', $projects)->with('monitor', $monitor);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Monitor $monitor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Monitor  $monitor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Monitor $monitor)
    {
	    if (MonitorService::deleteMonitor($monitor->id)){
		    $message = '删除监控成功!';
	    }else{
		    $message = '删除监控失败，请检查监控是否存在!';
	    }

	    return redirect()->route('monitor.index')->with('status', $message);
    }
}
