<?php
	session_start();
?>

<html> 
<head>
	<title> Jeopardy Game Play</title>

	<!-- CSS linking -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<link href="./jeopardy.css" rel="stylesheet" type="text/css">
</head>
<body>
	<!-- Create a Header with links for login. -->
	<div id = "body_header_main">
			<div style="background-color: black">
                <h1 class="center" id="h1">
                    Jeopardy
                </h1>
            </div>
            <div>
                <div class="topnav">
                    <a  href="./index.php">Home</a>
                    <a href="./restartGame.php">Restart Game</a>
                    <a class="active" href="./leaderboard.php">Leaderboard </a>
                    <a href="./about.html">About</a>
                    <?php if(!isset($_COOKIE["user_name"])) { ?>
					<a href="./login.html" style="float:right"> Login </a>
                    <?php }else { ?>
                        <a style="float:right" href = "./logout.php"> <?php echo $_COOKIE["user_name"]; ?></a>
                        <?php } ?>
                    
                </div>

			</div>
	</div>


	<!-- Create a division to show the user score. -->
	<!-- Create a continer for the game cards. -->
	<!-- Create animations and styling for the cards. -->

</body>
</html>