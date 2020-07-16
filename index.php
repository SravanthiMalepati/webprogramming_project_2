<?php
	session_start();
	if(!isset($_COOKIE["player1Score"])){
        setcookie("player1Score","0",time()+ 31536000);
    }
    if(!isset($_COOKIE["player2Score"])){
        setcookie("player2Score","0",time()+ 31536000);
    }
    $player1Score = $_COOKIE["player1Score"];
	$player2Score = $_COOKIE["player2Score"];
	if(!isset($_COOKIE["questionCount"])){
		setcookie("questionCount", 0, time()+31536000);
	}
	if(!isset($_COOKIE["player1turn"])){
		$player1turn = TRUE;
		setcookie("player1turn", TRUE, time() + 31536000);
		setcookie("player2turn", FALSE, time() + 31536000);
	}
	$questionCount = $_COOKIE["questionCount"];
	$player1turn = $_COOKIE["player1turn"];
	if(isset($_POST["answerButton"])){
		setcookie("questionCount", ((int)$_COOKIE["questionCount"] + (int)1), time() + 31536000);
		$questionCount = $_COOKIE["questionCount"];
		if($_POST["correctAnswer"] == $_POST["selectedAnswer"]){
			$player1Score = $_COOKIE["player1Score"];
			if($_COOKIE["player1turn"] == TRUE){
				$_COOKIE["player1Score"] = ((int)$_COOKIE["player1Score"] + (int)$_POST["questionScore"]);
				$player1Score = $_COOKIE["player1Score"];
				setCookie("player1Score", $player1Score, time()+ 31536000);
			}else{
				$_COOKIE["player2Score"] = ((int)$_COOKIE["player2Score"] + (int)$_POST["questionScore"]);
				$player2Score = $_COOKIE["player2Score"];
				setCookie("player2Score", $player2Score, time()+ 31536000);
			}
		}else{
			if($player1turn){
				$player1turn = FALSE;
				setcookie("player1turn", FALSE, time() + 31536000);
				setcookie("player2turn", TRUE, time() + 31536000);
			}else{
				$player1turn = TRUE;
				setcookie("player1turn", TRUE, time() + 31536000);
				setcookie("player1turn", FALSE, time() + 31536000);
			}
		}
	}
	if((int)$questionCount== 25){
		if((int)$player1Score > (int)$player2Score){
			header("location: player1.html");
		}else{
			header("location: player2.html");
		}
	}
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
                    <a class="active" href="#home">Home</a>
                    <a href="./restartGame.php">Restart Game</a>
                    <a href="./leaderboard.php">Leaderboard </a>
                    <a href="./about.html">About</a>
                    <?php if(!isset($_COOKIE["user_name"])) { ?>
					<a href="./login.html" style="float:right"> Login </a>
					<!-- <a href="./userSignup.html" style="float: right" data-toggle="tooltip" title="Logout"> Signup </a> -->
                    <?php }else { ?>
                        <a style="float:right" href = "./logout.php"> <?php echo $_COOKIE["user_name"]; ?></a>
                        <?php } ?>
                    
                </div>

			</div>
	</div>

	<div id = "score_container_main">
		<div>
			<?php if($player1turn){ ?>
				<div style="float:left; width: 50%;text-align: center;font-size: 35px;background: lightblue;"><img src="./test.png" width="50px" height = "50px"/>Player 1</div>
				<div style="float:right; width: 50%; text-align: center;font-size: 35px"><img src="./test.png" width="50px" height = "50px"/><?php if(isset($_COOKIE["user_name"])){ echo $_COOKIE["user_name"];} else{ echo "Player 2";}?></div>
			<?php }else{ ?>
				<div style="float:left; width: 50%;text-align: center;font-size: 35px;"><img src="./test.png" width="50px" height = "50px"/>Player 1</div>
				<div style="float:right; width: 50%; text-align: center;font-size: 35px;background: lightblue;"><img src="./test.png" width="50px" height = "50px"/><?php if(isset($_COOKIE["user_name"])){ echo $_COOKIE["user_name"];} else{ echo "Player 2";}?></div>
			<?php } ?>
			
		</div>
		<div>
			<?php if($player1turn){ ?>
				<div style="float:left; width: 50%;text-align: center;font-size: 30px;background: lightblue;"><?php if(isset($_COOKIE["player1Score"])){ echo $player1Score; }else{ echo 0;} ?></div>
				<div style="float:right; width: 50%; text-align: center;font-size: 30px;"><?php if(isset($_COOKIE["player2Score"])){ echo $player2Score; }else{ echo 0;} ?></div>
				<?php }else{ ?>
					<div style="float:left; width: 50%;text-align: center;font-size: 30px;"><?php if(isset($_COOKIE["player1Score"])){ echo $player1Score; }else{ echo 0;} ?></div>
				<div style="float:right; width: 50%; text-align: center;font-size: 30px;background: lightblue;"><?php if(isset($_COOKIE["player2Score"])){ echo $player2Score; }else{ echo 0;} ?></div>
					<?php } ?>
			
			
		</div>
	</div>
	<br/>
	<form action="questionPage.php" method="post">
	<div id = "game_cards_container">

		<div class = "row questionRow" style="height: 80px">
			<div class = "col-sm categoryHeader" style = "padding: 5px"> <div style = "line-height: 70px; background-image: url('buttonbackground.jpg');font-size:25px;font-family:'Comic Sans';"><b><i>Dengue</i></b></div></div>

			<div class = "col-sm categoryHeader" style = "padding: 5px"> <div style = "line-height: 70px; background-image: url('buttonbackground.jpg');font-size:25px;font-family:'Comic Sans';"><b><i>Malaria</i></b></div></div>
			
			<div class = "col-sm categoryHeader" style = "padding: 5px"> <div style = "line-height: 70px; background-image: url('buttonbackground.jpg');font-size:25px;font-family:'Comic Sans';"><b><i>Chicken Pox</i></b></div></div>
			
			<div class = "col-sm categoryHeader" style = "padding: 5px"> <div style = "line-height: 70px; background-image: url('buttonbackground.jpg');font-size:25px;font-family:'Comic Sans';"><b><i>Polio</i></b></div></div>
			
			<div class = "col-sm categoryHeader" style = "padding: 5px"> <div style = "line-height: 70px; background-image: url('buttonbackground.jpg');font-size:25px;font-family:'Comic Sans';"><b><i>Cancer</i></b></div></div>

		</div>

		<div class = "row questionRow">

		<?php if(($_COOKIE["firstfirst"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "firstfirst" style="width: 100%; height: 100%;" disabled >$10</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "firstfirst" style="width: 100%; height: 100%;" >$10</button></div>
		<?php } ?>

		<?php if(($_COOKIE["firstsecond"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "firstsecond" style="width: 100%; height: 100%;" disabled >$10</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "firstsecond" style="width: 100%; height: 100%;" >$10</button></div>
		<?php } ?>
			
		<?php if(($_COOKIE["firstthird"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "firstthird" style="width: 100%; height: 100%;" disabled >$10</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "firstthird" style="width: 100%; height: 100%;" >$10</button></div>
		<?php } ?>
			
		<?php if(($_COOKIE["firstfourth"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "firstfourth" style="width: 100%; height: 100%;" disabled >$10</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "firstfourth" style="width: 100%; height: 100%;" >$10</button></div>
		<?php } ?>
			
		<?php if(($_COOKIE["firstfifth"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "firstfifth" style="width: 100%; height: 100%;" disabled >$10</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "firstfifth" style="width: 100%; height: 100%;" >$10</button></div>
		<?php } ?>

		</div>

		<div class = "row questionRow">
		<?php if(($_COOKIE["secondfirst"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "secondfirst" style="width: 100%; height: 100%;" disabled >$20</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "secondfirst" style="width: 100%; height: 100%;" >$20</button></div>
		<?php } ?>

		<?php if(($_COOKIE["secondsecond"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "secondsecond" style="width: 100%; height: 100%;" disabled >$20</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "secondsecond" style="width: 100%; height: 100%;" >$20</button></div>
		<?php } ?>
			
		<?php if(($_COOKIE["secondthird"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "secondthird" style="width: 100%; height: 100%;" disabled >$20</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "secondthird" style="width: 100%; height: 100%;" >$20</button></div>
		<?php } ?>
			
		<?php if(($_COOKIE["secondfourth"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "secondfourth" style="width: 100%; height: 100%;" disabled >$20</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "secondfourth" style="width: 100%; height: 100%;" >$20</button></div>
		<?php } ?>
			
		<?php if(($_COOKIE["secondfifth"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "secondfifth" style="width: 100%; height: 100%;" disabled >$20</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "secondfifth" style="width: 100%; height: 100%;" >$20</button></div>
		<?php } ?>

		</div>

		<div class = "row questionRow">
		<?php if(($_COOKIE["thirdfirst"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "thirdfirst" style="width: 100%; height: 100%;" disabled >$30</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "thirdfirst" style="width: 100%; height: 100%;" >$30</button></div>
		<?php } ?>

		<?php if(($_COOKIE["thirdsecond"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "thirdsecond" style="width: 100%; height: 100%;" disabled >$30</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "thirdsecond" style="width: 100%; height: 100%;" >$30</button></div>
		<?php } ?>
			
		<?php if(($_COOKIE["thirdthird"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "thirdthird" style="width: 100%; height: 100%;" disabled >$30</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "thirdthird" style="width: 100%; height: 100%;" >$30</button></div>
		<?php } ?>
			
		<?php if(($_COOKIE["thirdfourth"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "thirdfourth" style="width: 100%; height: 100%;" disabled >$30</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "thirdfourth" style="width: 100%; height: 100%;" >$30</button></div>
		<?php } ?>
			
		<?php if(($_COOKIE["thirdfifth"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "thirdfifth" style="width: 100%; height: 100%;" disabled >$30</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "thirdfifth" style="width: 100%; height: 100%;" >$30</button></div>
		<?php } ?>

		</div>

		<div class = "row questionRow">
		<?php if(($_COOKIE["fourthfirst"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "fourthfirst" style="width: 100%; height: 100%;" disabled >$40</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "fourthfirst" style="width: 100%; height: 100%;" >$40</button></div>
		<?php } ?>

		<?php if(($_COOKIE["fourthsecond"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "fourthsecond" style="width: 100%; height: 100%;" disabled >$40</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "fourthsecond" style="width: 100%; height: 100%;" >$40</button></div>
		<?php } ?>
			
		<?php if(($_COOKIE["fourththird"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "fourththird" style="width: 100%; height: 100%;" disabled >$40</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "fourththird" style="width: 100%; height: 100%;" >$40</button></div>
		<?php } ?>
			
		<?php if(($_COOKIE["fourthfourth"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "fourthfourth" style="width: 100%; height: 100%;" disabled >$40</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "fourthfourth" style="width: 100%; height: 100%;" >$40</button></div>
		<?php } ?>
			
		<?php if(($_COOKIE["fourthfifth"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "fourthfifth" style="width: 100%; height: 100%;" disabled >$40</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "fourthfifth" style="width: 100%; height: 100%;" >$40</button></div>
		<?php } ?>

		</div>

		<div class = "row questionRow">
		<?php if(($_COOKIE["fifthfirst"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "fifthfirst" style="width: 100%; height: 100%;" disabled >$50</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "fifthfirst" style="width: 100%; height: 100%;" >$50</button></div>
		<?php } ?>

		<?php if(($_COOKIE["fifthsecond"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "fifthsecond" style="width: 100%; height: 100%;" disabled >$50</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "fifthsecond" style="width: 100%; height: 100%;" >$50</button></div>
		<?php } ?>
			
		<?php if(($_COOKIE["fifththird"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "fifththird" style="width: 100%; height: 100%;" disabled >$50</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "fifththird" style="width: 100%; height: 100%;" >$50</button></div>
		<?php } ?>
			
		<?php if(($_COOKIE["fifthfourth"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "fifthfourth" style="width: 100%; height: 100%;" disabled >$50</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "fifthfourth" style="width: 100%; height: 100%;" >$50</button></div>
		<?php } ?>
			
		<?php if(($_COOKIE["fifthfifth"])){ ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "fifthfifth" style="width: 100%; height: 100%;" disabled >$50</button></div>
			<?php }else { ?>
				<div class = "col-sm questionbutton"><button type="submit" name = "fifthfifth" style="width: 100%; height: 100%;" >$50</button></div>
		<?php } ?>

		</div>

	</div>





	<!-- Create a division to show the user score. -->
	<!-- Create a continer for the game cards. -->
	<!-- Create animations and styling for the cards. -->

</body>
</html>