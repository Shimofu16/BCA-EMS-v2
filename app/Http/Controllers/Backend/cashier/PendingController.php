<?php

namespace App\Http\Controllers\Backend\cashier;

use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\GradeLevel;
use App\Models\Payment;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PendingController extends Controller
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
                ->where('status', '=', 0)
                ->where('grade_level_id', '=', $level)
                ->get();
        } else {
            $payments = Payment::with('sy')
                ->where('sy_id', '=', $currentSy->id)
                ->where('status', '=', 0)
                ->get();
        }
        $gradeLevels = GradeLevel::all();
        return view('BCA.Backend.cashier-layouts.payments.pending.index', compact('payments', 'gradeLevels'));
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
        try {
            // Find the payment by ID
            $payment = Payment::find($id);
            // Find the balance record of the student who made the payment
            $balance = Balance::where('student_id', '=', $payment->student_id)->first();

            // Calculate the new balance, ensuring it is not negative
            $amount = max(0, $balance->amount - $request->input('amount'));

            // Update the payment record
            $payment->update([
                'amount' => $request->input('amount'),
                'status' => 1,
                'updated_by' => Auth::user()->getFullName(),
                'updated_at' => now(),
            ]);

            // Update the balance record
            $balance->update([
                'amount' => $amount,
                'is_paid' => ($amount == 0) ? 1 : 0,
                'updated_at' => now(),
            ]);


            return redirect()->route('cashier.payment.confirmed.index')->with('successToast', 'Payment confirmed!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('errorAlert', 'Something went wrong!');
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
        //
    }
}
