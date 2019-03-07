<!DOCTYPE html>
<html>
<head>
	<title>Teste</title>

	<style type="text/css">
		.nome {
			font-size: 22px;
			font-weight: bold;
			font-family: cursive;
		} 

		

/* CARREGADOR ----------------------------------------------- */
		.mask-carregando {
			position: absolute;
			top: 0px;
			left: 0px;
			z-index: 9999;
			background-color: #000;
			opacity: 0.9;
			width: 100%;
			height: 100%;
			color: #fff;
			text-align: center;
		}		
		#outer {
		    position:absolute;
		    top:0;
		    left:0;
		    width:100%;
		    height:100%;
		}

		#table-container {
		    height:100%;
		    width:100%;
		    display:table;
		}

		#table-cell {
		    vertical-align:middle;
		    height:100%;
		    display:table-cell;
		    border:1px solid #000;
		}
/*---------------------------------------------------*
	</style>
</head>
<body>
	<!-- CARREGADOR ----------------------------------------->
	<div id="outer" class="mask-carregando">
	    <div id="table-container">
	        <div id="table-cell">
	            Carregando...
	        </div>
	    </div>
	</div>
	<!-- FIM CARREGADOR ------------------------------------->

	<div id="listagem">
		
	</div>

	<script src="../vendor/jquery.min.js"></script>
	<script type="text/javascript">
		$.ajax({ 
		    type: 'GET', 
		    url: '../../api/estabelecimentos/select.php', 
		    dataType: 'json',
		    beforeSend: function() {//Evento antes de disparar o ajax
		    	//exibe tela de carregando
		    	$('.mask-carregando').show();
		    },
		    success: function (resultado) {//Evento ao concluir con sucesso o ajax
		       
		        setTimeout(function() {// essa função coloquei só pra esperar um segundo PODE RETIRAR ESSA LINHA

		        	$.each(resultado, function(index, elemento) {
			            //adiciona um novo elemento à div de listagem
			            $('#listagem').append(
			            	"<div class='nome'>"+elemento.nome_estabelecimento+"</div>"
			            );
			        });

			        $('.mask-carregando').hide(); //esconde tela de carregando

		        }, 1000); // PODE RETIRAR ESSA LINHA
		        
		    }
		});
	</script>
</body>
</html>