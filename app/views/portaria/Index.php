<div class="base-home">
	<h1 class="titulo-pagina">Lista de Portarias</h1>
</div>
<script type="text/javascript" src="<?php URL_BASE . "/assets/js/funcoes.js" ?>"> </script>

<div class="base-lista">
	
	<div class="pai|">	
		<!--Botões !-->
			
		<div class="filho1">
		    
		</div>
		
<!-- 			<div class="filho2">
				<a href="<?php echo URL_BASE . "ocorrencia/novo" ?>" class="btn-inc" >INCLUIR</a>
			</div>
 -->				<br/><br/>

	<table width="100%" border="1" cellspacing="0" cellpadding="0">
		  <thead class="thead">
				<th width="10%">Número Processo</th>
<!-- 				<th width="10%">Tipo</td>  //tirado temporariamente provavelmente não será util, se for reativarei
 -->				<th>Data Elaboração </th>
				<th>Data Publicação</th>
				<th width="25%">Veículo</th>
				<th width="25%">Prazo</th>
				<th width="10%">Data Vencimento</th>
				<th width="25%">Dias a vencer</th>
				<th width="5%">Anexo</th>
				<th align="center" colspan="2">Ação</th>
			</tr>
		</thead>
	<?php 
	  foreach($portaria as $port){
	?>
			<tr>
				<td><?php echo $port->numero_processo ?></td>
<!-- 				<td><?php //echo $port->tipo ?></td>  tirado temporariamente provavelmente não será util, se for reativarei
 -->				<td><input class="data" type="date" readonly value="<?php  echo $port->data_elaboracao  ?>" ></td>
				<td><input class="data" type="date" readonly value="<?php echo $port->data_publicacao  ?>"> </td>
				<td><?php echo $port->veiculo ?></td>
				<td id="prazo"><?php echo $port->prazo." dias" ?></td>
				<td><input id="dataFinal" class="data" type="date" readonly value="<?php echo $port->data_final ?>"> </td>
				<td><?php 
						$prazo = $port->dias_a_vencer;

						if($prazo < -1){
							echo $prazo." dias pra vencer ";
						}

						if($prazo == -1){
							echo "<div class='prazo'> ".$prazo." vencendo amanhã </div>";
						}

						if($prazo == 0){
								echo "<div class='prazo'> ".$prazo." dias. Vencendo hoje </div>";
						}
						if($prazo == 1){
							echo $prazo." dia pra vencer ";
						}
						if($prazo >10){
								echo $prazo." dias vencidos ";
						}
						?>
				</td>

				<td>
				<div class="btn-editar"> 
					<a href="<?php echo URL_BASE ."Portaria/Edit/".$port->id_portaria ?>" >Editar</a>
	  			</div>
				</td>
			
				<td> 
				<div class="btn-excluir">
					<a href="<?php echo URL_BASE ."Portaria/Excluir/".$port->id_portaria ?>" >Excluir</a>
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