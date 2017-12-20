@extends('layouts.master') @section('content')
<div class='container'>

	@foreach($ilahiler as $ilahi)

	<table class="table table-hover table-border">
		<thead class="table-info">
			<tr>
				<th style='width:65% !important;'>İsim</th>
				<th style='width:10% !important;'>Türü</th>
				<th style='width:10% !important;' class='text-right'>Uzunluk</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<td></td>
			<td></td>
			<td class='text-right'></td>
			<td class='text-right'>
				<div class='mx-auto'>
				</div>
			</td>
			</tr>
		</tbody>
	</table>

	@endforeach

</div>




@endsection @section('footer') @parent @endsection