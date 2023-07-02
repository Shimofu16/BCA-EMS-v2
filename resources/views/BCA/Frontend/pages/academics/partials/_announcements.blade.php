@if ($announcements !== null)
    <div class="row mt-3">
        <h3>Related Announcements</h3>
        @foreach ($announcements as $announcement)
            <a href="{{ route('announcement.show', ['id' => $announcement->id]) }}" class="text-decoration-none">
                <div class="card bg-transparent border-0 p-2">
                    <div class="card-header  bg-transparent border-0 p-2">
                        <img class="card-img-top mb-3" src="{{ asset($announcement->path) }}"
                            alt="{{ $announcement->photo }}" style="height: 400px; widows: 100%;">
                    </div>
                    <div class="card-body pt-0">
                        <div class="title mb-3">
                            <h3 class="card-title text-blue">{{ $announcement->title }}</h3>
                            <small class="text-muted"><i class="fa-solid fa-clock"></i> &nbsp; Date:
                                {{ date('F d, Y', strtotime($announcement->created_at)) }}</small>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endif

