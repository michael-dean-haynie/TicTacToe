<!DOCTYPE html>
<html>
<head>
	<title>
		@section('title')
			TicTacToe
		@show
	</title>
</head>
<body>
	<p>This paragraph comes from master-layout.blade.php</p>
	@yield('content')
</body>
</html>