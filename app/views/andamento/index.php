<?php
	if(!isset($_SESSION)){
	session_start();
	}
?>

<div class="base-home">
	<h1 class="titulo-pagina">Andamento do Processo</h1>
</div>

<div class="frmConsulta">  
<form method="GET" action="<?php echo URL_BASE . 'Andamento/porProcesso/'; ?>" >


		<!--Botões !-->
		<div class="btn-inc">
				<script> //Link para voltar à página anterior
					document.write('<a href="' + document.referrer + '">Voltar</a>');
				</script>
			</div>			
			
			<div class="btn-inc">
				<a href="<?php echo URL_BASE . "ocorrencia/novo" ?>">INCLUIR</a>
			</div>

			
<label>Pesquisa por número do processo</label>
		<input type="number" autofocus name="numero_processo">
		<input type="submit" value="pesquisar">
	</form>

 				<?php
					if(isset($processo)){
				foreach($processo as $pd){ 
				}} ?>

	<table>
	<form action="<?php  echo URL_BASE ."Processo/Salvar" ?>" method="POST">

<?php
		if(isset($processo)){
			foreach($processo as $pd){ 
		}
	}
		
	?>
		<fieldset>
				<legend><h4>Códigos</h4></legend>	
			<label>Id do Processo</label>

			<input id="txt_id" readonly name="txt_id_processo" enable="false" 
				value="<?php if(!empty($pd->id_processo)){
							echo $pd->id_processo; 
						}else{ 
							echo 0;
						}
				?>" >

				<label>Id da denuncia</label>
				<input id="txt_id" readonly name="txt_id_denuncia" enable="false" value="<?php if(!empty($pd->id_denuncia)){
						echo $pd->id_denuncia;
					}else{
						echo 0;
					} ?>" >

				<label>fase</label>
				<input name="txt_id_fase" value="<?php if(!empty($pd->fase)){
					echo $pd->fase;
				 }else{
					 echo "";
				 } ?>" >

		</fieldset>		

	<fieldset>
		<legend>informações do processo</legend>
			<label>Número do Processo</label>
			<input class="txt_numero_processo" name="txt_numero_processo" type="number" placeholder="Insira o número do processo" value="<?php if(!empty($pd->numero_processo)){echo $pd->numero_processo;} ?>">
			
				<?php 
					if(isset($pd->numero_processo)){
						$_SESSION['numero_processo'] = $pd->numero_processo; 
					}
				?>
			
				 <label>Data de Instauração</label>
					<input name="txt_data_instauracao" type="date" value="<?php  if(!empty($pd->data_instauracao)){echo $pd->data_instauracao;} ?>">
	</fieldset>
	</table>
</form>

	<table border="2">
		  <thead>
			<tr>
				<th align="center" width="5%">Id</th>
 				<th align="center" width="10%">Número Processo</th>
				<th align="center" width="10%">Data da ocorrência </th>
				<th align="center" width="40%">ocorrência </th>
				<th width="5%">Anexo</th>
				<th align="center" width="20%" colspan="2">Ação</th>
			</tr>
	<?php
		if(isset($procOcorr)){
  		foreach($procOcorr as $oco){
?>		
		<tr>
				<td align="center"><?php echo $oco->id_ocorrencia ?> </td>
				<td align="center"><?php echo $oco->numero_processo ?> </td>
				<td><?php echo date('d/m/Y', strtotime($oco->data_ocorrencia)) ?> </td> 
				<td><?php echo $oco->ocorrencia ?> </td>
				<td align="center"><?php echo $oco->anexo ?> </td>
		  </div>		
				<td>
					<div class="btn-editar"> 
						<a href="<?php echo URL_BASE ."Ocorrencia/Edit/".$oco->id_ocorrencia ?>">Editar</a>
	  				</div>
				</td>

				<td>
					<div class="btn-excluir"> 
						<a href="<?php echo URL_BASE ."Ocorrencia/Excluir/".$oco->id_ocorrencia ?>" >Excluir</a>
					</div>
				</td>
	  		</tr>
				<?php }
			}	
		?>

		<fieldset>
			<tr><td align="center" colspan="9">
				
			<?php
					$numero_processo = $_SESSION['numero_processo'];

					for($q=1; $q<=$totalPaginas; $q++):  
						echo "<a href=".URL_BASE.'andamento/porProcesso/?p='.($q).'&numero_processo='.$numero_processo; ?> " > <?php echo "[".($q)."]" ?> </a> 

		  <?php endfor; 
		  ?>
		</fieldset>
			</td>
        </tr>

   </table>
</div>
</body>
</html>