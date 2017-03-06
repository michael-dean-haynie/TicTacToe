@extends("layouts/master")

@section('title')
	@parent :: Start
@stop

@section('content')
	<ul>
		<li><a href="/play/online/">Play Online</a></li>
		<li><a href="/play/local/">Play Local</a></li>
		<li><a href="/play/against-ai/">Play Against AI</a></li>
		<li><a href="/stats/">Stats</a></li>
	</ul>
@stop