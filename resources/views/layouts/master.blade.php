<!DOCTYPE html>
<html>
<head>
	<title>
		@section('title')
			TicTacToe
		@show
	</title>

	<!-- jQuery -->
	<script src="/js/jquery-3.1.1.min.js"></script>

	<!-- Custom Scripts -->
	<script src="/js/tictactoe.js"></script>

</head>
<body>
	@yield('content')
	<?php echo "<pre>" . print_r(\CustomAuth::getUser(), true) . "</pre>"; ?>
</body>
</html>