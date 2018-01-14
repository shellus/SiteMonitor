<?php

namespace App\Http\Controllers;

use App\Monitor;
use App\Project;
use App\Service\MonitorService;
use Illuminate\Http\Request;

class MonitorController extends Controller
{
	protected $project;
	public function __construct() {
		$this->middleware(function ($request, $next) {
			$projectId = $request->input('project');
			if ($projectId){
				$this->project = Project::whereUserId(\Auth::id())->findOrFail($projectId);
			}else{
				$this->project = \Auth::User()->defaultProject();
			}
			return $next($request);
		});

	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function index()
    {
    	$projects = \Auth::User()->projects;
	    return view('monitor.index')->with('project', $this->project)->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
	    $projects = \Auth::User()->projects;
        return view('monitor.create')->with('project', $this->project)->with('projects', $projects)->with('monitor', new Monitor());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
	    $expandData = [
		    'project_id' => $this->project->id,
	    ];
    	$commitData = array_merge($request->all(), $expandData);

	    if ($monitorId = $request->input('monitor_id')){
	    	Monitor::findOrFail($monitorId)->update($commitData);
	    }else{
		    MonitorService::createMonitor($commitData);
	    }
        return '修改成功';
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
	    return view('monitor.create')->with('project', $this->project)->with('projects', $projects)->with('monitor', $monitor);
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
