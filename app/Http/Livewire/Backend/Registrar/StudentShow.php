<?php

namespace App\Http\Livewire\Backend\Registrar;

use App\Models\Grade;
use Livewire\Component;
use Livewire\WithFileUploads;

class StudentShow extends Component
{
    use WithFileUploads;

    public $student;
    public $hasFilePsa, $hasFileForm138, $hasFileGoodMoral, $hasFilePhoto;
    public $studentPhoto, $goodMoral, $form138File, $psaFile;
    public $father, $mother, $guardian;
    public $sections;
    public $left = 1, $center = 0, $right = 0, $gradetable = 0;


    public $grade;
    public $grades;
    public $gradings;
    public $average;
    /*
         every switch of grading the average and grades will change
         depends on the current grading selected of the student
    */
    protected  $validationAttributes  = [
        'psa' => 'Birth Certificate',
        'form_137' => 'Form 138',
        'good_moral' => 'Good Moral Certification',
        'photo' => '1x1 Photo',
    ];
    public function moveLeft()
    {
        $this->left = 1;
        $this->center = 0;
        $this->right = 0;
        $this->gradetable = 0;
    }
    public function moveCenter()
    {
        $this->center = 1;
        $this->left = 0;
        $this->right = 0;
        $this->gradetable = 0;
    }
    public function moveRight()
    {
        $this->right = 1;
        $this->center = 0;
        $this->left = 0;
        $this->gradetable = 0;
    }
    public function moveToGrades()
    {
        $this->gradetable = 1;
        $this->right = 0;
        $this->center = 0;
        $this->left = 0;
    }

    public function mount()
    {
        $totalFinalGrade = 0;
        $subTotalSubjects = 0;
        $totalSubjects = 0;
        $hasFinalGrade = false;

        $this->grades = Grade::with('class')
            ->where('student_id', '=', $this->student->id)
            ->whereHas('class', function ($query) {
                $query->where('sy_id', '=', $this->student->sy_id);
            })
            ->get();
        foreach ($this->grades as $item) {
            $hasFinalGrade = false;
            if ($item->final_grade != null) {
                $hasFinalGrade = true;
                $subTotalSubjects++;
                $totalFinalGrade += $item->final_grade;
            }
            $totalSubjects++;
        }
        if ($subTotalSubjects == $totalSubjects && $hasFinalGrade == true) {
            $this->average = $totalFinalGrade / $totalSubjects;
        }
    }

    public function render()
    {
        return view('livewire.backend.registrar.student-show');
    }
}
