<?php

include('../includes/header.php'); 

$id_noticia = (int)descriptografa($_GET['id']);

// FAZ A CONSULTA NOS DADOS DA NOTICIA
$query_detalhes_noticia = "SELECT * FROM tab_noticias WHERE id_noticia = '$id_noticia'";
$resultado_detalhes_noticia = executa_query($query_detalhes_noticia);
$dados = $resultado_detalhes_noticia->dados[0];

// if (!$dados->situacao_noticia) {
//   echo "<meta HTTP-EQUIV='Refresh' CONTENT='0;URL=../home'>";
//   exit;
// }

// FAZ A ATUALIZAÇÃO NO CONTADOR DE VISITA NA NOTICIA
$visitas = ((int)$dados->visitas_noticia + 1); //Incrementa o contador a cada Visita na Página
$query_visitas = "UPDATE tab_noticias SET visitas_noticia = '$visitas' WHERE id_noticia = '$id_noticia'";

$update = executa_query($query_visitas);
?>  


<div id="banner-area" class="banner-area">
	<div class="banner-text">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<div class="banner-heading">
						<h1 class="banner-title">NOTÍCIAS</h1>
						<ol class="breadcrumb">
							<li><a href="../home/">Home</a></li>
							<li><a href="../noticias/">Notícias</a></li>
							<li>Notícia</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>





<section id="main-container" class="main-container">
	<div class="container">
		<div class="row">

      <div class="col-md-5">
        <img class="img-responsive border-ccc mb-sm" src="<?= !empty(trim($dados->foto_noticia)) ? $link_padrao_fotos.$dados->foto_noticia : $sem_img ?>" alt="Foto Notícia">

				<i class="fa fa-calendar-o mr-sm"></i>
				<span class="font-16px red-template text-weight-600">
					<?php
						$DIA = date('d', strtotime($dados->data_noticia));
						$MES = nome_mes(date('m', strtotime($dados->data_noticia)));
						$ANO = date('Y', strtotime($dados->data_noticia));
						
						echo "$DIA de $MES de $ANO";
					?>
				</span>

				<span class="pull-right text-weight-600">
					<i class="fa fa-eye mr-sm"></i><?= (int)$dados->visitas_noticia ?>
				</span>
      </div>

      <div class="col-md-6">
				<h3 class="section-sub-title mb-md nmt">
					<?= mb_strtoupper($dados->titulo_noticia, 'UTF-8'); ?>
				</h3>

				<?= $dados->texto_noticia; ?>
      </div>


		</div>
	</div>
</section>



<?php

include('../includes/parceiros.php');
include('../includes/footer.php');
