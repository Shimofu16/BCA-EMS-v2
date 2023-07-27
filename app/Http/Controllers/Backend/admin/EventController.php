<?php

namespace App\Http\Controllers\Backend\admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
        return view('BCA.Backend.admin-layouts.manage.events.index', compact('events'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            /* convert end date and start date into carbon */
            $start = $request->input('start');
            $end = $request->input('end');
            $start = \Carbon\Carbon::parse($start);
            $end = \Carbon\Carbon::parse($end);
            /* add one day */
            $start = $start->subDay();
            $end = $end->addDay();

            Event::create([
                'title' => $request->input('title'),
                'start' => $start,
                'end' => $end,
                'time' => $request->input('time'),
                'color' => $request->input('color'),
            ]);

            return redirect()->back()->with('successToast', 'Event created successfully..');
        } catch (\Throwable $th) {
            return redirect()->back()->with('errorAlert', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            /* convert end date and start date into carbon */
            $start = $request->input('start');
            $end = $request->input('end');
            $start = \Carbon\Carbon::parse($start);
            $end = \Carbon\Carbon::parse($end);
            /* add one day */
            $start = $start->addDay();
            $end = $end->addDay();

            $event = Event::find($id);
            $event->update([
                'title' => $request->input('title'),
                'start' => $start,
                'end' => $end,
                'time' => $request->input('time'),
                'color' => $request->input('color'),
                'updated_at' => now(),
            ]);
            return redirect()->back()->with('successToast', 'Event updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('errorAlert', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $event = Event::find($id);
            $event->delete();
            return redirect()->back()->with('successToast', 'Event deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('errorAlert', $th->getMessage());
        }
    }
}

