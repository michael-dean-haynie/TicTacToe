@extends('master-layout')

@section('title')
	@parent :: Auth
@stop

@section('content')
	<p>This paragraph came from auth/auth.blade.php</p>
@stop