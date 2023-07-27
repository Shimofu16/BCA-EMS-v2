<?php

namespace App\Http\Controllers\Backend\registrar;

use App\Models\Subject;
use App\Models\GradeLevel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Section;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::orderBy('id', 'asc')->get();
        $sections = Section::all();
        $gradeLevels = GradeLevel::all();
        return view('BCA.Backend.registrar-layouts.subjects.index', compact('subjects', 'sections', 'gradeLevels'));
    }
    public function subjects()
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
            $request->validate([
                'subject' => 'required|unique:subjects,subject',
            ]);
            Subject::create([
                'subject' => $request->input('subject'),
                'created_at' => now(),
            ]);
            toast()->success('SYSTEM MESSAGE', Str::ucfirst($request->input('subject')) . ' created successfully..')->autoClose(5000)->width('500px')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->info('SYSTEM MESSAGE', $th->getMessage())->autoClose(5000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
            return redirect()->back();
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
        $subjects = Subject::where('grade_level_id', $id)->orderBy('id', 'asc')->get();
        $gradeLevel = GradeLevel::find($id);
        $gradeLevels = GradeLevel::all();
        return view('BCA.Backend.registrar-layouts.subjects.show', compact('subjects', 'gradeLevel', 'gradeLevels'));
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
        $request->validate([
            'subject' => 'required',
        ]);
        try {
            $subject = Subject::findOrFail($id);
            $subject->subject = $request->input('subject');
            $subject->updated_at = now();
            $subject->update();
            if ($subject->wasChanged()) {
                toast()->success('SYSTEM MESSAGE', $request->input('subject') . ' updated successfully.')->autoClose(5000)->width('500px')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
                return redirect()->back();
            }
            toast()->info('SYSTEM MESSAGE', ' Nothing changed')->autoClose(6000)->width('400px')->padding('10px')->background('#f8f9fc')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->info('SYSTEM MESSAGE', $th->getMessage())->autoClose(5000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();

            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $subject = Subject::find($id);
            toast()->success('SYSTEM MESSAGE', $subject->subject . ' was Successfully Deleted.')->autoClose(5000)->width('500px')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
            $subject->delete();
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->info('SYSTEM MESSAGE', $th->getMessage())->autoClose(5000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
            return redirect()->back();
        }
    }
}
