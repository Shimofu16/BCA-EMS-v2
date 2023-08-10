@extends('BCA.Backend.registrar-layouts.index')




@section('page-title')
    Student’s Information
@endsection
@section('contents')
    @livewire('backend.registrar.student-show', ['student' => $student, 'sections' => $sections, 'father' => $father, 'mother' => $mother, 'guardian' => $guardian, 'studentPhoto' => $studentPhoto, 'goodMoral' => $goodMoral, 'form137File' => $form137File, 'psaFile' => $psaFile, 'hasFilePsa' => $hasFilePsa, 'hasFileForm137' => $hasFileForm137, 'hasFileGoodMoral' => $hasFileGoodMoral, 'hasFilePhoto' => $hasFilePhoto])
@endsection
