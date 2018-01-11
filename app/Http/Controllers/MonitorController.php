<?php

namespace App\Http\Controllers;

use App\Monitor;
use Illuminate\Http\Request;

class MonitorController extends Controller
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
        return view('monitor.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $monitor = new Monitor();
        $monitor->user_id = $request->user()->id;
        $monitor->title = $request->input('title', Monitor::generateTitle());
        $monitor->request_url = $request->input('url');
        $monitor->request_method = $request->input('method', 'GET');
        $monitor->request_headers = $request->input('header', '');;
        $monitor->request_body = $request->input('body', '');;

        $monitor->is_enable = true;
        $monitor->request_nobody = true;

        $monitor->interval_normal = $request->input('interval_normal', 60*5);
        $monitor->interval_match = $monitor->interval_normal;
        $monitor->interval_error = 10;

        $monitor->match_reverse = $request->input('match_reverse');
        $monitor->match_type = $request->input('match_type');
        $monitor->match_content = $request->input('match_content');

        $monitor->saveOrFail();

        return '1';
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
        //
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
        //
    }
}
