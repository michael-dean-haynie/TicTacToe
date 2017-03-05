@extends('layouts/master')

@section('title')
	@parent :: Auth
@stop

@section('content')
	@include('includes/errors')

	<p>Create Full Account</p>
	<form method='POST' action='/auth'>
		<p>
			<label for='authed-username'>Username</label>
			<input id='authed-username' type='text' name='authed-username' value="{{old('authed-username')}}" required maxlength='255'>
		</p>

		<p>
			<label for='authed-email'>Email</label>
			<input id='authed-email' type='email' name='authed-email' value="{{old('authed-email')}}" required maxlength='255'>
		</p>

		<p>
			<label for='authed-password'>Password</label>
			<input id='authed-password' type='password' name='authed-password' required maxlength='255' minlength='6'>
		</p>

		<p>
			<label for='authed-confirm-password'>Confirm Password</label>
			<input id='authed-confirm-password' type='password' name='authed-confirm-password' required maxlength='255' minlenght='6'>
		</p>

		<p>
			<input type='submit' value='Submit'>
			<input type='hidden' name='user-type' value='authed'>
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