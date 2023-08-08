<?php

namespace App\Http\Livewire\Backend\Teacher;

use App\Models\Grade;
use App\Models\SchoolYear;
use Livewire\Component;

class AddGrades extends Component
{
    public $grades = null;
    public $currentGrades = null;
    public $students;
    public $subject_id;
    public $section_id;
    public $currentGrading = 1;
    public $firstGrading, $secondGrading, $thirdGrading, $fourthGrading;
    public $isDoneFirstGrading = false, $isDoneSecondGrading = false, $isDoneThirdGrading = false, $isDoneFourthGrading = false;
    public $first = "first_grading", $second = "second_grading", $third = "third_grading", $fourth = "fourth_grading";

    public $queryString = ['currentGrading'];
    public $preview_mode = false;
    public $summary_mode = false;
    public $currentSy;
    protected $rules = [
        'grades.*.grade' => ['numeric', 'required', 'digits_between:1,2', 'max:'],
    ];
    protected $validationAttributes = [
        'grades.*.grade' => 'Grades',
    ];
    protected $message = [
        'grades.*.grade.required' => 'Grade is required',
        'grades.*.grade.numeric' => 'Grade must be numeric',
    ];
    private function saveGrade()
    {
        foreach ($this->students as  $student) {
            foreach ($this->grades as $key => $grade) {
                if ($key == $student->id) {
                    switch ($this->currentGrading) {
                        case 1:
                            $student->update(['first_grading' => $grade['grade']]);
                            break;
                        case 2:
                            $student->update(['second_grading' => $grade['grade']]);
                            break;
                        case 3:
                            $student->update(['third_grading' => $grade['grade']]);
                            break;
                        case 4:
                            $student->update(['fourth_grading' => $grade['grade']]);
                            break;
                    }
                }
            }
            if ($student->first_grading != null && $student->second_grading != null && $student->third_grading != null && $student->fourth_grading != null) {
                $student->update([
                    'final_grade' => ($student->first_grading + $student->second_grading + $student->third_grading + $student->fourth_grading) / 4,
                ]);
            }
        }
    }
    private function checkIfTheGradesIsValid()
    {

        $allValid = true;
        foreach ($this->grades as $grade) {
            if (!is_numeric($grade['grade'])) {
                // If the grade is not a number, set $allValid to false and break out of the loop
                $allValid = false;
                break;
            }

            // Check if the grade is a decimal or two-digit integer
            if (strpos($grade['grade'], ".") !== false) {
                // Check if the grade has more than two decimal places
                if (substr_count($grade['grade'], ".") > 1) {
                    $allValid = false;
                    break;
                }
            } elseif (strlen($grade['grade']) != 2) {
                // Check if the grade is not a two-digit integer
                $allValid = false;
                break;
            }
        }

        return $allValid;
    }
    private function countStudentsWithNoGrades()
    {
        $count = 0;
        foreach ($this->students as $student) {
            /* base on current grading */
            switch ($this->currentGrading) {
                case 1:
                    if ($student->first_grading === null) {
                        $count++;
                    }
                    break;
                case 2:
                    if ($student->second_grading === null) {
                        $count++;
                    }
                    break;
                case 3:
                    if ($student->third_grading === null) {
                        $count++;
                    }
                    break;
                case 4:
                    if ($student->fourth_grading === null) {
                        $count++;
                    }
                    break;
            }
        }
        return $count;
    }
    public function preview()
    {
        if ($this->grades != null && count($this->grades) == $this->countStudentsWithNoGrades()) {
            if ($this->checkIfTheGradesIsValid()) {
                $this->resetErrorBag('grades');
                $this->currentGrades = $this->grades;
                $this->preview_mode = true;
            } else {
                $this->resetErrorBag('grades');
                $this->addError('grades', 'Invalid grades. Please check your input.');
                return;
            }
        } else {
            $this->resetErrorBag('grades');
            $this->addError('grades', 'Please input grades');
            return;
        }
    }
    public function summary()
    {
        if ($this->summary_mode) {
            $this->summary_mode = false;
        } else {
            $this->summary_mode = true;
        }
    }
    public function save()
    {
        if ($this->checkIfTheGradesIsValid()) {
            try {
                $this->saveGrade();
                $this->preview_mode = false;
                toast()->success('SYSTEM MESSAGE', 'grades successfully added')->autoClose(5000)->width('500px')->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
                return redirect(request()->header('Referer'));
            } catch (\Throwable $th) {
                dd($th->getMessage());
            }
        }
        $this->resetErrorBag();
        $this->addError('grades', 'Invalid grades');
    }
    public function add($grade_id)
    {
        if (!empty($this->grades[$grade_id]['grade'])) {
            $grade = Grade::find($grade_id);

            switch ($this->currentGrading) {
                case 1:
                    $grade->first_grading = $this->grades[$grade_id]['grade'];
                    break;
                case 2:
                    $grade->second_grading = $this->grades[$grade_id]['grade'];
                    break;
                case 3:
                    $grade->third_grading = $this->grades[$grade_id]['grade'];
                    break;
                case 4:
                    $grade->fourth_grading = $this->grades[$grade_id]['grade'];
                    break;
            }

            $grade->save();
        }
    }
    public function first()
    {
        $this->reset('grades', 'preview_mode');
        $this->currentGrading = 1;
        $this->summary_mode = false;
    }
    public function second()
    {
        $this->reset('grades', 'preview_mode');
        $this->summary_mode = false;
        $this->currentGrading = 2;
    }
    public function third()
    {
        $this->reset('grades', 'preview_mode');
        $this->summary_mode = false;
        $this->currentGrading = 3;
    }
    public function fourth()
    {
        $this->reset('grades', 'preview_mode');
        $this->summary_mode = false;
        $this->currentGrading = 4;
    }

    public function checkIfStudentsHasGrades($grading)
    {
        $totalCount  =  Grade::with('class', 'student')
            ->whereHas('student', function ($query) {
                  $query->where('status', '=', 'enrolled');
            })
            ->where('class_id', '=', $this->students->first()->class->id)
            ->count();
        $initialCount =   Grade::with('class', 'student')
            ->whereHas('student', function ($query) {
                  $query->where('status', '=', 'enrolled');
            })
            ->where('class_id', '=', $this->students->first()->class->id)
            ->where($grading, '!=', null)
            ->count();
        if ($totalCount === $initialCount) {
            return true;
        }
        return false;
    }

    public function mount()
    {
        $this->currentSy = SchoolYear::where('is_active', '=', 1)->first();
        $this->subject_id = $this->students->first()->class->subject_id;
        $this->firstGrading = $this->checkIfStudentsHasGrades($this->first);
        $this->secondGrading = $this->checkIfStudentsHasGrades($this->second);
        $this->thirdGrading = $this->checkIfStudentsHasGrades($this->third);
        $this->fourthGrading = $this->checkIfStudentsHasGrades($this->fourth);

        if ($this->firstGrading == false && $this->secondGrading == false && $this->thirdGrading == false && $this->fourthGrading == false) {
            $this->currentGrading = 1;
        }
        if ($this->firstGrading == true && $this->secondGrading == false && $this->thirdGrading == false && $this->fourthGrading == false) {
            $this->currentGrading = 2;
            $this->isDoneFirstGrading = $this->firstGrading;
        }
        if ($this->firstGrading == true && $this->secondGrading == true && $this->thirdGrading == false && $this->fourthGrading == false) {
            $this->currentGrading = 3;
            $this->isDoneFirstGrading = $this->firstGrading;
            $this->isDoneSecondGrading = $this->secondGrading;
        }
        if ($this->firstGrading == true && $this->secondGrading == true && $this->thirdGrading == true) {
            $this->currentGrading = 4;
            $this->isDoneFirstGrading = $this->firstGrading;
            $this->isDoneSecondGrading = $this->secondGrading;
            $this->isDoneThirdGrading = $this->thirdGrading;
        }

        // Set firstGrading to thirdGrading to true if fourthGrading has grades
        if ($this->fourthGrading == true) {
            $this->firstGrading = true;
            $this->secondGrading = true;
            $this->thirdGrading = true;
        }
    }

    public function render()
    {
        return view('livewire.backend.teacher.add-grades', [
            'students' => Grade::with('student', 'class')
                ->whereHas('student', function ($query) {
                    $query->where('status', '=', 'enrolled');
                })
                ->where('class_id', '=', $this->students->first()->class->id)
                ->get()
                ->sortBy('student.last_name')
        ]);
    }
}
