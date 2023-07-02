@extends('BCA.Frontend.index')
@if (Request::routeIs('about.history.index'))
    @section('title')
        About Us
    @endsection

    @section('page-title')
        <li class="breadcrumb-item" aria-current="page">About Us</li>
    @endsection
@endif
@if (Request::routeIs('about.cv.index'))
    @section('title')
        Core Values and Principles
    @endsection
    @section('page-title')
        <li class="breadcrumb-item" aria-current="page">Core Values and Principles</li>
    @endsection
    @section('css')
        <style>
            .grid-container {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(6, 1fr));
                grid-template-rows: repeat(2, 1fr);
                gap: 10px;
                grid-auto-flow: row;
                justify-items: stretch;
                align-items: stretch;
                grid-template-areas:
                    "Love-and-compassion Love-and-compassion Academic-excellence Academic-excellence Prayer-and-praise Prayer-and-praise"
                    ". Discipline Discipline Integrity-and-honor Integrity-and-honor .";
                height: 500px;
            }

            .grid-items {
                height: 100% !important;
            }

            .Love-and-compassion {
                grid-area: Love-and-compassion;
            }

            .Academic-excellence {
                grid-area: Academic-excellence;
            }

            .Prayer-and-praise {
                grid-area: Prayer-and-praise;
            }

            .Discipline {
                grid-area: Discipline;
            }

            .Integrity-and-honor {
                grid-area: Integrity-and-honor;
            }

            /* create responsive grid */
            @media screen and (max-width: 1024px) {
                .grid-container {
                    height: 100%;
                }
            }

            @media screen and (max-width: 768px) {
                .grid-container {
                    grid-template-columns: repeat(auto-fit, minmax(6, 1fr));
                    grid-template-rows: repeat(2, 1fr);
                    gap: 10px;
                    grid-auto-flow: row;
                    justify-items: stretch;
                    align-items: stretch;
                    grid-template-areas:
                        "Love-and-compassion Love-and-compassion"
                        "Academic-excellence Academic-excellence"
                        "Prayer-and-praise Prayer-and-praise"
                        "Discipline Discipline"
                        "Integrity-and-honor Integrity-and-honor";
                    height: 100%;
                }
            }
        </style>
    @endsection
@endif

@section('contents')
    <section class="py-3 c-mt-nv">
        <div class="container mb-5">
            @include('BCA.Frontend.layouts._page-titles')
            <div class="row animate__animated animate__fadeInUp">
                <div class="col-md-8">
                    <div class="card bg-light rounded border-0 p-3">
                        @if (Request::routeIs('about.history.index'))
                            <div class="row mb-3">
                                <h3 class="text-blue">History</h3>
                                <p class="text-wrap">Breakthrough Christian Academy, Inc. is a Private Institution which
                                    has
                                    Preschools, Kindergarten, Elementary Schools under DedED Quezon City. When we first
                                    came to Sitio in
                                    2004 to heed the call of God to Pastor the community, I have seen the
                                    reality of poverty in the many malnourished children in our feeding program. Ptr.
                                    Carlos said that
                                    the community needs to experience God and that the children should be educated so
                                    that they can get
                                    out of poverty. I have learned that when the time is right God will make it happen
                                    Isaiah 60:22. I
                                    have seen the hand of God moved through the years and the miracles happening right
                                    before my eyes
                                    have increased my faith in the Lord.

                                    In 2007, mLBCii entered the new season as Pastor Carlos succeeded Pastor Steve
                                    Mirpuri as the new
                                    Senior Pastor of the Ministries of the Living Body of Christ International Inc. The
                                    dream of putting
                                    a school was realize when the board of trustees agreed to establish Breakthrough
                                    Christian Academy
                                    in Sitio Veterans in 2007.

                                    We continue to comply with the requirements of the government, mounting operational
                                    expenses and
                                    development of BCA facilities. With only 35 students in the first year of operation,
                                    year after year
                                    our enrollment increased. We thank the Lord Jesus for a total of 1782 students that
                                    were served in
                                    the community for 14 years here in BCA and the opportunity to share the gospel even
                                    to their
                                    families.
                                </p>
                            </div>
                            <div class="row mb-3">
                                <h3 class="text-blue">VISION</h3>
                                <p class="text-wrap">
                                    In the Philippines by 2023, become the premiere institution of life-long learning,
                                    producing
                                    individuals with strong Christian values.
                                </p>
                            </div>
                            <div class="row mb-3">
                                <h3 class="text-blue">MISSION</h3>
                                <p class="text-wrap">Provide holistic Christian education and become a community of
                                    life-long
                                    learners enjoying a better quality of life, edifying the dignity of the teaching
                                    profession,
                                    and offering fulfilment to benefactors.</p>
                            </div>
                            <div class="row mb-3">
                                <h3 class="text-blue">OBJECTIVES</h3>
                                <!-- list of numbers -->
                                <div class="list px-3">
                                    <ol>
                                        <li>To offer equal learning opportunities to all learners.
                                        </li>
                                        <li>To inculcate strong Christian values to the 21st century learners</li>
                                        <li>To provide quality basic education program enabling its graduates access to higher
                                            education, vocational training, and sustained livelihood.</li>
                                        <li>To strengthen school partnership with the family, community, and other stakeholders
                                            through shared responsibility in improving educational outcomes for learners.</li>
                                        <li>To develop teacher`s, staff, and administrator`s professional and personal growth by
                                            providing opportunities for innovation and excellence.</li>
                                        <li>To establish and continue partnership among benefactors by maintaining integrity and
                                            transparency of the sponsorship program.</li>
                                        <li>To be a premier institution of life-long learning.</li>
                                    </ol>
                                </div>
                            </div>
                        @endif
                        @if (Request::routeIs('about.cv.index'))
                            <div class="row mb-3">
                                <h3 class="text-blue">CORE VALUES</h3>
                                <div class="grid-container">
                                    <div class="Love-and-compassion">
                                        <div class="card shadow-sm bg-blue text-white grid-items">
                                            <div class="card-body d-flex flex-column align-items-center">
                                                <img src="{{ asset('/assets/img/icons/Home-AboutUs/love and compassion.png') }}"
                                                    alt="integrity.png" class="au-icons mb-3" />
                                                <h5 class="card-title text-center">Love and Compassion</h5>
                                                <p class="card-text text-center">
                                                    for God and others (expresses concern for others)
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Academic-excellence">
                                        <div class="card shadow-sm bg-blue text-white grid-items">
                                            <div class="card-body d-flex flex-column align-items-center">
                                                <img src="{{ asset('/assets/img/icons/Home-AboutUs/academic excellence.png') }}"
                                                    alt="integrity.png" class="au-icons mb-3" />
                                                <h5 class="card-title text-center">Academic Excellence</h5>
                                                <p class="card-text text-center">
                                                    that glorifies God (exercises the God given gifts and
                                                    talents to its optimum)
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Prayer-and-praise">
                                        <div class="card shadow-sm bg-blue text-white grid-items">
                                            <div class="card-body d-flex flex-column align-items-center">
                                                <img src="{{ asset('/assets/img/icons/Home-AboutUs/prayer and praise.png') }}"
                                                    alt="integrity.png" class="au-icons mb-3" />
                                                <h5 class="card-title text-center">Prayer and Praise</h5>
                                                <p class="card-text text-center">
                                                    are the keys to a happy and fruitful life (an attitude
                                                    of gratitude at all times)
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Discipline">
                                        <div class="card shadow-sm bg-blue text-white grid-items">
                                            <div class="card-body d-flex flex-column align-items-center">
                                                <img src="{{ asset('/assets/img/icons/Home-AboutUs/discipline.png') }}"
                                                    alt="integrity.png" class="au-icons mb-3" />
                                                <h5 class="card-title text-center">Discipline</h5>
                                                <p class="card-text text-center">
                                                    Discipline is required to succeed in
                                                    anything (encompasses mental, intellectual and
                                                    physical)
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="Integrity-and-honor">
                                        <div class="card shadow-sm bg-blue text-white grid-items">
                                            <div class="card-body d-flex flex-column align-items-center">
                                                <img src="{{ asset('/assets/img/icons/Home-AboutUs/integrity.png') }}"
                                                    alt="integrity.png" class="au-icons mb-3" />
                                                <h5 class="card-title text-center">Integrity and Honor</h5>
                                                <p class="card-text text-center">
                                                    Integrity and honor are solid foundations of human
                                                    relationships (credibility and trustworthiness)
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <h3 class="text-blue">PRINCIPLES</h3>
                                <!-- list of numbers -->
                                <ol class="">
                                    <li class="text-decoration-none list-unstyled mb-3">
                                        <span class="fw-bold">Quality</span> - refers to our love
                                        for God and love for others; this shall be evident in
                                        everything that we at BCA do, and this shall be our way of
                                        life. Everything thing we do, speak and think shall express
                                        this quality.
                                    </li>
                                    <li class="text-decoration-none list-unstyled mb-3">
                                        <span class="fw-bold">Inclusiveness</span> - means
                                        penetration and reach to all kinds of learners; also means
                                        accessibility of possible learners in terms of
                                        affordability, non-discrimination and acceptance of all
                                        races, creed, sex, impairment, disabilities and age groups.
                                        This refers to the Academy’s capability and capacity to
                                        educate beyond the four walls of the school in encouraging
                                        everyone to discover God’s plan and purpose for them through
                                        all forms of life-long learning.
                                    </li>
                                    <li class="text-decoration-none list-unstyled mb-3">
                                        <span class="fw-bold">Outcome-Based</span> - refers to
                                        Spady’s OBE four principles, namely, clarity of focus,
                                        designing down (or begin with the end in view always
                                        remembering what really matters in the end), high
                                        expectation (or putting challenging standards of learning
                                        performance, and expanded learning opportunities
                                    </li>
                                    <li class="text-decoration-none list-unstyled mb-3">
                                        <span class="fw-bold">Ownership</span>
                                        - means the shared and collective responsibility for the
                                        objectives of BCA; also refers to the genuine concern for
                                        the learners’ outcome, the other stakeholder around the
                                        learner who could facilitate more learning, and joint effort
                                        to ensure the integrity, relevance and efficacy of the
                                        learning process and inputs
                                    </li>
                                </ol>
                            </div>
                        @endif
                    </div>

                </div>
                <div class="col-md-4 c-d-sm-none">
                    @include('BCA.Frontend.layouts._side-nav')
                </div>
            </div>


        </div>
    </section>
@endsection
