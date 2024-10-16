<!doctype html>
<html>
<head>
		<title>Skohn</title>
		<meta charset="utf-8">
		<!-- Dark mode Bulma css -->
		<!-- <link rel="stylesheet" href="./css/bulma.min.css"> -->
		<!-- Light mode Bulma css -->
		<link rel="stylesheet" href="./css/bulma-no-dark-mode.min.css">
		<!-- <link rel="stylesheet" href="./css/skohn.css"> -->
</head>

<body>
		<?php
			session_start();

			// Variabili per i messaggi di errore
			$registerError = '';
			$loginError = '';
	 
			// Gestione dell'errore per username
			if (isset($_SESSION['registerError'])) {
				$registerError = htmlspecialchars($_SESSION['registerError']);
				unset($_SESSION['registerError']); // Cancella l'errore dopo averlo usato
			}
			if (isset($_SESSION['credentialError'])) {
				$loginError = htmlspecialchars($_SESSION['credentialError']);
				unset($_SESSION['credentialError']); // Cancella l'errore dopo averlo usato
			}


		?>
		<div class="container">
				<div class="columns">
						<div class="column">
								<div class="notification is-magenta">
										<form id="login-form" method="post" target="_self" action="./php/login.php">
												<input id="login-mail" class="" name="mail" type="text" placeholder="Username or mail">
												<input id="login-psw" class="" name="psw" type="password" placeholder="Password">
												<button class="">Log in</button>
										</form>
								</div>
                				<div id="credential-error">
								<?php 
                        			// Stampa gli errori di registrazione
                        			if (!empty($loginError)) {
                            			echo "<p style='color: red;'>$loginError</p>";
                        			}
                    			?>
                				</div>
						</div>

						<!-- <div class="column is-green"></div> -->
						<div class="column">
								<div class="notification is-cyan">
										<form id="register-form" method="post" target="_self" action="./php/register.php">
												<input id="register-username" class="" name="username" type="text" placeholder="Username">
												<input id="register-mail" class="" name="mail" type="mail" placeholder="Mail">
												<input id="register-psw" class="" name="password" type="password" placeholder="Password">
												<button class="">Register</button>
										</form>
								</div>
								<div id="password-check" >
									<p>The password has to include: <br></p>
									<p id="uppercase-check">Please enter at least one uppercase character</p>
									<p id="number-check">Please enter at least one number </p>
									<p id="character-check">Please enter at least one special character(!@#$%^&*(),.?":{}|<>)</p>
								</div>
								<div id="register-credential-error" >
								<?php 
                        			// Stampa gli errori di registrazione
                        			if (!empty($registerError)) {
                            			echo "<p style='color: red;'>$registerError</p>";
                        			}
                    			?>
								</div>
						</div>
						
				</div>
				

		</div>
    <script src="./javascript/index.js" ></script>
</body>
</html>