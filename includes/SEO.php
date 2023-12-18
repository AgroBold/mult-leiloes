<!-- BUSCADORES | TODAS AS PÁGINAS -->
<meta name="description" content="Seleção da Marcha">
<meta name="keywords" content="Seleção da Marcha, AgroBold, Mangalarga Marchador, leilão, leilões, venda, remate, Marcha Picada, Marcha Batida, Marcha de Centro, Potros, Potras, Éguas, Garanhões, Doadoras, Matrizes, Castrados, Cavalos e éguas para Pista, Cavalgada, Poeirão">
<meta name="author" content="Agrobold - Soluções Tecnológicas">
<link rel="canonical" href="https://www.selecaodamarcha.com.br/home/" />
<link rel="next" href="https://www.selecaodamarcha.com.br/home/" />
<meta name="robots" content="index, follow"> 


<?php
/*-----------------------------------------
  SE TIVER NA PAGINA DE DETALHES...
------------------------------------------- */
if( strpos($_SERVER['REQUEST_URI'], "detalhes/") ) {

  $id_lote_header = (int)descriptografa($_GET['lote']);

  $sql =
  " SELECT
      id_animais, foto01_animal, foto_lote_leilao,
      nome_animal, raca, nome_grupo,
      num_lote_leilao, titulo, comentario_animal
    FROM tab_lotes_leiloes
    JOIN tab_animais ON tab_animais.id_animais = tab_lotes_leiloes.id_lote
    JOIN tab_leiloes ON tab_leiloes.ID = tab_lotes_leiloes.id_leilao
    LEFT JOIN tab_grupos ON tab_grupos.id_grupo = tab_lotes_leiloes.tipo_produto_animal
    WHERE (
      id_lote_leilao = '$id_lote_header'
    )
  ";

  $query = mysql_query($sql, $connect) or die(mysql_error());
  $dados = mysql_fetch_object($query);  		

  // $foto_animal_seo = 
  
  $foto_animal_seo = !empty(trim($dados->foto_lote_leilao)) ? trim($dados->foto_lote_leilao) : trim($dados->foto01_animal);
  $foto_animal_seo = !empty(trim($foto_animal_seo)) ? $link_padrao_fotos.$foto_animal_seo : $sem_img;
  ?>

  <!-- SEO FACEBOOK  -->
  <meta property="og:title" content="<?php echo "Seleção da Marcha - Lote $dados->num_lote_leilao | $dados->nome_grupo - $dados->nome_animal" ?>" />
  <meta property="og:type" content="article" />
  <meta property="og:description" content="<?php echo "$dados->titulo - " . trim(substr(strip_tags($dados->comentario_animal), 0, 100)); ?>" />
  <meta property="og:url" content="https://www.selecaodamarcha.com.br/detalhes/?lote=<?php echo criptografa($id_lote_header); ?>" />
  <meta property="og:image" content="<?= $foto_animal_seo ?>" />

  <?php
} // IF

else { ?>
  
  <!-- SEO FACEBOOK  -->
  <meta property="og:title" content="Seleção da Marcha" />
  <meta property="og:type" content="website" />
  <meta property="og:description" content="Visite nosso site!" />
  <meta property="og:url" content="https://www.selecaodamarcha.com.br/home/" />
  <meta property="og:image" content="https://www.selecaodamarcha.com.br/assets/images/favicon22.png" />

  <?
}
