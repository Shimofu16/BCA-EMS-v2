<?php

namespace App\Http\Livewire\Backend\Registrar;

use App\Models\ClassDay;
use Livewire\Component;

class EditClass extends Component

{
    public $section;
    public $class;

    public $sections;
    public $subjects;
    public $teachers;
    public $schedule;
    public $days, $selectedDay;
    public $start;
    public $end;
    public $level;
    public $section_id;
    public $subject_id;
    public $teacher_id;

    public function removeDay($index)
    {
        try {
            $this->days->forget($index);
            $this->reset('selectedDay');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
    }
    public function update()
    {

        $daysOfWeek = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
        $sorted = collect();
        foreach ($this->days as $k => $v) {
            $key = array_search($v, $daysOfWeek);
            if ($key !== FALSE) {
                $sorted[$key] = $v;
            }
        }
        $this->class->update([
            'teacher_id' => $this->teacher_id,
            'start_time' => $this->start,
            'end_time' => $this->end,
            'updated_at' => now(),
        ]);
        ClassDay::where('class_id', $this->class->id)->delete();
        foreach ($sorted->sortKeys() as $day) {
            ClassDay::create([
                'class_id' => $this->class->id,
                'day' => $day
            ]);
        }

        toast()->success('SYSTEM MESSAGE', ' Class updated successfully.')->autoClose(5000)->animation('animate__fadeInRight', 'animate__fadeOutDown')->timerProgressBar();
        return redirect(request()->header('Referer'));
    }

    public function mount()
    {
        /* convert collection to array */
        $this->days = collect($this->class->days)->pluck('day')->sortKeys();
        $this->start = $this->class->start_time;
        $this->end = $this->class->end_time;
        $this->teacher_id = $this->class->teacher_id;

    }
    public function updatedSchedule($value)
    {
        $this->selectedDay = $value;
        $this->section_id = $value;
    }
    public function render()
    {
        /* push data from schedule to array days */
        if (!empty($this->selectedDay)) {
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
        return view('livewire.backend.registrar.edit-class');
    }
}
