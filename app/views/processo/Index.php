<div class="base-home">
	<h1 class="titulo-pagina">Lista de Processos</h1>
</div>

<div class="base-lista">
	<span class="qtde">Há <b><?php echo count($processo) ?></b> Processos</span>
	<div class="btn-inc"><a href="<?php 
				    echo URL_BASE . "processo/Novo"; ?>" >INCLUIR </a></div>

	<div class="tabela">	
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		  <thead class="thead">
				<th width="10%">Id pad</th>
				<th width="10%">Id denuncia</th>
				<th width="10%">Fase</th>
				<th width="15%">Numero do Processo</td>
				<th width="15%">Data Instauração </th>
				<th width="25%">Observação</th>
				<th width="25%">Data encerramento</th>
				<th width="5%">Anexo</th>

				<th align="center" colspan="2">Ação</th>
			</tr>
		</thead>
	<?php 
	  foreach($processo as $pd){
	?>
			<tr>
				<td align="center"><?php echo $pd->id_processo ?> </td>
				<td align="center"><?php echo $pd->id_denuncia ?> </td>
				<td align="center"><?php echo $pd->fase  ?> </td>
				<td align="center"><?php echo $pd->numero_processo ?> </td>

				<?php $dt_entrada = explode("-",$pd->data_instauracao);
					$dia = $dt_entrada[2];
					$mes = $dt_entrada[1];
					$ano = $dt_entrada[0];
				?>

				<td align="center"><?php echo $dia."/".$mes."/".$ano ?> </td> 
				<td><?php echo $pd->observacao  ?> </td>

				<?php $dt_encerramento = explode("-",$pd->data_encerramento);
					$dia = $dt_encerramento[2];
					$mes = $dt_encerramento[1];
					$ano = $dt_encerramento[0];
				?>

				<td align="center"><?php echo $dia."/".$mes."/".$ano ?> </td> 
				<td align="center"><?php echo $pd->anexo ?> </td>

				<td>
				<div class="btn-editar"> 
					<a href="<?php echo URL_BASE ."Processo/Edit/".$pd->id_processo ?>" >Editar</a>
	  			</div>
				</td>
			
				<td> 
				<div class="btn-excluir">
					<a href="<?php echo URL_BASE ."Processo/Excluir/".$pd->id_processo ?>" >Excluir</a>
	  			</div>

				</td>
			</tr> 
	<?php } ?>

			<hr/><hr/>
		</table>
	</div>				
		<p>...</P>
</div>

</body>
</html>