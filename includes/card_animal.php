<div class="col-md-4 mb-50">
  <a href="../detalhes/?lote=<?= criptografa($animal->id_lote_leilao) ?>&div_lote">
    <!-- <div class="ts-team-wrapper pa-md" style="border: 1px solid #6c6c74"> -->
    <div class="ts-team-wrapper pa-md card-animal">
      
      <?php
        $fotos_existentes['foto00'] = trim($animal->foto_lote_leilao); // FOTO DO LOTE
        $fotos_existentes['foto01'] = trim($animal->foto01_animal);
        $fotos_existentes['foto02'] = trim($animal->foto02_animal);
        $fotos_existentes['foto03'] = trim($animal->foto03_animal);
        $fotos_existentes['foto04'] = trim($animal->foto04_animal);
        $fotos_existentes['foto05'] = trim($animal->foto05_animal);
        $fotos_existentes['foto06'] = trim($animal->foto06_animal);

        $foto_animal = $img_sem_img;
        $border_img = "border-ccc";

        for ($i = 0; $i <= 6; $i++) {
          $foto_atual = $fotos_existentes["foto0$i"];
          if (!empty($foto_atual)) {
            $foto_animal = $url_docs_sistema . $foto_atual;

            $border_img = '';
            break;
          }
        }
      ?>

      <div class="team-img-wrapper">
        <!-- <?= (int)$animal->situacao_comercial_animal_evento == 1 ? '<span class="tarja-vendido">VENDIDO</span>' : '' ?> -->
        <?= (int)$animal->situacao_comercial_animal_evento == 1 ? '<span class="tarja_lote_vendido"><img src="../assets/images/tarja-vendido.png" alt="Lote Vendido" /></span>' : '' ?>
        <img src="<?= $foto_animal ?>" class="img-responsive <?= $border_img ?> width-100" alt="Foto do Animal">


        <?php
          $videos_existentes['video00'] = trim($animal->url_video_lote_leilao); // VÍDEO DO LOTE
          $videos_existentes['video01'] = trim($animal->video_animal_01);
          $videos_existentes['video02'] = trim($animal->video_animal_02);
          $videos_existentes['video03'] = trim($animal->video_animal_03);

          for ($j = 0; $j <= 4; $j++) {

            $video_animal = trim($videos_existentes["video0$j"]);
            if (!empty($video_animal)) {
              $descricao_video = "$NUM_LOTE_LEILAO. $animal->nome_animal";
          ?>

              <a class="btn-xs btn-video" href="javascript:void(0)" onclick="modal_video_lote('<?= $video_animal ?>', '<?= $descricao_video ?>', 'normal')">
                <img src="../assets/images/youtube_play.png" width="30px" height="30px"></img>
              </a>
              
              <!-- Botão abrir imagem do lote -->
              <!-- <a class="btn-xs btn-video-max" href="javascript:void(0)" onclick="modal_video_lote('<?= $video_animal ?>', '<?= $descricao_video ?>', 'full')">
                <img src="../assets/images/youtube_maximizar.png" width="30px" height="28px"></img>
              </a> -->

          <?
              break;
            } // IF
          } // FOR
        ?>
      </div>
      
      <h4 class="ts-name text-center title-nome-animal">
        <span>
          <?php
          $NUM_LOTE_LEILAO = !empty(trim($animal->num_lote_leilao)) ? $animal->num_lote_leilao : '00';
          echo "$NUM_LOTE_LEILAO. $animal->nome_animal";
          ?>
        </span>
      </h4>

      <div class="ts-team-content-classic pa-xs font-13px text-weight-600">
        <strong class="red-template">Pai:</strong> <span class="grey"><?= !empty(trim($animal->p00)) ? mb_strtoupper($animal->p00, 'UTF-8') : "<span class='text-muted2'>NÃO INFORMADO</span>"; ?></span>
        <hr class="nmt nmb">

        <strong class="red-template">Mãe:</strong> <span class="grey"><?= !empty(trim($animal->m00)) ? mb_strtoupper($animal->m00, 'UTF-8') : "<span class='text-muted2'>NÃO INFORMADA</span>"; ?></span>
        <hr class="nmt nmb">

        <strong class="red-template">Nascimento: </strong> <?= date('d/m/Y', strtotime($animal->nascimento_animal)) ?>
        <hr class="nmt nmb">

        <strong class="red-template">Cotas à Venda:
        </strong><?= (float)$animal->COTAS_VENDA_LOTE > 0 ? number_format($animal->COTAS_VENDA_LOTE, 2, ',', '.') . '%' : '' ?>
        <?= !empty(trim($animal->nome_amigavel)) ? " / $animal->nome_amigavel" : '' ?>

        <hr class="nmt nmb">

        <!-- 
        <?php
        // SE FOR DIFERENTE DE ANIMAL DE PLANTEL, APARECE O VALOR
        if ($animal->categoria_site != 4) { ?>
            
            <h6 class="text-center font-15px nmb">
              <strong class="red-template">
                <?php
                if ($animal->CATEGORIA_EVENTO == 1) {
                  echo (int)$animal->VALOR_ULTIMO_LANCE > 0 ? 'LANCE ATUAL:' : 'LANCE INICIAL:';
                } else {
                  echo "VALOR ATUAL:";
                }
                ?>
              </strong>
              <?php
              $VALOR_ATUALIZADO = (int)$animal->VALOR_ULTIMO_LANCE > 0 && $animal->categoria_site == 1 ? (int)$animal->VALOR_ULTIMO_LANCE : $animal->VALOR_ANIMAL;
              echo 'R$ ' . number_format($VALOR_ATUALIZADO, 2, ',', '.');

              // (float)$animal->VALOR_ANIMAL > 0 ? 'R$ ' . number_format($animal->VALOR_ANIMAL, 2, ',', '.') : '';
              ?>
            </h6>

            <hr class="nmb mt-sm">
            <?
          }
            ?>
        -->

      </div>

    </div>
  </a>
</div>