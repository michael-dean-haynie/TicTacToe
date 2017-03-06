@extends("layouts/master")

@section('title')
	@parent :: Play Online
@stop

@section('content')
	<p>Quick Match</p>
	<button onclick="readyUp();">Ready</button>
	<button onclick="un_readyUp();">Cancel</button>
@stop