<?php

namespace App\Http\Livewire\Backend\Registrar;

use App\Models\ClassDay;
use App\Models\Grade;
use App\Models\Schedule;
use App\Models\SchoolYear;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Teacher;
use Livewire\Component;

class AddClass extends Component

{
    public $sections;
    public $subjects;
    public $teachers;
    public $schedule;
    public $days, $selectedDay;
    public $quarters;
    public $start;
    public $end;
    public $currentSy;
    public $suggestion;
    public $level = '';
    public $section_id = '';
    public $subject_id = '';
    public $teacher_id = '';

    public function removeDay($index)
    {
        try {
            $this->days->forget($index);
            $this->reset('selectedDay');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    private function sortDays()
    {
        $daysOfWeek = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
        $sorted = collect();
        foreach ($this->days as $k => $v) {
            $key = array_search($v, $daysOfWeek);
            if ($key !== FALSE) {
                $sorted[$key] = $v;
            }
        }
        $sorted->sortKeys();
        $this->days = $sorted;
    }
    private function getCode()
    {
        $subject = Subject::find($this->subject_id);
        $section = Section::with('students')->find($this->section_id);
        $subject_parts = explode(' ', trim($subject->subject));
        $first_part = array_shift($subject_parts);
        $last_part = array_pop($subject_parts);
        $subject_initials = (mb_substr($first_part, 0, 1) .
            mb_substr($last_part, 0, 1)
        );
        $section_parts = explode(' ', trim($section->gradeLevel->grade_name));
        $first_part = array_shift($section_parts);
        $last_part = array_pop($section_parts);
        $section_initials = (mb_substr($first_part, 0, 1) .
            mb_substr($last_part, 0, 1)
        );
        $code = $subject_initials . '-' . $section_initials . '-A';
        return $code;
    }
    private function checkSubjectSchedule()
    {
        $section = Section::with('students')->find($this->section_id);

        // Get all class schedules for the subject and section
        $classSchedules = Schedule::with('subject', 'gradeLevel', 'sy')
            ->where('sy_id', '=', $this->currentSy->id)
            ->where('grade_level_id', '=', $section->grade_level_id)
            ->where('subject_id', '=', $this->subject_id)
            ->where('section_id', '=', $this->section_id)
            ->get();

        // Check if there is an overlapping time and day for the subject schedules
        $hasOverlappingTime = false;
        foreach ($classSchedules as $class) {
            // Convert the collection to an array
            $days = $this->days->toArray();
            // Check if the schedules have the same day
            if (in_array($class->day, $days)) {
                // Check if the schedules have overlapping times
                if (($this->start >= $class->start_time && $this->start <= $class->end_time) || ($this->end >= $class->start_time && $this->end <= $class->end_time) || ($this->start <= $class->start_time && $this->end >= $class->end_time)) {
                    $hasOverlappingTime = true;
                    break;
                }
            }
        }

        return $hasOverlappingTime;
    }



    private function checkDuplicateSubject()
    {
        $section = Section::with('students')->find($this->section_id);

        // Check if the same subject is already assigned to a class in the same section
        $existingSubject = Schedule::where('sy_id', '=', $this->currentSy->id)
            ->where('grade_level_id', '=', $section->grade_level_id)
            ->where('subject_id', '=', $this->subject_id)
            ->where('section_id', '=', $this->section_id)
            ->exists();

        return $existingSubject;
    }


    private function checkTeacherSchedule()
    {
        $currentSy = SchoolYear::where('is_active', '=', 1)->first();
        $section = Section::with('students')->find($this->section_id);

        // Get all class schedules for the teacher and school year
        $classSchedules = Schedule::with('teacher', 'gradeLevel', 'sy')
            ->where('sy_id', '=', $currentSy->id)
            ->where('teacher_id', '=', $this->teacher_id)
            ->get();

        // Check if there is an overlapping time and day for the subject schedules
        $hasOverlappingTime = false;
        foreach ($classSchedules as $class) {
            // Skip checking for the same class schedule
            if ($class->section_id == $this->section_id && $class->subject_id == $this->subject_id) {
                continue;
            }
            // Convert the collection to an array
            $days = $this->days->toArray();
            // Check if the schedules have the same day
            if (in_array($class->day, $days)) {
                // Check if the schedules have overlapping times
                if (($this->start >= $class->start_time && $this->start <= $class->end_time) || ($this->end >= $class->start_time && $this->end <= $class->end_time) || ($this->start <= $class->start_time && $this->end >= $class->end_time)) {
                    $hasOverlappingTime = true;
                    break;
                }
            }
        }

        return $hasOverlappingTime;
    }



    public function save()
    {
        $section = Section::with('students')->find($this->section_id);
        $code = $this->getCode();
        $this->sortDays();

        if ($this->checkDuplicateSubject()) {
            $this->resetErrorBag();
            $this->addError('subject_id', 'Subject is already assigned to a class');
            $this->suggestion = "Select a different subject or section";
            return;
        }

        if ($this->checkSubjectSchedule()) {
            $this->resetErrorBag();
            $this->addError('schedule', 'Time and day for subject is overlapping');
            $this->suggestion = "Select a different time or day";
            return;
        }

        if ($this->checkTeacherSchedule()) {
            $this->resetErrorBag();
            $this->addError('teacher_id', 'Teacher is already assigned to a class or the time and day for teacher is overlapping');
            $this->suggestion = "Select a different teacher or time or day";
            return;
        }

        try {
            /* save class schedule */
            $class_id =   Schedule::create([
                'class_code' => $code,
                'section_id' => $this->section_id,
                'subject_id' => $this->subject_id,
                'grade_level_id' => $section->grade_level_id,
                'sy_id' => $this->currentSy->id,
                'teacher_id' => $this->teacher_id,
                'start_time' => $this->start,
                'end_time' => $this->end,
                'created_at' => now(),
            ])->id;

            /* check if there is at least one student in section*/
            if (!empty($section->students->first()->id)) {
                /* create grades for the enrolled students but does not have data in grades table */
                foreach ($section->students as $student) {
                    Grade::create([
                        'class_id' => $class_id,
                        'student_id' =>  $student->id,
                    ]);
                }
            }

            foreach ($this->days as $key => $day) {
                ClassDay::create(['class_id' => $class_id, 'day' => $day]);
            }

            toast()->success('SYSTEM MESSAGE', ' created successfully..')->autoClose(5000)->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
            return redirect(request()->header('Referer'));
        } catch (\Throwable $th) {
            alert()->info('SYSTEM MESSAGE', $th->getMessage())->autoClose(5000)->animation('animate__zoomIn', 'animate__zoomOutDown')->timerProgressBar();
            return redirect(request()->header('Referer'));
        }
    }


    public function mount()
    {
        $this->sections = Section::all();
        $this->subjects = Subject::all();
        $this->days = collect([]);
        $this->quarters = collect([ // fill it with the correct values
            'First', 'Second', 'Third', 'Fourth'
        ]);
        $this->currentSy =  SchoolYear::where('is_active', '=', 1)->first();
        $this->teachers = Teacher::all();
    }
    public function updatedSchedule($value)
    {
        $this->selectedDay = $value;
    }
    public function render()
    {
        if ($this->selectedDay) {
            if ($this->days->count() > 0) {
                foreach ($this->days as $key => $value) {
                    if ($value == $this->selectedDay) {
                        $this->days->forget($key);
                    }
                }
            }
            if ($this->selectedDay == "All") {
                /* empty days */
                $this->days = collect([]);
                $this->days = collect([
                    'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'
                ]);
            } else {
                $this->days->push($this->schedule);
            }
        }
        return view('livewire.backend.registrar.add-class', ['days' => $this->days]);
    }
}