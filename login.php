<?php 

require('config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="id-edge">
	<title>Connexion</title>
</head>
<body>
	<h1>Se connecter</h1>
	<p>
<a href="https://accounts.google.com/o/oauth2/v2/auth?scope=email&access_type=online&state=state_parameter_passthrough_value&redirect_uri=<?= urlencode("http://localhost:8888/sdk/connect.php")?>&response_type=code&client_id=<?= GOOGLE_ID ?>">Se connecter à Google</a>
	</p>
</body>
</html>