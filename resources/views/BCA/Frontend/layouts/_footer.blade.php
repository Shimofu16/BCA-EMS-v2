<!-- Footer -->
<footer class="bg-blue mt-3 text-center text-lg-start text-white" id="footer">
    <div class="container">
        <!-- Grid container -->
        <div class="container p-5">
            <!-- Section: Links -->
            <section class="">
                <!--Grid row-->
                <div class="row">
                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold text-white">
                            Online Services
                        </h6>
                        <p>
                            <a class="text-white tag-hover" href="{{ route('enroll.index') }}">Online Enrollment</a>
                        </p>
                        <p>
                            <a class="text-white tag-hover" href="{{ route('tracker.index') }}">Enrollment Tracker</a>
                        </p>
                        <p>
                            <a class="text-white tag-hover" href="{{ route('portals.show',['role' => 'Student']) }}">Student Portal</a>
                        </p>
                        <p>
                            <a class="text-white tag-hover" href="{{ route('portals.show',['role' => 'Teacher']) }}">Teacher Portal</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <hr class="w-100 clearfix d-md-none" />

                    <!-- Grid column -->
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mt-3">
                        <h6 class="text-uppercase mb-4 font-weight-bold text-white">
                            Academics
                        </h6>
                        <p>
                            <a href="{{ route('academic.primary.index') }}" class="text-white tag-hover">Preschool</a>
                        </p>
                        <p>
                            <a href="{{ route('academic.elementary.index') }}" class="text-white tag-hover">Elementary</a>
                        </p>
                        <p>
                            <a href="{{ route('academic.juniorHighSchool.index') }}" class="text-white tag-hover">Junior Highschool</a>
                        </p>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                    <hr class="w-100 clearfix d-md-none" />

                    <!-- Grid column -->
                    <div class="col-md-4 col-lg-3 col-xl-5 mx-auto mt-3">
                        <div class="row flex-column">
                            <h6 class="text-uppercase mb-4 font-weight-bold text-white">
                                Contact
                            </h6>
                            <p>
                                <i class="fas fa-home mr-3"></i> 9006 Eagle Street Main
                                Road, Area 3 SItio Veterans, Bagong SIlangan 1100 Quezon
                                City, Philippines
                            </p>
                            <p>
                                <i class="fas fa-envelope mr-3"></i>
                                breakthru_christian@yahoo.com
                            </p>
                            <p><i class="fas fa-phone mr-3"></i> 270047107</p>
                            <h6 class="text-uppercase mb-4 font-weight-bold text-white">
                                KEEP IN TOUCH
                            </h6>
                            <div class="col-md-4">
                                <!-- Facebook -->
                                <a class="btn btn-primary rounded-circle m-1 shadow"
                                    href="https://www.facebook.com/BreakthroughChristianAcademy" role="button"><i
                                        class="fab fa-facebook-f"></i></a>
                            </div>
                        </div>
                    </div>
                    <!-- Grid column -->

                    <!-- Grid column -->
                </div>
                <!--Grid row-->
            </section>
            <!-- Section: Links -->
        </div>
        <!-- Grid container -->
    </div>
    <!-- End of .container -->
</footer>
<!-- Footer -->
