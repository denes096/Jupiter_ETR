<html>
	<head>
	</head>
	<body>
		<?php
			session_start();
			session_destroy();
			
			echo "destroyed";
			header("Location: ../Login.php");
		?>
	</body>
</html>