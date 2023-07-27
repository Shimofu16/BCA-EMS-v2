<?php

namespace App\Http\Controllers\Backend\admin;

use App\Models\GradeLevel;
use Illuminate\Support\Str;
use App\Models\Announcement;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class AnnouncementsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $announcements = Announcement::all();
        $levels = GradeLevel::all();
        return view('BCA.Backend.admin-layouts.manage.announcements.index', compact('announcements', 'levels'));
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
        // Validate the request inputs
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'required|image|mimes:png,jpg|max:5024', // 5MB Max
        ]);
        try {
            $photo = $request->file('photo');
            $extension = $photo->getClientOriginalExtension();
            $title = Str::replace(' ', '-', Str::lower($request->input('title')));
            $path = 'uploads/announcements/' . Str::replace(' ', '-', Str::lower($request->input('title')));
            $file_name =  $title . '.' . $extension;
            $photo->storeAs($path, $file_name);
            $level = ($request->input('gl') == "remove") ? null : (($request->input('gl') == null) ? null : (($request->input('gl'))));
            Announcement::create([
                'title' => Str::ucfirst($request->input('title')),
                'photo' => $title,
                'path' => $path . '/' . $file_name,
                'description' => $request->input('description'),
                'grade_level_id' => $level,
            ]);
            return redirect()->back()->with('successToast', 'Announcement created successfully..');
        } catch (\Throwable $th) {
            return back()->with('errorAlert', $th->getMessage());
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
        // Validate the request inputs
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'photo' => 'image|mimes:png,jpg|max:5024', // 5MB Max
        ]);

        try {
            $announcement = Announcement::findOrFail($id);
            $level = $announcement->GradeLevel->name == null ? ($request->input('gl') == 'remove' ? null : $request->input('gl')) : $announcement->grade_level_id;

            $data = [
                'title' => ucfirst($request->input('title')),
                'description' => $request->input('description'),
                'grade_level_id' => $level,
            ];

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $title = strtolower(str_replace(' ', '-', $request->input('title')));
                $path = 'uploads/announcements/' . $title;
                $fileName = $title . '.' . $photo->getClientOriginalExtension();

                if (Storage::exists($announcement->path)) {
                    Storage::delete($announcement->path);
                }

                $photo->storeAs($path, $fileName);

                $data['photo'] = $title;
                $data['path'] = $path . '/' . $fileName;
            }

            $announcement->update($data);
            return back()->with('successToast', 'Announcement updated successfully.');
        } catch (\Throwable $th) {
            return back()->with('errorAlert', $th->getMessage());
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
            $announcement = Announcement::findOrFail($id);
            $path = 'uploads/announcements/' . $announcement->title;

            if (Storage::exists($announcement->path)) {
                Storage::delete($announcement->path);
                // Get all files in this directory.
                $files = Storage::files($path);
                // Check if directory is empty.
                if (empty($files)) {
                    // Yes, delete the directory.
                    Storage::deleteDirectory($path);
                }
            }
            $announcement->delete();
            return back()->with('successToast', 'Announcement deleted successfully.!');
        } catch (\Throwable $th) {
            return back()->with('errorAlert', $th->getMessage());
        }
    }
}
