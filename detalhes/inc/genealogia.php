<link rel="stylesheet" href="../assets/css/genealogia.css?v=1.0.2">

<div class="corpo">
  <div id="embrulho">

    <!-- Raiz -->
    <span class="labeil raiz">

      <?php
        // BUSCA NOME DO PAI PRIMEIRO NA TAB_ANIMAIS. SE NAO TIVER, BUSCA NA TAG_GENEALOGIA
        $nome_do_pai = empty(trim($lote->pai_animal)) ? $lote->p00 : $lote->pai_animal;
        $nome_do_pai = empty(trim($nome_do_pai)) ? "- - -" : $nome_do_pai;
        
        // BUSCA NOME DA MAE PRIMEIRO NA TAB_ANIMAIS. SE NAO TIVER, BUSCA NA TAG_GENEALOGIA
        $nome_da_mae = empty(trim($lote->mae_animal)) ? $lote->m00 : $lote->mae_animal;
        $nome_da_mae = empty(trim($nome_da_mae)) ? "- - -" : $nome_da_mae;
      ?>

      <!-- IMAGEM / FOTO ANIMAL -->
      <img src="<?= !empty($FOTO_01) ? $url_docs_sistema.$FOTO_01 : $img_sem_img; ?>" class="img-responsive" alt="">
    </span>

    <div class="galho lv1 galho-raiz">

      <!-- Galho Pai -->
      <div class="arco">
        <span class="labeil m"><b>Pai:</b><br><div><?php echo $nome_do_pai; ?></div></span>
        <div class="galho lv2">
          <div class="arco">
            <span class="labeil m"><b>Avô:</b><br><div><?php echo trim($lote->p01) != "" ? $lote->p01 : '- - -'; ?></div></span>
            <div class="galho lv3">
              <div class="arco"><span class="labeil m"><b>Bisavô:</b><br><div><?php echo trim($lote->p03) != "" ? substr($lote->p03,0,22) : '- - -'; ?></div></span></div>
              <div class="arco"><span class="labeil f"><b>Bisavó:</b><br><div><?php echo trim($lote->p04) != "" ? substr($lote->p04,0,22) : '- - -'; ?></div></span></div>
            </div>
          </div>
          <div class="arco">
            <span class="labeil f"><b>Avó:</b><br><div><?php echo trim($lote->p02) != "" ? substr($lote->p02,0,22) : '- - -'; ?></div></span>
            <div class="galho lv3">
              <div class="arco"><span class="labeil m"><b>Bisavô:</b><br><div><?php echo trim($lote->p05) != "" ? substr($lote->p05,0,22) : '- - -'; ?></div></span></div>
              <div class="arco"><span class="labeil f"><b>Bisavó:</b><br><div><?php echo trim($lote->p06) != "" ? substr($lote->p06,0,22) : '- - -'; ?></div></span></div>
            </div>
          </div>
        </div>
      </div>
      <!-- end:Galho Pai -->



      <!-- Galho Mãe -->
      <div class="arco">
        <span class="labeil f"><b>Mãe:</b><br><div><?php echo $nome_da_mae; ?></div></span>
        <div class="galho lv2">
          <div class="arco">
            <span class="labeil m"><b>Avô:</b><br><div><?php echo trim($lote->m01) != "" ? $lote->m01 : '- - -'; ?></div></span>
            <div class="galho lv3">
              <div class="arco"><span class="labeil m"><b>Bisavô:</b><br><div><?php echo trim($lote->m03) != "" ? substr($lote->m03,0,22) : '- - -'; ?></div></span></div>
              <div class="arco"><span class="labeil f"><b>Bisavó:</b><br><div><?php echo trim($lote->m04) != "" ? substr($lote->m04,0,22) : '- - -'; ?></div></span></div>
            </div>
          </div>
          <div class="arco">
            <span class="labeil f"><b>Avó:</b><br><div><?php echo trim($lote->m02) != "" ? substr($lote->m02,0,22) : '- - -'; ?></div></span>
            <div class="galho lv3">
              <div class="arco"><span class="labeil m"><b>Bisavô:</b><br><div><?php echo trim($lote->m05) != "" ? substr($lote->m05,0,22) : '- - -'; ?></div></span></div>
              <div class="arco"><span class="labeil f"><b>Bisavó:</b><br><div><?php echo trim($lote->m06) != "" ? substr($lote->m06,0,22) : '- - -'; ?></div></span></div>
            </div>
          </div>
        </div>
      </div>
      <!-- end:Galho Mãe -->


    </div> <!-- galho-raiz -->

  </div>
</div>