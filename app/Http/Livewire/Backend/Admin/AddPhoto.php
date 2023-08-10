<?php

namespace App\Http\Livewire\Backend\Admin;

use App\Http\Controllers\General\FileController;
use App\Models\Gallery;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class AddPhoto extends Component
{
    use WithFileUploads;
    public $photos = [];
    public $title, $date;
    public function save()
    {
        $this->validate([
            'title' => 'required',
            'date' => 'required',
            'photos.*' => 'required|mimes:png,jpg|max:5024', // 5MB Max
        ]);
        try {
            $title = Str::replace(' ', '-', Str::lower($this->title));
            $path = 'uploads/gallery';
            $photo = $this->photos[0];
            $filename = $title . '-.' . $photo->getClientOriginalExtension();
            $photo->storeAs($path, $filename);
            $gallery_id = Gallery::create([
                'title' => $this->title,
                'base_path' => $path,
                'path' => $path . '/' . $filename,
                'date' => $this->date
            ])->id;

            $isUploaded =  FileController::photos($this->photos, $gallery_id, $path, $this->title);
            if ($isUploaded) {
                return redirect(request()->header('Referer'))->with('successToast', 'Photos created successfully..');
                $this->reset();
            }
        } catch (\Throwable $th) {
            return redirect(request()->header('Referer'))->with('errorAlert', $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.backend.admin.add-photo');
    }
}
