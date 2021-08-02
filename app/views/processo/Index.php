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
				<th width="10%">Id Processo</th>
				<th width="10%">Id denuncia</th>
				<th width="10%">Fase</th>
				<th width="15%">Numero do Processo</td>
				<th width="15%">Data Instauração </th>
			<!--	<th width="25%">Observação</th>  !-->
				<th width="25%">Data encerramento</th>
	
				<th align="center" colspan="5">Ação</th>
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
			<!--	<td><?php //echo $pd->observacao  ?> </td>  !-->

				 <td> <?php $data = new DateTime($pd->data_instauracao);
				 		echo $data->format('d-m-Y');
				 	?>
				 </td> 

				 <td> <?php $data = new DateTime($pd->data_encerramento);
				 		echo $data->format('d-m-Y');
				 	?>
				 </td> 

				<td>
				<div class="btn-ocorrencia"> 
					<a href="<?php echo URL_BASE ."Fase/Tramitar/".$pd->id_processo ?>" >Fase</a>
	  			</div>
	  			</td>

				<td>
					<div class="btn-portaria"> 
						<a href="<?php echo URL_BASE ."Portaria/Vincular/".$pd->id_processo ?>" >Portaria</a>
	  				</div>				
	  			</td>
  
				<td>
				<div class="btn-ocorrencia"> 
					<a href="<?php echo URL_BASE ."Vincular/Ocorrencia/".$pd->id_processo ?>" >Ocorrência</a>
	  			</div>
	  			</td>
				
				
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