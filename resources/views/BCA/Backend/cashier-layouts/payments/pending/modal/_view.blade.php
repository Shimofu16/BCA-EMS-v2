<div class="modal fade" id="view{{ $payment->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-light font-weight-bold" id="exampleModalLabel">Payment</h5>
                <button class="close text-white" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body">
                @php
                    switch ($payment->student->grade_level_id) {
                        case 1:
                            $level = 1;
                            break;
                        case 2:
                            $level = 1;
                            break;
                        case 3:
                            $level = 2;
                            break;
                        case 4:
                            $level = 3;
                            break;
                        case 5:
                            $level = 4;
                            break;
                        case 6:
                            $level = 4;
                            break;
                        case 7:
                            $level = 4;
                            break;
                        case 8:
                            $level = 5;
                            break;
                        case 9:
                            $level = 5;
                            break;
                        case 10:
                            $level = 5;
                            break;
                        case 11:
                            $level = 6;
                            break;
                        case 12:
                            $level = 6;
                            break;
                        case 13:
                            $level = 6;
                            break;
                        case 14:
                            $level = 6;
                            break;
                    }
                    $fees = \App\Models\Annual::where('level_id', '=', $level)
                        ->where('sy_id', '=', $payment->student->sy_id)
                        ->orderBy('fee_type', 'asc')
                        ->get();
                    $total_fee = 0;
                    $sub_total = 0;
                    foreach ($fees as $fee) {
                        $sub_total += $fee->amount;
                    }
                @endphp
                <div class="row border g-3">
                    <div class="col-6">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Title</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($fees as $fee)
                                    <tr>
                                        <td>{{ $fee->title }}</td>
                                        <td>₱ {{ number_format($fee->amount, 2, '.', ',') }}</td>
                                    </tr>
                                @endforeach
                                <tr>
                                    <td></td>
                                    <td>
                                        <span class="font-weight-bold text-right">Total: ₱
                                            {{ number_format($sub_total, 2, '.', ',') }}</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-6">
                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Schedule of Payment</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                @switch ($payment->payment_method)
                                    @case('Annual')
                                        <tr>
                                            <td>
                                                <span class="font-weight-bold">Annual Payment</span>
                                            </td>
                                            <td>
                                                <span class="font-weight-bold">₱
                                                    {{ number_format($sub_total, 2, '.', ',') }}</span>
                                            </td>
                                        </tr>
                                        @php
                                            /* compute annualy */
                                            $total_fee = $sub_total;
                                        @endphp
                                        <tr>
                                            <td>
                                                Enrollment Fee
                                            </td>
                                            <td>
                                                ₱ {{ number_format($total_fee, 2, '.', ',') }}

                                            </td>
                                        </tr>
                                    @break

                                    @case('Semi-Annual')
                                        <tr>
                                            <td>
                                                <span class="font-weight-bold">Semi Annual Payment</span>
                                            </td>
                                            <td>
                                                <span class="font-weight-bold">₱
                                                    {{ number_format($sub_total, 2, '.', ',') }}</span>
                                            </td>
                                        </tr>
                                        @php
                                            $total_fee = $sub_total / 2;
                                        @endphp
                                        <tr>
                                            <td>
                                                Enrollment Fee
                                            </td>
                                            <td>
                                                ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{-- add 6 months  --}}
                                                @php
                                                    $date = \Carbon\Carbon::parse($payment->student->balance->reminder_at);
                                                    $date->toDayDateTimeString();
                                                @endphp
                                                {{ date('F d, Y', strtotime($date)) }}
                                            </td>
                                            <td>
                                                ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                            </td>
                                        </tr>
                                    @break

                                    @case('Quarterly')
                                        <tr>
                                            <td>
                                                <span class="font-weight-bold">Quarterly Payment</span>
                                            </td>
                                            <td>
                                                <span class="font-weight-bold">₱
                                                    {{ number_format($sub_total, 2, '.', ',') }}</span>
                                            </td>
                                        </tr>
                                        @php
                                            $ef = 5500;
                                            $sub_total = $sub_total - $ef;
                                            $total_fee = $sub_total / 4;
                                        @endphp
                                        <tr>
                                            <td>
                                                Enrollment Fee
                                            </td>
                                            <td>
                                                ₱ {{ number_format($ef, 2, '.', ',') }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                {{-- add 4 months  --}}
                                                @php
                                                    $date = \Carbon\Carbon::parse($payment->student->balance->reminder_at);
                                                    $date->toDayDateTimeString();
                                                @endphp
                                                {{ date('F d, Y', strtotime($date)) }}
                                            </td>
                                            <td>
                                                ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{-- add 4 months  --}}
                                                @php
                                                    $date->addMonth(4);
                                                @endphp
                                                {{ date('F d, Y', strtotime($date)) }}
                                            </td>
                                            <td>
                                                ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{-- add 4 months  --}}
                                                @php
                                                    $date->addMonth(4);
                                                @endphp
                                                {{ date('F d, Y', strtotime($date)) }}
                                            </td>
                                            <td>
                                                ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                            </td>
                                        </tr>
                                    @break

                                    @case('Monthly')
                                        <tr>
                                            <td>
                                                <span class="font-weight-bold">Monthly Payment</span>
                                            </td>
                                            <td>
                                                <span class="font-weight-bold">₱
                                                    {{ number_format($sub_total, 2, '.', ',') }}</span>
                                            </td>
                                        </tr>
                                        @php
                                            $ef = 5500;
                                            $sub_total = $sub_total - $ef;
                                            $total_fee = $sub_total / 10;
                                        @endphp
                                        <tr>
                                            <td>
                                                Enrollment Fee
                                            </td>
                                            <td>
                                                ₱ {{ number_format($ef, 2, '.', ',') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{-- add 1 months  --}}
                                                @php
                                                    $date = \Carbon\Carbon::parse($payment->student->balance->reminder_at);
                                                    $date->toDayDateTimeString();
                                                @endphp
                                                {{ date('F d, Y', strtotime($date)) }}
                                            </td>
                                            <td>
                                                ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{-- add 1 months  --}}
                                                @php
                                                    $date->addMonth(1);
                                                @endphp
                                                {{ date('F d, Y', strtotime($date)) }}
                                            </td>
                                            <td>
                                                ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{-- add 1 months  --}}
                                                @php
                                                    $date->addMonth(1);
                                                @endphp
                                                {{ date('F d, Y', strtotime($date)) }}
                                            </td>
                                            <td>
                                                ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{-- add 1 months  --}}
                                                @php
                                                    $date->addMonth(1);
                                                @endphp
                                                {{ date('F d, Y', strtotime($date)) }}
                                            </td>
                                            <td>
                                                ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{-- add 1 months  --}}
                                                @php
                                                    $date->addMonth(1);
                                                @endphp
                                                {{ date('F d, Y', strtotime($date)) }}
                                            </td>
                                            <td>
                                                ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{-- add 1 months  --}}
                                                @php
                                                    $date->addMonth(1);
                                                @endphp
                                                {{ date('F d, Y', strtotime($date)) }}
                                            </td>
                                            <td>
                                                ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{-- add 1 months  --}}
                                                @php
                                                    $date->addMonth(1);
                                                @endphp
                                                {{ date('F d, Y', strtotime($date)) }}
                                            </td>
                                            <td>
                                                ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{-- add 1 months  --}}
                                                @php
                                                    $date->addMonth(1);
                                                @endphp
                                                {{ date('F d, Y', strtotime($date)) }}
                                            </td>
                                            <td>
                                                ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                {{-- add 1 months  --}}
                                                @php
                                                    $date->addMonth(1);
                                                @endphp
                                                {{ date('F d, Y', strtotime($date)) }}
                                            </td>
                                            <td>
                                                ₱ {{ number_format($total_fee, 2, '.', ',') }}
                                            </td>
                                        </tr>
                                    @break

                                    @default
                                @endswitch
                            </tbody>
                        </table>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
