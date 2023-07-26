<?php

namespace App\Http\Controllers\General;

use App\Models\Photo;
use App\Models\Payment;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\requirements as Requirement;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class FileController extends Controller
{
    public static function folder($path)
    {
        if (!file_exists($path)) {
            Storage::disk('local')->makeDirectory($path);
        }
    }
    private function createFile($student_id, $file, $filename)
    {
        try {
            Requirement::where('student_id', '=', $student_id)
                ->where('filename', '=', $filename)
                ->where('isSubmitted', 1)
                ->firstOrFail();
        } catch (ModelNotFoundException $e) {
        }
    }

    /**
     * Add requirements for the given student based on the student type.
     *
     * @param string $path The path to store the requirement files.
     * @param int $student_id The ID of the student.
     * @param mixed $psa The PSA file for the student, or null if not applicable.
     * @param mixed $form_138 The Form 138 file for the student, or null if not applicable.
     * @param mixed $good_moral The Good Moral file for the student, or null if not applicable.
     * @param mixed $photo The photo file for the student, or null if not applicable.
     * @param string $student_type The type of student (New Student, Transferee, Old Student).
     * @param bool $hasPromissoryNote True if the student has a promissory note, false otherwise.
     * @return void
     */
    public static function requirements($path, $student_id, $psa, $form_138, $good_moral, $photo, $student_type, $hasPromissoryNote)
    {
        switch ($student_type) {
            case 'New Student':
                // Add PSA and photo requirements for new students
                self::addRequirement($path, $student_id, 'psa', $psa);
                self::addRequirement($path, $student_id, 'photo', $photo);
                break;
            case 'Transferee':
                // Add PSA, Form 138, Good Moral, and photo requirements for transferees
                self::addRequirement($path, $student_id, 'psa', $psa);
                self::addRequirement($path, $student_id, 'form 138', $form_138);
                self::addRequirement($path, $student_id, 'good moral', $good_moral);
                self::addRequirement($path, $student_id, 'photo', $photo);
                break;
            case 'Old Student':
                //
                $isPsaSubmitted = self::checkIfRequirementExistsAndSubmitted($student_id, 'psa');
                $isForm138Submitted = self::checkIfRequirementExistsAndSubmitted($student_id, 'form 138');
                $isGoodMoralSubmitted = self::checkIfRequirementExistsAndSubmitted($student_id, 'good moral');
                $isPhotoSubmitted = self::checkIfRequirementExistsAndSubmitted($student_id, 'photo');

                if (!$isPsaSubmitted) {
                    self::addRequirement($path, $student_id, 'psa', $psa);
                }
                if (!$isForm138Submitted) {
                    self::addRequirement($path, $student_id, 'form 138', $form_138);
                }
                if (!$isGoodMoralSubmitted) {
                    self::addRequirement($path, $student_id, 'good moral', $good_moral);
                }
                if (!$isPhotoSubmitted) {
                    self::addRequirement($path, $student_id, 'photo', $photo);
                }
                break;
        }
    }

    /**
     * Check if the requirement exists and has been submitted by the student
     *
     * @param int $student_id The ID of the student
     * @param string $filename The filename of the requirement
     * @return bool Returns true if the requirement exists and has been submitted, false otherwise
     */
    private function checkIfRequirementExistsAndSubmitted($student_id, $filename)
    {
        // Get the requirement with the given student ID, filename, and isSubmitted value of 1 (true)
        $requirement = Requirement::where('student_id', $student_id)
            ->where('filename', $filename)
            ->where('isSubmitted', 1)
            ->first();

        // If the requirement exists and has been submitted, check if the file exists in the storage path
        if ($requirement) {
            $filePath = storage_path('app/' . $requirement->filepath); // Get the full path of the file
            if (file_exists($filePath)) { // Check if the file exists
                return true; // Return true if the file exists
            }
        }

        return false; // Return false if the requirement does not exist or has not been submitted
    }

    /**
     * Adds a requirement for the student if it doesn't already exist.
     *
     * @param string $path The storage path for the requirement file.
     * @param int $student_id The ID of the student.
     * @param string $filename The name of the requirement file.
     * @param UploadedFile|null $file The uploaded file for the requirement.
     */
    private static function addRequirement($path, $student_id, $filename, $file)
    {
        if ($file != null) {
            try {
                // Check if the requirement already exists and has been submitted.
                $requirement = Requirement::where('student_id', $student_id)
                    ->where('filename', $filename)
                    ->where('isSubmitted', 1)
                    ->firstOrFail();
            } catch (ModelNotFoundException $e) {
                // If the requirement doesn't exist or hasn't been submitted, add it.
                $extension = $file->getClientOriginalExtension();
                $fileName = $filename . '.' . $extension;
                $requirement = [
                    'student_id' => $student_id,
                    'filename' => $filename,
                    'filepath' => $path . '/' . $fileName,
                    'isSubmitted' => 1,
                ];
                // Check if the file already exists in storage.
                if (!file_exists(storage_path('app/' . $path . '/' . $fileName))) {
                    // If the file doesn't exist, store it.
                    $file->storeAs($path, $fileName);
                }
                // Create the requirement in the database.
                Requirement::create($requirement);
            }
        }
    }



    /* FIXME:ask CHAT GPT to fix the file uploads */
    public static function old($path, $student_id, $form_138)
    {
        try {
            if ($form_138 != null) {
                // Check if a Form 137 file already exists for this student
                $form138File = Requirement::where('student_id', '=', $student_id)
                    ->where('filename', '=', 'form 138')
                    ->where('isSubmitted', '=', 1)
                    ->first();

                // Get the extension of the new Form 138 file
                $form_138Extension = $form_138->getClientOriginalExtension();
                // Rename the file to "form_138"
                $form_138filename = 'form 138' . '.' . $form_138Extension;

                // If a Form 137 file was found, delete it and store the new Form 138 file
                if ($form138File) {
                    Storage::delete($form138File->filepath);
                    $form_138->storeAs($path, $form_138filename);
                    $form138File->filepath = $path . '/' . $form_138filename;
                    $form138File->update();
                } else {
                    // If no Form 137 file was found, create an array with the data for the new Form 138 requirement
                    $form_138Requirement = [
                        'student_id' => $student_id,
                        'filename' => 'form 138',
                        'filepath' =>  $path . '/' . $form_138filename,
                        'isSubmitted' => 1,
                    ];
                    // If a file with the same name already exists in the specified path, delete it
                    if (Storage::exists($path . '/' . $form_138filename)) {
                        Storage::delete(storage_path('app/' . $path . '/' . $form_138filename));
                    }
                    // Store the new Form 138 file in the specified path
                    $form_138->storeAs($path, $form_138filename);
                    // Create a new requirement for the Form 138 file
                    Requirement::create($form_138Requirement);
                }
            }
            // Return 1 on success
            return 1;
        } catch (\Throwable $th) {
            // Show an error alert with the exception message
            alert()->error('ErrorAlert', $th->getMessage());
            // Return 0 on error
            return 0;
        }
    }

    public static function pop($path, $payment_id, $pop, $sy)
    {
        try {
            $payment = Payment::where('id', '=', $payment_id)->latest('id')->first();
            $proof = 'proof-of-payment-' . $sy . '.' . $pop->getClientOriginalExtension();
            $pop->storeAs($path, $proof);
            $payment->pop = 'proof-of-payment';
            $payment->path = $path . '/' . $proof;
            $payment->save();
        } catch (\Throwable $th) {
            alert()->error('Error', $th->getMessage());
            dd($th);
            return 0;
        }
    }

    public static function photos($photos, $gallery_id, $path, $title)
    {
        try {
            // Iterate through each photo
            foreach ($photos as $key => $photo) {
                // Generate a unique filename
                $filename = $title . '-' . ($key + 1) . '.' . $photo->getClientOriginalExtension();
                // Check if the file already exists in the given path
                while (Storage::exists($path . '/' . $filename)) {
                    // If it does, increment the key and generate a new filename
                    $filename = $title . '-' . ++$key . '.' . $photo->getClientOriginalExtension();
                }
                // Create a new photo in the database
                Photo::create([
                    'gallery_id' => $gallery_id,
                    'photo' => Str::lower($title . '-' . $key),
                    'path' => $path . '/' . $filename,
                ]);
                // Save the photo to the given path
                $photo->storeAs($path, $filename);
            }

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
