<h6 class="job-title">{{ $timesheet->job->job }}</h6>
<p><small class="indigo-text">Hourly Rate: $ {{ $timesheet->job->hourly_rate }}</small></p>
<p><strong>Time In: </strong>{{ $timesheet->clock_in }}</p>
<p><strong>Time Out: </strong>{{ $timesheet->clock_out }}</p>
<hr>
<p><strong>Hours Worked: </strong>{{ number_format($payout->hours, 2, '.', ',') }} ( {{ number_format($minutes, 2, '.', ',') }} minutes )</p>
<p><strong>Wage Earned: $ </strong>{{ number_format($payout->wage, 2, '.', ',') }}</p>
