<?php

?>
<div class="base-home">
	<h1 class="titulo-pagina">Lista de Portarias</h1>
</div>
<script type="text/javascript" src="<?php URL_BASE . "/assets/js/funcoes.js" ?>"> </script>

<!-- <div class="base-lista">
-->

<form name="prazoVencimento" method="POST" action="<?php echo URL_BASE . 'portaria/filtrarPrazo' ?>">
	<div class="textCabecalhoPortaria">
		<label>Pesquisar a partir de: </label> 
		<input type="date" name="dataInicial" min="2015-01-01" max="<?php echo date("Y-m-d") ?>" value='<?php echo date("Y-m-d"); ?>' >
		<br>
			<label id="prazo">Informe a quantidade de dias para o vencimento </label> 
            <input type="number" autofocus required name="prazo" value="<?php echo  $prazo=30 ?>">

			<label>dias</label>
            <input type="submit" value="pesquisar">
            <br>   
<!-- 
			<label>Número da portaria</label> 
            <input type="number" name="numero">
			
 --><?php 
			if(isset($portaria)){
				$qtde = $portaria;
					foreach($portaria as $port){
						$prazo = $port->prazo;
					}

					if(count($qtde) > 1){
						$reg = "Registros";
					}else{
						$reg = "Registro";
					}

					if(isset($_POST['dataInicial']) && isset($_POST['prazo'])){
						echo "<div class='registroPortaria'> 
							<label> <span>" .  count($qtde) . "</span><h2> $reg vencendo em até  ". $_POST['prazo'] . " dias a partir de ". date('d/m/Y', strtotime($_POST['dataInicial'])) . "</h2>  </label>
						</div>";
					}
				}
?>


	<?php  ?>
        
    </form>
		<!--Botões !-->
			
		<div class="filho1">
		    
		</div>

<!-- 			<div class="filho2">
				<a href="<?php echo URL_BASE . "ocorrencia/novo" ?>" class="btn-inc" >INCLUIR</a>
			</div>
 -->				<br/><br/>

	<table class="portaria" width="100%" border="1" cellspacing="0" cellpadding="0">
		  <thead class="thead">
				<th>Número da portaria</th>
<!-- 				<th width="10%">Tipo</td>  //tirado temporariamente provavelmente não será util, se for reativarei
 -->			<th>Número Processo</th>
 				<th>Data Elaboração </th>
				<th>Data Publicação</th>
				<th>Veículo</th>
				<th>Prazo</th>
				<th>Data Vencimento</th>
				<th>Status</th>
				<th>Anexo</th>
				<th align="center" colspan="2">Ação</th>
			</tr>
		</thead>
	<?php 
	  foreach($portaria as $port){
		$data_final = date("d/m/Y", strtotime($port->data_final));

		//contar quantidade de dias entre  datas
		$hoje = date("Y/m/d");
		$hoje = strtotime($hoje);
		$dataFinal = $port->data_final;
		$dataFinal = strtotime($dataFinal);
 		$diasTime = $dataFinal - $hoje;
		$dias = floor($diasTime / (60 * 60 * 24));

		//verifica a quaantidade de dias para classificação
		if(isset($dias)){
			if($dias == 0){
				$prazo = $dias." Vence hoje ";
			}elseif($dias == 1){
				$prazo = $dias." dia pra vencer ";
			}elseif($dias > 1){
				$prazo = $dias." dias pra vencer ";
			}elseif($dias == -1){
				$prazo = $dias * (-1)." dia vencido";
			}elseif($dias < -1)
				$prazo = $dias * (-1)." dias vencidos";
				
				if($dias > 3){
					$cor = "red";
				}else{
					$cor = "orange";
				}
		
	
	?>	
			<tr class="<?php echo $cor ?>">
				<td><?php echo $port->numero?></td>
				<td><?php echo $port->numero_processo ?></td>
<!-- 				<td><?php //echo $port->tipo ?></td>  tirado temporariamente provavelmente não será util, se for reativarei
 -->			<td><?php echo date("d/m/Y", strtotime($port->data_elaboracao))  ?> </td>
				<td><?php echo date("d/m/Y", strtotime($port->data_publicacao))  ?> </td>
				<td><?php echo $port->veiculo ?></td>
				<td id="prazo"><?php echo $port->prazo." dias" ?></td>
				<td><?php echo date("d/m/Y", strtotime($port->data_final)) ?></td>

				<td> <?php echo $prazo ?>	</td>
				<?php 
	  }else{
		echo "erro";
	  }
 				?>

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
