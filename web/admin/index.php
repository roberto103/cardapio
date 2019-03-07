<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Login</title>

	<!-- CSS customizado -->
	<link rel="stylesheet" type="text/css" href="../includes/css/signin.css">
</head>

<body>

	<form class="box">
		<h1>Login</h1>

		<input type="text" id="txtEmail" placeholder="Email" required>
		<input type="password" id="txtSenha" placeholder="Senha" required>

		<span class="alert" style="color: red; display: none;">Email ou senha incorretos!</span>

		<button id="btLogin" type="submit">Login</button>
	</form>


	<script src="../vendor/jquery.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('#btLogin').click(function(){

				var email = $("#txtEmail").val();
				var senha = $("#txtSenha").val();
				
				$.ajax({
					url: "../../api/estabelecimentos/login.php",
					type: 'post',
					data: {
						usuario: email,
						senha: senha
					},
					success: function(data){
						if (data == 1) {
							window.location = 'dashboard.php';
						} else {
							$('.alert').css('display', 'block');
						} 
					} //success          
				}); //ajax
				return false;
			}); //#btLogin
		}); //documento.ready
	</script>

</body>
</html>
