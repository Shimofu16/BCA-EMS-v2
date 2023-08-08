<?php

namespace App\Http\Controllers\General;

use App\Exports\Backup as ExportsBackup;
use Carbon\Carbon;
use App\Models\Backup;
use Illuminate\Http\Request;
use App\Imports\StudentsImport;
use App\Imports\EnrollmentsImport;
use App\Http\Controllers\Controller;
use App\Models\Admin\DatabaseBackup;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class BackupController extends Controller
{
    public static function checkBackupsOverAWeek($type)
    {
        // get backups in database that match the specified type
        $backups = Backup::where('type', $type)->get();

        foreach ($backups as $backup) {
            // get the creation time of the backup
            $createdAt = Carbon::parse($backup->created_at);

            // check if the backup was created more than one week ago
            if ($createdAt->lt(Carbon::now()->subWeek())) {
                // delete the backup file
                $path = $backup->path;
                if (Storage::exists($path)) {
                    Storage::delete($path);
                }

                // delete the backup record from the database
                $backup->delete();
            }
        }

        // check if there are any files in the backup directory
        $path = 'app/backups/' . $type;
        $files = File::files(storage_path($path));
        dd($files, Carbon::createFromTimestamp(filectime($files[2])));
        if (!empty($files)) {
            // set the time one week ago
            $oneWeekAgo = Carbon::now()->subWeek();

            // loop through each file in the directory
            foreach ($files as $file) {
                // get the file name and check if a backup with the same name exists in the database
                $fileName = basename($file);
                $existingBackup = DatabaseBackup::where('type', $type)
                    ->where('name', $fileName)
                    ->first();
                // if a backup with the same name does not exist in the database
                if (!$existingBackup) {
                    // get the creation time of the file
                    $fileCreatedTime = Carbon::createFromTimestamp(filectime($file));

                    // dd($fileCreatedTime->lessThan($oneWeekAgo));
                    // if the file was created more than one week ago, delete the old backup file
                    if ($fileCreatedTime->lessThan($oneWeekAgo)) {
                        File::delete($file);
                    } else {
                        // if the file was created less than or equal to one week ago, generate a new backup
                        self::generateBackup($type);
                    }
                }
            }
        } else {
            // if there are no files in the backup directory, generate a new backup
            self::generateBackup($type);
        }
    }

    public static function backup($type)
    {
        self::checkBackupsOverAWeek($type);
    }
    public static function generateBackup()
    {
        $fileName = 'Backup-' . Carbon::now()->format('Y-m-d') . '.xlsx';
        $path = 'backups/';
        $fullPath = $path . $fileName;
        $existingBackup = Backup::where('name', $fileName)->first();

        if ($existingBackup) {
            // If the backup already exists, update the ExportsBackup and download
            Excel::store(new ExportsBackup(), $fullPath);
            $existingBackup->update(['updated_at' => Carbon::now()]);
            return (new ExportsBackup())->download($fileName);

        }

        Excel::store(new ExportsBackup(), $fullPath);

        Backup::create([
            'name' => $fileName,
            'path' => $fullPath,
        ]);

        return (new ExportsBackup())->download($fileName);
    }
}
