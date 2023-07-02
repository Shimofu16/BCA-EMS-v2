<?php

namespace App\Http\Controllers\Frontend\Academics;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AcademicsController extends Controller
{
    private function getAnnouncements($description)
    {
        $announcements = Announcement::with('gradeLevel')->whereHas('gradeLevel', function ($q)  use ($description){
            $q->where('description', $description);
        })
            ->get();
        if ($announcements->isEmpty()) {
            $announcements = null;
        }
        return $announcements;
    }
    public function primary()
    {
        $announcements = $this->getAnnouncements('Primary');
        return view('BCA.Frontend.pages.academics.primary.index', compact('announcements'));
    }
    public function elementary()
    {
        $announcements = $this->getAnnouncements('Elementary');
        return view('BCA.Frontend.pages.academics.elementary.index', compact('announcements'));
    }
    public function juniorHighSchool()
    {
        $announcements = $this->getAnnouncements('Junior High School');
        return view('BCA.Frontend.pages.academics.junior-high-school.index', compact('announcements'));
    }
}
