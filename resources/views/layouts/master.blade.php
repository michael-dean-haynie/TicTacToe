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
	@yield('content')
	<?php echo "<pre>" . print_r(\CustomAuth::getUser(), true) . "</pre>"; ?>
</body>
</html>