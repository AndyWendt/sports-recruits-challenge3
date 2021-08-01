<h1>Teams distribution</h1>

@if($teams->isNotEmpty())
	@foreach($teams as $team)
		<h2>{{ $team->name() }}</h2>
		<h3>Average: {{ $team->averagePlayerRanking() }}</h3>
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
					<tr style="{{ $player->isGoalie ? 'font-weight:bold;' : '' }}">
						<td>
							{{ $loop->iteration }}
						</td>
						<td>
							{{ $player->fullname }}
						</td>
						<td>
							{{ $player->isGoalie ? 'Yes' : 'No' }}
						</td>
						<td>
							{{ $player->ranking }}
						</td>
					</tr>
				@endforeach
			</tbody>
			<tfoot>
				<tr>
					<th colspan="3"></th>
					<th style="text-align:left;">{{ $team->ranking() }}</th>
				</tr>
			</tfoot>
		</table>
		<hr/>
	@endforeach
@endif
