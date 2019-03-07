<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Cadastro</title>

	<!-- CSS do Bootstrap -->
	<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
	<!-- CSS customizado -->
	<link rel="stylesheet" type="text/css" href="../includes/css/signup.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<div class="col-sm-2"></div>
			<div class="col-sm-8">
				<h4 class="mb-3">Cadastre seu estabelecimento</h4>

				<form method="POST">
					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="primeiroNome">Nome</label>
							<input type="text" class="form-control" id="primeiroNome" placeholder="" value="" required>
						</div>
						<div class="col-md-6 mb-3">
							<label for="sobrenome">Sobrenome</label>
							<input type="text" class="form-control" id="sobrenome" placeholder="" value="" required>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="estabelecimento">Estabelecimento</label>
							<div class="input-group">
								<input type="text" class="form-control" id="estabelecimento" placeholder="Nome do seu estabelecimento" required>
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="tipo_estabelecimento">Tipo de estabelecimento</label>
							<select class="custom-select d-block w-100" id="tipo_estabelecimento" required>
								<option value="">Escolha...</option>
								<option value="Churrascaria">Churrascaria</option>
								<option value="Pizzaria">Pizzaria</option>
							</select>
						</div>
					</div>

					<div class="row">
						<div class="col-md-8 mb-3">
							<label for="email">Email</label>
							<input type="email" class="form-control" id="email" placeholder="fulano@exemplo.com" required>
						</div>
						<div class="col-md-4 mb-3">
							<label for="telefone">Telefone</label>
							<input type="text" class="form-control phone_with_ddd" id="telefone" placeholder="(00) 0000-0000" required>
						</div>
					</div>

					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="cidade">Cidade</label>
							<input type="text" class="form-control" id="cidade" placeholder="Surubim" required>
						</div>
						<div class="col-md-6 mb-3">
							<label for="bairro">Bairro</label>
							<input type="text" class="form-control" id="bairro" placeholder="São José" required>
						</div>
						<div class="col-md-12 mb-3">
							<label for="rua">Rua</label>
							<input type="text" class="form-control" id="rua" placeholder="Rua 12, nº 0" required>
						</div>
					</div>

					<button class="btn btn-primary btn-lg btn-block" id="btCadastrar" type="submit">Finalizar o cadastro</button>
				</form>

			</div>
		</div>
	</div>

	<script src="../vendor/jquery.min.js"></script>
	<script src="../vendor/jquery.mask.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$('.phone_with_ddd').mask('(00) 0000-0000');

			$('#btCadastrar').click(function(){

				var primeiroNome = $("#primeiroNome").val();
				var sobrenome = $("#sobrenome").val();
				var estabelecimento = $("#estabelecimento").val();
				var tipo_estabelecimento = $("#tipo_estabelecimento").val();
				var email = $("#email").val();
				var telefone = $("#telefone").val();
				var cidade = $("#cidade").val();
				var bairro = $("#bairro").val();
				var rua = $("#rua").val();
				
				$.ajax({
					url : "../../api/estabelecimentos/cadastro.php",
					type : 'post',
					data : {
						primeiroNome: primeiroNome,
						sobrenome: sobrenome,
						estabelecimento: estabelecimento,
						tipo_estabelecimento: tipo_estabelecimento,
						email: email,
						telefone: telefone,
						cidade: cidade,
						bairro: bairro,
						rua: rua
					},
					success : function(data){
						if (data == 1) {
							window.location = 'index.php';
						} else {
							alert('sdsd');
						} 
					} //success          
				}); //ajax
				return false;
			}); //#btLogin
		});
	</script>

</body>
</html>