<h6 class="job-title">{{ $timesheet->job->job }}</h6>
<p><small class="indigo-text">Hourly Rate: USD {{ $timesheet->job->hourly_rate }}</small></p>
<p><strong>Time In: </strong>{{ $timesheet->clock_in }}</p>
<p><strong>Time Out: </strong>{{ $timesheet->clock_out }}</p>

<div class="row">
	<div class="col s12">
		<button type="button" class="btn waves-effect red darken-4 modal-trigger delete-btn" href="#deleteLogModal"><i class="material-icons">delete_forever</i> Delete Log</button>
		<div class="modal" id="deleteLogModal">
			<div id="deleteModalContent" class="modal-content">
				<form action="/timesheet/delete/{{ $timesheet->id }}" method="POST">
					{{ csrf_field() }}
					{{ method_field('delete') }}
					<p>Are your sure you want to delete this log?</p>
					<p><small><span class="orange-text">Warning:</span> Related payout, if there's any, will be deleted, too.</small></p>
					<input hidden name="timesheet_id" value="{{ $timesheet->id }}">
					<button type="submit" class="btn waves-effect red darken-4">Yes</button>
					<button type="button" class="btn waves-effect teal lighten-3 modal-close">No</button>
				</form>
			</div>
			<div class="modal-footer">
				<a href="#!" class="modal-close waves-effect waves-green btn-flat">Cancel</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$('.modal').modal();
	});
</script>

