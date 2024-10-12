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
			$registerUsernameError = '';
			$registerMailError = '';
			$loginMailError = '';
			$loginPswError = '';
	 
			// Gestione dell'errore per username
			if (isset($_SESSION['registerUsernameError'])) {
				$registerUsernameError = htmlspecialchars($_SESSION['registerUsernameError']);
				unset($_SESSION['registerUsernameError']); // Cancella l'errore dopo averlo usato
			}
	 
			 // Gestione dell'errore per email
			if (isset($_SESSION['registerMailError'])) {
				$registerMailError = htmlspecialchars($_SESSION['registerMailError']);
				unset($_SESSION['registerMailError']); // Cancella l'errore dopo averlo usato
			}
			if (isset($_SESSION['mailError'])) {
				$loginMailError = htmlspecialchars($_SESSION['mailError']);
				unset($_SESSION['mailError']); // Cancella l'errore dopo averlo usato
			}
			if (isset($_SESSION['pswError'])) {
				$loginPswError = htmlspecialchars($_SESSION['pswError']);
				unset($_SESSION['pswError']); // Cancella l'errore dopo averlo usato
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
                        			if (!empty($loginMailError)) {
                            			echo "<p style='color: red;'>$loginMailError</p>";
                        			}
                        			if (!empty($loginPswError)) {
                            			echo "<p style='color: red;'>$loginPswError</p>";
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
									<p id="character-check">Please enter at least one special character</p>
								</div>
								<div id="register-credential-error" >
								<?php 
                        			// Stampa gli errori di registrazione
                        			if (!empty($registerUsernameError)) {
                            			echo "<p style='color: red;'>$registerUsernameError</p>";
                        			}
                        			if (!empty($registerMailError)) {
                            			echo "<p style='color: red;'>$registerMailError</p>";
                        			}
                    			?>
								</div>
						</div>
						
				</div>
				

		</div>
    <script src="./javascript/index.js" ></script>
</body>
</html>