@extends('layouts/master')

@section('title')
	@parent :: Auth
@stop

@section('content')
	@include('includes/errors')

	<p>Login With Full Account</p>
	<form method='POST' action='/auth/login'>
		<p>
			<label for='email'>Email</label>
			<input id='email' type='email' name='email' value="{{old('email')}}">
		</p>

		<p>
			<label for='password'>Password</label>
			<input id='password' type='password' name='password'>
		</p>

		<p>
			<input type='submit' value='Submit'>
			{{ csrf_field() }}
		</p>
	</form>

	<p>Create Anonymous Account</p>
	<form method='POST' action='/auth'>
		<p>
			<label for='simple-username'>Username</label>
			<input id='simple-username' type='text' name='simple-username' value="{{old('simple-username')}}" required maxlength='255'>
		</p>

		<p>
			<input type='submit' value='Submit'>
			<input type='hidden' name='user-type' value='simple'>
			{{ csrf_field() }}
		</p>
	</form>
@stop