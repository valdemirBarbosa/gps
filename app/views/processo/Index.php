<div class="base-home">
	<h1 class="titulo-pagina">Lista de Processos</h1>
</div>

<?php //paramentros para pesquisa dos formulários de denuncia e processo
		session_start();
		$tabela = 'processo';
 		$view = 'processo/Index';
		$retorno = 'processo';
?>

<div class="containerPesqusa">
<div class="frmConsulta">  
	<form method="GET" action="<?php echo URL_BASE . 'Pesquisa/ConsultaProcesso'; ?>" >
		<table>
			<tr>
				<td>
					<label>Pesquisa</label>
						<select name="pesquisa" classe="select">
								<option value="1">Número documento da denúncia</option>
								<option value="2" selected="selected">Número do Processo</option>
								<option value="3">Nome</option>
								<option value="4">CPF</option>
						</select>
				</td>
				<td>
						<input type="text" autofocus name="valorPreenchidoUsuario">
						<input type="hidden" name="view" value="<?php echo $view ?>">
						<input type="hidden" name="retorno" value="<?php echo $retorno ?>">
						<input type="hidden" name="tabela" value='<?php echo $tabela ?>'>
						<input type="submit" value="pesquisar">
				</td>
			</tr>
			</table>
		</div>
	</div>
		
<div class="base-lista">
	<div class="tabela">	
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		  <thead class="thead">
				<th align="center" width="5%">Id Processo</th>
				<th align="center" width="5%">Id denuncia</th>
				<th align="center" width="15%">Fase</th>
				<th align="center" width="10%">Numero do Processo</td>
				<th align="center" width="8%">Data de Instauração </th>
				<th width="25%">Observação</th>
				<th width="8%">Data de encerramento</th>
	
				<th align="center" colspan="6">Ação</th>
			</tr>
		</thead>
	<?php 
	  	foreach($processo as $pd){
	?>
			<tr>
				<td align="center"><?php $_SESSION['id_processo'] = $pd->id_processo;
										echo $pd->id_processo ?> </td>
				<td align="center"><?php echo $pd->id_denuncia ?> </td>
				<td align="center"><?php echo $pd->fase  ?> </td>
				<td align="center"><?php echo $pd->numero_processo ?> </td>
				<td><?php echo $pd->observacao  ?> </td>
				 <td align="center"> <?php $data = new DateTime($pd->data_instauracao);
				 		echo $data->format('d-m-Y');
				 	?>
				 </td> 

				 <td align="center"> <?php $data = new DateTime($pd->data_encerramento);
				 	if($data > "01/01/1900"){
				 		echo $data->format('d-m-Y');
					 }else{
						 echo "00/00/0000";
					 }
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
				<div class="btn-ocorrencia">
					<a href="<?php echo URL_BASE ."Processo/Processar/".$pd->id_processo ?>" >Processar</a>
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
		
			<!--Botões !-->
			<div class="btn-inc">
				<script> //Link para voltar à página anterior
					document.write('<a href="' + document.referrer + '">Voltar</a>');
				</script>
			</div>			
			
			<div class="btn-inc">
				<a href="<?php echo URL_BASE . "processo/novo" ?>" >INCLUIR </a>
			</div>
		</table>
	</div>				
		<p>...</P>
</div>
</form>
