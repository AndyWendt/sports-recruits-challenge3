<h1>Teams distribution</h1>

@if($teams->isNotEmpty())
	@foreach($teams as $team)
		<h2>{{ $team->get('name') }}</h2>
		<h3>Average: {{ number_format($team->get('average'), 3) }}</h3>
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
				@foreach($team->get('players') as $player)
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
					<th style="text-align:left;">{{ $team->get('rankSum') }}</th>
				</tr>
			</tfoot>
		</table>
		<hr/>
	@endforeach
@endif