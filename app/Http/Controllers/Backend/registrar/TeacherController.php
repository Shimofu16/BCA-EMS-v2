<?php

namespace App\Http\Controllers\Backend\registrar;

use App\Http\Controllers\Controller;
use App\Models\GradeLevel;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::orderBy('id', 'asc')->where('isResigned', '=', 0)->get();
        $subjects = Subject::all();
        $gradeLevels = GradeLevel::all();
        return view('BCA.Backend.registrar-layouts.teacher.index', compact('teachers', 'subjects', 'gradeLevels'));
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
            Teacher::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'age' => $request->input('age'),
                'gender' => $request->input('gender'),
                'contact' => $request->input('contact'),
            ]);

            toast()->success('SYSTEM MESSAGE', $request->name . 'Added Successfully')->autoClose(3000)->width('500px')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
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
            $teacher = Teacher::findOrFail($id);
            $teacher->name = $request->input('name');
            $teacher->age = $request->input('age');
            $teacher->gender = $request->input('gender');
            $teacher->contact = $request->input('contact');
            $teacher->email = $request->input('email');
            $teacher->save();
            if ($teacher->wasChanged()) {
                toast()->success('SYSTEM MESSAGE', 'updated successfully.')->autoClose(6000)->width('400px')->padding('10px')->background('#f8f9fc')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $teacher = Teacher::findOrFail($id);
            $teacher->isResigned = 1;
            $teacher->save();

            toast()->success('SYSTEM MESSAGE', $teacher->name . '`s information has been archived.')->autoClose(6000)->width('400px')->padding('10px')->background('#f8f9fc')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
            return redirect()->back();
        } catch (\Throwable $th) {
            alert()->info('SYSTEM MESSAGE', $th->getMessage())->autoClose(5000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
            return redirect()->back();
        }
    }
}

