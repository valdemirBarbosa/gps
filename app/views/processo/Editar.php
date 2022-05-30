<div class="base-home">
	<h1 class="titulo-pagina">Alterar dados do Processo e Anexar arquivos</h1>
</div>

<form enctype="multipart/form-data" action="<?php echo URL_BASE ."Processo/Salvar" ?>" method="POST">
<?php foreach($processo as $pd){ $_SESSION['id_processo'] = $pd->id_processo; 
?>
	<fieldset>
		<legend><h4>Códigos</h4></legend>	
			<label>Id do Processo</label>
				<input id="txt_id" readonly name="txt_id_processo" enable="false" value="<?php echo $pd->id_processo ?>" >
			<label>Id da denuncia</label>
			<input readonly name="txt_id_denuncia" enable="false" value="<?php echo $pd->id_denuncia ?>" >

			<label>fase</label>
				<select name="txt_id_fase">
					<option value="<?php echo $pd->id_fase ?>"><?php echo $pd->fase ?></option>
<?php } ?>					

<?php foreach($fase as $f){ ?>
						<option readonly value="<?php echo $f->id_fase ?>"><?php echo $f->fase ?> </option>
<?php } ?>
				</select>

				<label>Número do Processo</label>
			<input class="txt_numero_processo" name="txt_numero_processo" type="number" placeholder="Insira o número do processo" value="<?php echo $pd->numero_processo ?>">

	</fieldset>		

	<table><tr><td colspan="5"><td></td> <td></td> <td></td> <td></td>
    <fieldset>
    <legend>informações do processo</legend>
			
		<label>Data de Instauração</label>
            <input name="txt_data_instauracao" type="date" value="<?php echo $pd->data_instauracao ?>">
   
<!--	A data de encerramento ficará só pra mudança de fase e para finalização do processo
        <label>Data de Encerramento</label>
		<input name="txt_data_encerramento" type="date" readonly value="<?php echo $pd->data_encerramento ?>">
		<input type="hidden" name="id_processo" value="<?php echo $pd->id_processo ?>">	
 -->
		<label>Observação</label>
			<input class="" size="100px" name="txt_observacao" type="text" placeholder="Insira o número do processo" value="<?php echo $pd->observacao ?>">

	</fieldset>
	
	<fieldset>
	<legend>Upload de arquivos</legend>

			<div class="anexoPai">
			<div class="anexoFilho1">
				<input type="file" name="arquivo">
				<input type="hidden" name="view" value="<?php echo $view ?>">
			</div>
			
			<div class="anexoFilho2">
				<label for="descricao">descrição do arquivo</label>
				<input type="text" size="50" name="descricao">
			</div>
			
			<div class="anexoFilho3">
				<label for="data_inclusao">data inclusão</label>
				<input type="text" name="data_inclusao" value="<?php echo date('d-m-Y'); ?>">
				<input type="hidden" name="view" value="<?php echo "processo/Edit/".$pd->id_processo ?>" >
			</div>
		</div>

	</fieldset>
	
	<fieldset>
		<legend>Arquivos anexados</legend>
		<table>
			<tr>
				<th>id</th>
				<th>id do processo</th>
				<th>arquivo</th>
				<th>informações sobre</th>
				<th>data inclusão</th>
				<th>acao</th>
			</tr>

			<?php foreach($anexo as $a){?>
			<tr>
				<td><?php echo $a->id_upload?> </td>
				<td><?php echo $a->id_processo?> </td>
				<td><?php echo $a->arquivo?> </td>
				<td><?php echo $a->descricao?> </td>
				<td><?php echo $a->data_inclusao?> </td>
				<?php
					$caminho = $a->caminho;
					$arquivo = $a->arquivo;
				?>
	
				<td> <!-- DOWNLOAD DE ARQUIVOS  !-->
					<a href="<?php echo URL_BASE . 'downloads/?path='.$caminho.'&file='.$arquivo ?>"> baixar </a>
					
				</td>
			</tr>
			<?php } ?>
		</table>
	</fieldset>
		
		<br/>
			<div class="paginacao">		
			<?php
				if(isset($totalPaginas)){?>
						<?php
							for($q=1; $q<=$totalPaginas; $q++):  
								echo "<a href=".URL_BASE."processo/Edit/".$pd->id_processo."?p=".$q.">". $q ?> </a> 
						<?php
							endfor;
						?>
						<?php
							}
						?>
			</div>
	<br/>
	<br/>
	<br/>
				<!--Botões !-->
	<div class="btn">
		<script> //Link para voltar à página anterior
			document.write('<a href="' + document.referrer + '">Voltar</a>');
		</script>
	</div>	

		<input type="submit" value="Salvar" class="btn">
	</table>
</form>
