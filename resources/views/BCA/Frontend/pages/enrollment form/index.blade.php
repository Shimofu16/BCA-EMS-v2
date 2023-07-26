<!DOCTYPE html>
<html lang="en">

@include('BCA.Frontend.layouts._head')

<body style="background-color: #E9EBFC;">
    <div class="container vh-80">
        <div class="row flex-nowrap mb-3 mt-5  justify-content-center">
            <div class="col-md-7 ">
                <div class="card bg-transparent border-0 shadow-none">
                    <div class="card-header text-center bg-blue text-white p-3 mb-3 shadow">
                        <h2 class="py-3 text-capitalize">BCA Online Enrollment Form</h2>
                    </div>
                    @livewire('frontend.enrollment-form')
                </div>
            </div>
        </div>
    </div>
  
@include('BCA.Frontend.layouts._foot')
</body>

</html>
