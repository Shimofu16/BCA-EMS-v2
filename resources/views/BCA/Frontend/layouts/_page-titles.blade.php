<div class="d-flex justify-content-between align-items-center flex-nowrap flex-direction-row cd-sm-flex-direction-col my-3">
    <div class="">
        <h3 class="text-blue ">@yield('title')</h3>
    </div>
    <div class="">
        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='currentColor'/%3E%3C/svg%3E&#34;);"
            aria-label="breadcrumb" class="d-flex justify-content-end align-items-center">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item "><a href="{{ route('home.index') }}">Home</a></li>
                @yield('page-title')
                @yield('page-sub-title')
            </ol>
        </nav>
    </div>
</div>
