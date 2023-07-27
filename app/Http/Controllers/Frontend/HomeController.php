<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Event;
use App\Models\Gallery;
use App\Models\GradeLevel;
use App\Models\SchoolYear;
use App\Models\Section;


class HomeController extends Controller
{
    public function index()
    {
        $announcements = Announcement::orderBy('id', 'desc')->paginate(3);
        $albums = Gallery::has('photos')->orderBy('id', 'desc')->paginate(3);
        return view('BCA.Frontend.pages.home.index', compact('announcements', 'albums'));
    }

    public function calendar()
    {
        $events = Event::all();
        return view('BCA.Frontend.pages.calendar.index', compact('events'));
    }

    public function enroll()
    {
        $sections = Section::all();
        $gradelevels = GradeLevel::all();
        $sy = SchoolYear::where('is_active', '=', 1)->first();
        return view('BCA.Frontend.pages.enrollment form.index', compact('sections', 'gradelevels', 'sy'));
    }
    public function portals()
    {
        return view('BCA.Frontend.pages.portal.index');
    }

}
