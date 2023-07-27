<?php

namespace App\Http\Controllers\Backend\admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolYear;
use Illuminate\Http\Request;

class SchoolYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schoolYears = SchoolYear::all();
        return view('BCA.Backend.admin-layouts.manage.school-year.index', compact('schoolYears'));
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
            $startYear = date('Y', strtotime($request->start_date));
            $endYear = date('Y', strtotime($request->end_date));
            SchoolYear::create([
                'name' => $startYear . '-' . $endYear,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
            ]);
            return back()->with('successToast', 'School Year Created Successfully');
        } catch (\Throwable $th) {
            return back()->with('errorToast', $th->getMessage());
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
        $schoolYear = SchoolYear::find($id);

        $startYear = date('Y', strtotime($request->start_date));
        $endYear = date('Y', strtotime($request->end_date));

        $schoolYear->update([
            'name' => $startYear . '-' . $endYear,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'is_active' => $request->is_active,
            'enrollment_status' => $request->enrollment_status,
        ]);
        return redirect()->back()->with('successToast', 'School Year Updated Successfully');
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
