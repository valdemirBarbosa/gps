<?php
	if(!isset($_SESSION)){
	session_start();
	}
?>
<div class="base-home">
	<h1 class="titulo-pagina">Processos finalizados</h1>
</div>

<form method="GET" action="<?php echo URL_BASE . 'Finalizados/Consulta'; ?>" >

<?php include "app/views/radio.php"; ?>

		<label>Pesquisa</label> 
			<select name="pesquisa">
				<option value="1">Número do documento</option>
				<option value="2">Número do Processo</option>
				<option value="3">Nome</option>
				<option value="4">CPF</option> <!-- Ocultado pois na tabela denuncia não há cpf -->
			<!--	<option type="number" value="6">Id da denúncia</option> -->
			</select>

			<input requird type="text" autofocus name="valorPreenchidoUsuario"> 
			<input type="submit" value="pesquisar">
</form>
		<table border="1" cellspacing="0" cellpadding="0">
		  <thead>
			<tr>
				<th align="center">Id_fim</th>
 				<th>Número da denuncia</th>
				<th>Número do processo </th>
				<th>nome do servidor</th>
				<th>cpf</th>
				<th>data julgamento</th>
				<th>penalidade</th>
				<th>comentário</th>
				<th width="10%" align="center" colspan="3">Ações</th>
			</tr>
	<?php
	if(isset($finalizados)){ 
	foreach($finalizados as $fim){
	?>
		<tr>
		   <td align="center"><?php echo $fim->id_finalizado  ?> </td>
 		   <td align="center" width="7%"><?php echo $fim->numero_documento  ?></td> 
 		   <td align="center" width="5%"><?php echo $fim->numero_processo  ?></td> 
           <td align="center"><?php echo $fim->nome_servidor ?> </td>
           <td align="center"><?php echo $fim->cpf ?> </td>
		   <td align="center">
		       <?php
		            if($fim == "0000-00-00 00:00:00"){
		                echo "00-00-0000";
		            }else{
		           echo date("d/m/Y", strtotime($fim->data_julgamento)); 
		           }?> 
		  </td>
   		   <td align="center"><?php echo $fim->penalidade ?> </td>

		   <td align="center" width="20%"><?php echo $fim->comentario ?> </td>

			<td>
			  <div class="btn-editar"> 
					<a href="<?php echo URL_BASE ."#denuncia/Edit*/".$fim->id_finalizado ?>" >Editar</a>
	  	      </div>	
			</td>
			
			<td>
				<div class="btn-excluir"> 
					<a href="<?php echo URL_BASE ."#denuncia/Excluir/".$fim->id_finalizado ?>" >Excluir</a>
				</div>
			</td>

		</tr>

							<?php  } 
				}?>
				
	</div> <!-- FIM DA DIV base-lista !-->
	</div> <!-- FIM DA DIV container-conteudo -->
	</table>
	<div class="paginacao">
				<?php
					if(isset($totalPaginas)){

						for($q=1; $q<=$totalPaginas; $q++):  
							echo "<a href=".URL_BASE.'Pesquisa/ConsultaDenuncia/?p='.($q); ?> > <?php echo "[".($q)."]" ?> </a> 
				<?php

						endfor;
					}
					

				?>
