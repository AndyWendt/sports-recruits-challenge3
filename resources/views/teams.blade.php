<h1>Teams distribution</h1>

@if($teams->isNotEmpty())
	@foreach($teams as $team)
		<h2>{{ $team->name() }}</h2>
		<h3>Average: {{ $team->average() }}</h3>
		<br/>
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>Player name</th>
					<th>Goalie</th>
					<th>Ranking</th>
				</tr>
			</thead>
			<tbody>
				@foreach($team->players() as $player)
					<tr style="{{ $player->get('isGoalie') ? 'font-weight:bold;' : '' }}">
						<td>
							{{ $loop->iteration }}
						</td>
						<td>
							{{ $player->get('fullname') }}
						</td>
						<td>
							{{ $player->get('isGoalie') ? 'Yes' : 'No' }}
						</td>
						<td>
							{{ $player->get('ranking') }}
						</td>
					</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th colspan="3"></th>
					<th style="text-align:left;">{{ $team->sum() }}</th>
				</tr>
			</tfoot>
		</table>
		<hr/>
	@endforeach
@endif
