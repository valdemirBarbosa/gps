<div class="base-home">
		<h1 class="titulo-pagina">Alterar denúncia</h1>
	</div>

  <form enctype="multipart/form-data" action="<?php echo URL_BASE ."denuncia/Salvar" ?>" method="POST">

  	<?php
	  	$view = "denuncia/Index";
		$_SESSION['view'] = $view;
	?>
		<fieldset>
		<legend><h4>DENÚNCIA</h4></legend>
			<label>id denuncia</label>
				<input id="txt_id" name="txt_id" value="<?php echo $denuncia->id_denuncia ?>" >

			<label>Naração dos fatos da denúncia</label>
		      	<textarea rows="2" cols="90" clas="denuncia" name="txt_denuncia"> <?php echo $denuncia->denuncia_fato ?>
				</textarea>
		</fieldset>
	
		<fieldset>
 		<label class="denunciante">Denunciante</label>
		 <select name="lst_id_denunciante">
				<option value="<?php echo $denuncia->id_denunciante ?>"> <?php echo $denuncia->nome_denunciante. " - " .$denuncia->id_denunciante  ?></option>
				<?php foreach($denunciante as $den){?>
 					<option value="<?php $den->id_denunciante  ?> "> <?php  echo $den->nome_denunciante. " - " .$den->id_denunciante  ?></option>
				<?php }  ?>	
		</select>

					<label>tipo de documento</label>
					<select name="id_tipo_doc">
						<option value="<?php echo $denuncia->id_tipo_documento ?>"> <?php echo $denuncia->tipo_de_documento ?> </option>
							<?php foreach($tipo_doc as $doc){?>
						<option> <?php echo $doc->tipo_de_documento ?> </option>
						<?php }  ?>	
					</select>
		</fieldset>

		<fieldset>
			<label>numero do documento</label>
					<input name="txt_numero_documento" type="text" value="<?php echo $denuncia->numero_documento ?>"  >

				<label for="dataMask">data de entrada</label>
					<input id="dataMask" name="txt_data_entrada" value="<?php echo $denuncia->data_entrada?>" type="date" required>

				</fieldset>					
			<fieldset>
				<label>Denunciados</label>
				<textarea rows="1" cols="110"  name="txt_denunciados">
						<?php echo $denuncia->denunciados ?> 
				</textarea> <br/>

				<label>Documentos anexados</label>
				<textarea rows="1" cols="102"  clas="areaDenuncia" name="txt_documentos_anexados">
							<?php echo $denuncia->documentos_anexados ?> 
				</textarea> 
					
					<br/>
					<label id="obs">observação</label> 
					<input type="text" size="116" name="txt_observacao" value="<?php echo $denuncia->observacao ?>"> 

			</fieldset>

<!-- ******************************************************************************************      -->
			
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
				<input type="text" name="data_inclusao" value="<?php echo date('d-m-Y H:m:s'); ?>">
				<!-- <input type="hidden" name="view" value="<?php //echo "denuncia/Edit/".$denuncia->id_denuncia ?>"> -->
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
			
			<?php if(isset($anexo)){
				print_r($anexo);
				exit;
				
					foreach($anexo as $a){?>
			<tr>
				<td><?php echo $a->id_upload?> </td>
				<td><?php echo $a->id_denuncia?> </td>
				<td><?php echo $a->arquivo?> </td>
				<td><?php echo $a->descricao?> </td>
				<td><?php echo $a->data_inclusao?> </td> <br><br><br>
				<?php
					$caminho = $a->caminho;
					$arquivo = $a->arquivo;
				?>
	
				<td> <!-- DOWNLOAD DE ARQUIVOS  !-->
					<a href="<?php echo URL_BASE . 'downloads/?path='.$caminho.'&file='.$arquivo ?>"> baixar </a>
					
				</td>
			</tr>
			<?php } }?>
		</table>
	</fieldset>
	

			<fieldset>				
				<input type="hidden" name="acao" value="Editar">
				<input type="hidden" name="id" value="<?php echo $denuncia->id_denuncia ?>">
				<input type="submit" value="Alterar" class="btn">
				<input type="reset" name="Reset" id="button" value="Limpar" class="btn">
				<input name="Voltar" onclick="history.back()" type="submit" value="Voltar" class="btn">
			</fieldset>
	<div class="fim">
	</div>
</form>
