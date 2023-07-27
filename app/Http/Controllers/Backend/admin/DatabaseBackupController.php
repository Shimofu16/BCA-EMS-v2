<?php

namespace App\Http\Controllers\Backend\admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\General\BackupController;
use App\Models\Backup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DatabaseBackupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $backups = Backup::all();
        return view('BCA.Backend.admin-layouts.manage.backups.index', compact('backups'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public static function generate()
    {
        $backup = new BackupController();
        $backup->generateBackup();
        return redirect()->back()->with('successToast', 'Backup generated successfully');
    }
    public function download($id)
    {
        $backup = Backup::findOrFail($id);
        return Storage::download($backup->path, $backup->name);
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
     * @param  \App\Models\Backup  $Backup
     * @return \Illuminate\Http\Response
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Backup  $Backup
     * @return \Illuminate\Http\Response
     */
    public function edit(Backup $Backup)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Backup  $Backup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $type)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Backup  $Backup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Backup $backup)
    {
        return Storage::download($backup->path);
    }
}

