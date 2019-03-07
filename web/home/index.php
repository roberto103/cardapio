<?php 

	require_once '../../api/core/Config.php';
	require_once '../../api/core/Tabela.class.php';
	require_once '../../api/estabelecimentos/select.php';

 ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Cardápio On</title>

	<!-- CSS -->
	<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="../includes/css/style.css">
</head>
<body class="load">

	<div class="page-wrapper">
		<?php include_once '../includes/php/topo.php'; ?>

		<main class="main p-5">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">

						<!-- Filtro -->
						<nav class="toolbox">
							<div class="toolbox-left">
								<div class="toolbox-item toolbox-sort">
									<div class="select-custom">
										<select name="orderby" class="form-control">
											<option value="menu_order" selected="selected">Ordem padrão</option>
											<option value="popularity">Ordenar por popularidade</option>
											<option value="rating">Ordenar por classificação média</option>
											<option value="price">Ordenar por preço: baixo para alto</option>
											<option value="price-desc">Ordenar por preço: alto para baixo</option>
										</select>
									</div>

									<a href="#" class="sorter-btn" title="Set Ascending Direction"><span class="sr-only">Set Ascending Direction</span></a>
								</div>
							</div>

							<div class="toolbox-item toolbox-show">
								<label>Mostrando 1–9 de 60 resultados</label>
							</div>
						</nav>
						<!-- /Filtro -->

						<!-- Estabelecimentos -->
						<?php foreach ($registrosEstabelecimento as $estabelecimento): ?>
							<div class="product product-list-wrapper">
								<figure class="product-image-container">
									<a href="product.html" class="product-image">
										<img src="../includes/imgs/product-1.jpg" alt="product">
									</a>
									<a href="ajax/product-quick-view.html" class="btn-quickview">Ver detalhes do estabelecimentos</a>
								</figure>

								<!-- Detalhes do Estabelecimento -->
								<div class="product-details">
									<h2 class="product-title">
										<a href="product.html" style="text-transform: uppercase;">
											<?php echo $estabelecimento->nome_estabelecimento; ?>
										</a>

										<span class="d-block" style="font-size: 14px; margin-top: 5px; text-transform: capitalize;">
											<?php echo $estabelecimento->bairro; ?> - <?php echo $estabelecimento->cidade; ?>
										</span>
									</h2>
									<div class="ratings-container">
										<div class="product-ratings">
											<span class="ratings" style="width:98%"></span>
										</div>
									</div>

									<!-- Descrição do estabelecimento -->
									<div class="product-desc">
										<p>
											Localizado na rua: <?php echo $estabelecimento->rua; ?><br>
											Tipo do restaurante: <?php echo $estabelecimento->tipo_restaurante; ?><br>
											Proprietario: <?php echo $estabelecimento->nome_proprietario; ?>
										</p>
									</div>

									<div class="product-action">
										<a href="product.html" class="btn btn-outline-primary btn-lg mb-1" style="border-radius: 20px;">
											<span>Mostrar mais detalhes</span>
										</a>

										<a href="#modal" class="btn btn-outline-success btn-lg mb-1" style="border-radius: 20px;">
											<span>Ver telefone</span>
										</a>
									</div>
								</div>
								<!-- /Detalhes do Estabelecimento -->
							</div>
						<?php endforeach ?>
						<!-- /Estabelecimentos -->

					</div>
				</div>
			</div>
		</main>

		<?php include_once '../includes/php/rodape.php'; ?>
	</div>

	<!-- Plugins JS File -->
	<script src="../vendor/jquery.min.js"></script>
	<!-- Main JS File -->
	<script src="../includes/js/main.min.js"></script>

</body>
</html>