<?php

namespace App\Http\Controllers;

use App\Monitor;
use App\Snapshot;
use Illuminate\Http\Request;

class SnapshotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /** @var Monitor $monitor */
        $monitor = Monitor::findOrFail($request->input('monitor_id'));
        $snapshots = $monitor->snapshots()->orderBy('id', 'desc')->paginate(null, ['id', 'created_at', 'is_notice', 'status_level', 'status_text']);

        return view('snapshot.index', ['snapshots' => $snapshots]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Snapshot $snapshot
     * @return \Illuminate\Http\Response
     */
    public function show(Snapshot $snapshot)
    {
        return response()->make($snapshot->getBody(), 200)->header("Content-Security-Policy", "default-src 'none'");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Snapshot $snapshot
     * @return \Illuminate\Http\Response
     */
    public function edit(Snapshot $snapshot)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Snapshot $snapshot
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Snapshot $snapshot)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Snapshot $snapshot
     * @return \Illuminate\Http\Response
     */
    public function destroy(Snapshot $snapshot)
    {
        //
    }
}
