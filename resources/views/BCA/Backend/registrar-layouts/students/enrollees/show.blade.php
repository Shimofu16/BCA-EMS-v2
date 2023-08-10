@extends('BCA.Backend.registrar-layouts.index')

@section('page-title')
    Student’s Information
@endsection
@section('contents')

@livewire('backend.registrar.student-show',
['student' => $student,
 'sections' => $sections,
  'father' => $father,
   'mother' => $mother,
    'guardian' => $guardian,
     'studentPhoto' => $studentPhoto,
      'goodMoral' => $goodMoral,
      'form138File' => $form138File,
       'psaFile' => $psaFile,
       'hasFilePsa' => $hasFilePsa,
        'hasFileForm138' => $hasFileForm138,
        'hasFileGoodMoral' => $hasFileGoodMoral,
        'hasFilePhoto' => $hasFilePhoto
        ])
@endsection
