<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('project.create')->with('project', new Project());
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
		    'user_id' => \Auth::id(),
	    ];
	    $commitData = array_merge($request->all(), $expandData);

	    if ($id = $request->input('id')){
		    Project::findOrFail($id)->update($commitData);
		    $message = '修改项目成功!';
	    }else{
		    Project::create($commitData);
		    $message = '新增项目成功!';
	    }
	    return redirect()->route('monitor.index')->with('status', $message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
	    return view('project.create')->with('project', $project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
	    if ($project->monitors()->count() !== 0){
		    $message = '项目中还有监控项，不能删除!';
	    } elseif ($project->delete()){
		    $message = '删除项目成功!';
	    }else{
		    $message = '删除项目失败，请检查项目是否存在!';
	    }

		return redirect()->route('monitor.index')->with('status', $message);
    }
}
