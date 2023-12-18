<?php

// OBTEM OS ÚLTIMOS LANCES DADOS NO LOTE
$select_ultimos_lances =
" SELECT * FROM tab_lances
  JOIN tab_usuarios ON tab_usuarios.id_usuario = tab_lances.id_usuario_lance
  WHERE (
    id_tab_lote_leilao    = '$id_lote_leilao'
    AND id_leilao_lance   = '$lote->ID'
    AND id_situacao_lance = '1'
    AND tipo_lance        = '1' -- TIPO LEILÃO
  )
  ORDER BY id_lances DESC
";




$resultado_ultimos_lances = executa_query($select_ultimos_lances);

if (isset($resultado_ultimos_lances->error_msg)) {
  retorno_usuario("error", "Erro: $resultado_ultimos_lances->error_msg");
}

$num_lances = count($resultado_ultimos_lances->dados);


// SE FOR ANIMAL DE LEILÃO, EXIBE O HISTÓRICO DE LANCES DO MESMO
if( $num_lances > 0) { ?>

  <div class="container">
    <div class="ts-pricing-box ts-pricing-featured nmt">

      <div class="ts-pricing-header font-28px">
        <strong>LANCES RECEBIDOS</strong>
      </div>
      
      <div class="table-responsive">
        <table class="table table-hover">
          <tbody>

            <?php
              $contador = $num_lances;                
              foreach($resultado_ultimos_lances->dados as $lance) { ?>

                <tr>
                  <td>
                    <p><?= str_pad($contador--, 2, '0', STR_PAD_LEFT); ?>º</p>
                  </td>
                  <td>
                    <p>R$ <?= number_format($lance->valor_lance, 2, ',', '.'); ?></p>
                  </td>
                  <td>
                    <p><?= date("d/m/Y", strtotime($lance->data_lance)); ?></p>
                  </td>
                  <td>
                    <p><?= date("H:i:s", strtotime($lance->hora_lance)); ?></p>
                  </td>
                  <td>
                    <p><?= trim($lance->cidade_usuario) != "" ? $lance->cidade_usuario : "- - -"; ?></p>
                  </td>
                  <td>
                    <p><?= trim($lance->uf_usuario) != "" ? $lance->uf_usuario : "- - -"; ?></p>
                  </td>
                </tr>

                <?
              }
            ?>


          </tbody>
        </table>
      </div>

    </div>
  </div>

  
  <?
} // IF
