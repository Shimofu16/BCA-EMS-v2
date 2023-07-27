<?php

namespace App\Http\Controllers\Backend\cashier;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendingCount = Payment::where('status', '=', 0)->count();
        $confirmedCount = Payment::where('status', '=', 1)->count();
       /*  try {
            $currentSy = SchoolYear::where('is_active', '=', 1)->where('isEnrollment', '=', 1)->where('isCurrentViewByCashier', '=', 1)->firstOrFail();

            $pendingCount = Payment::where('sy_id', '=', $currentSy->id)->where('status', '=', 0)->count();
            $confirmedCount = Payment::where('sy_id', '=', $currentSy->id)->where('status', '=', 1)->count();
        } catch (\Throwable $th) {
            $currentSy = SchoolYear::where('isCurrentViewByCashier', '=', 1)->firstOrFail();
            $pendingCount = PaymentLog::where('sy_id', '=', $currentSy->id)->where('status', '=', 0)->count();
            $confirmedCount = PaymentLog::where('sy_id', '=', $currentSy->id)->where('status', '=', 1)->count();
        } */

        return view('BCA.Backend.cashier-layouts.dashboard.index', compact('pendingCount', 'confirmedCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
