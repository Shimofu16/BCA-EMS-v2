<div class="modal fade" id="edit{{ $event->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="exampleModalLongTitle">Edit</h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.manage.events.update', $event->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="font-weight-bold" for="title">Title <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" type="text" name="title" id="title"
                                value="{{ $event->title }}">
                        </div>
                    </div>
                    <div class="row mb-3">

                        @php
                            $start = \Carbon\Carbon::parse(date('Y-m-d', strtotime($event->start)));
                            $end = \Carbon\Carbon::parse(date('Y-m-d', strtotime($event->end)));
                            $start->addDay();
                            $end->subDay();
                        @endphp
                        <div class="col-md-6">
                            <label class="font-weight-bold" for="start">Start Date <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" type="date" name="start" id="start"
                                value="{{ date('Y-m-d', strtotime($start)) }}">
                        </div>
                        <div class="col-md-6">
                            <label class="font-weight-bold" for="end">End Date <span
                                    class="text-danger">*</span></label>
                            <input class="form-control" type="date" name="end" id="end"
                                value="{{ date('Y-m-d', strtotime($end)) }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="font-weight-bold" for="time">Event time</label>
                            <input class="form-control" type="time" name="time" id="time"
                                value="{{ $event->time }}">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="font-weight-bold" for="color">Event color</label>
                            <select class="form-control" aria-label="Default select example" name="color"
                                id="color">
                                <option selected value="{{ $event->color }}"
                                    style="background-color: {{ $event->color }}; color: #fff"> Current Color</option>
                                <option value="#58A8CF" style="background-color: #58A8CF">Option 1</option>
                                <option value="#2139dc" style="background-color: #2139dc">Option 2</option>
                                <option value="#5DCF77" style="background-color: #5DCF77">Option 3</option>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button class="btn btn-outline-primary" type="submit">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
