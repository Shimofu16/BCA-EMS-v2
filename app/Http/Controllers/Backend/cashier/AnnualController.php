<?php

namespace App\Http\Controllers\Backend\cashier;

use App\Http\Controllers\Controller;
use App\Models\Annual;
use App\Models\Level;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class AnnualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
            Annual::create([
                'title' => $request->input('title'),
                'amount' => $request->input('amount'),
                'fee_type' => $request->input('fee_type'),
                'sy_id' => SchoolYear::where('is_active', '=', 1)->first()->id,
                'level_id' => $request->input('level'),
            ]);
            toast()->success('SYSTEM MESSAGE', $request->input('title') . ' created successfully..')->autoClose(5000)->width('500px')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
            return redirect()->back();
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
        try {
            $types =  collect([
                [
                    'id' => 1,
                    'title' => 'Basic Tuition',
                ],
                [
                    'id' => 2,
                    'title' => 'Developmental Fee',
                ],
                [
                    'id' => 3,
                    'title' => 'Miscellaneous Fee',
                ]
            ]);
            $level = Level::find($id);
            $fees =  Annual::where('level_id', $id)
                ->orderBy('fee_type', 'asc')
                ->get();
            return view('BCA.Backend.cashier-layouts.fees.annual.show', compact('fees', 'level', 'types'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('errorAlert', $th->getMessage());
        }
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
            $fee = Annual::find($id)->update([
                'amount' => $request->input('amount')
            ]);
            return redirect()->back()->with('successToast', 'Annual fee updated successfully.');
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
            $fee = Annual::find($id)->delete();
            return redirect()->back()->with('successToast', 'Annual fee deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('errorAlert', $th->getMessage());
        }
    }
}
