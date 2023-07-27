<?php

namespace App\Http\Controllers\Backend\cashier;

use App\Http\Controllers\Controller;
use App\Models\GradeLevel;
use App\Models\Payment;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class ConfirmedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index($level = null)
    {
        $currentSy = SchoolYear::where('is_active', '=', 1)->first();
        if ($level != null) {
            $payments = Payment::with('sy')
                ->where('sy_id', '=', $currentSy->id)
                ->where('status', '=', 1)
                ->where('grade_level_id', '=', $level)
                ->get();
        } else {
            $payments = Payment::with('sy')
                ->where('sy_id', '=', $currentSy->id)
                ->where('status', '=', 1)
                ->get();
        }
        $gradeLevels = GradeLevel::all();
        return view('BCA.Backend.cashier-layouts.payments.confirmed.index', compact('payments', 'gradeLevels'));
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
