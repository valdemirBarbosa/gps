<div class="base-home">
		<h1 class="titulo-pagina">Alterar denúncia</h1>
	</div>

  <form enctype="multipart/form-data" action="<?php echo URL_BASE ."denuncia/Salvar" ?>" method="POST">

  	<?php
	  	$view = "denuncia/Index";
		$_SESSION['view'] = $view;
	?>
		<div class="paiDenuncia">
		<div class="filho1Denuncia">

				<legend>
				<br>
				<label>id:<?php echo $denuncia->id_denuncia ?></label>
				<input name="txt_id" type="hidden" value="<?php echo $denuncia->id_denuncia ?>">

				<label>Narração dos fatos da denúncia</label>
				<br/><textarea autofocus rows="1" cols="96" class="denuncia" name="txt_denuncia"><?php echo $denuncia->denuncia_fato ?></textarea>
				<br><br>
							
			<label>Denunciante</label>
			<select name="lst_id_denunciante" class="optionDenunciante">
					<option value="<?php echo $denuncia->id_denunciante ?>"> <?php echo $denuncia->nome_denunciante. " - " .$denuncia->id_denunciante  ?></option>
					<?php foreach($denunciante as $den){?>
						<option value="<?php $den->id_denunciante  ?> "> <?php  echo $den->nome_denunciante. " - " .$den->id_denunciante  ?></option>
					<?php }  ?>	
			</select>
			<br/><label>tipo de documento</label>
						<select name="id_tipo_doc">
							<option value="<?php echo $denuncia->id_tipo_documento ?>"> <?php echo $denuncia->tipo_de_documento ?> </option>
								<?php foreach($tipo_doc as $doc){?>
							<option> <?php echo $doc->tipo_de_documento ?> </option>
							<?php }  ?>	
						</select>

    		<label>Número</label>
				<input name="txt_numero_documento" type="text" value="<?php echo $denuncia->numero_documento ?>"  >
						<br>
					<label for="dataMask">data de entrada</label>
						<input id="dataMask" name="txt_data_entrada" value="<?php echo $denuncia->data_entrada?>" type="date" required>

								<br>
					<label>Denunciados</label>
					<textarea rows="1" cols="67" name="txt_denunciados"><?php echo $denuncia->denunciados ?></textarea> <br/>

					<label>Documentos anexados</label>
					<textarea rows="1" cols="59" clas="areaDenuncia" name="txt_documentos_anexados"><?php echo $denuncia->documentos_anexados?></textarea> 
						
						<br/>
						<label id="obs">observação</label> 
						<textarea rows="1" cols="68" name="txt_observacao"><?php echo $denuncia->observacao?></textarea>

		</div> <!-- fim da classe filho1Denuncia -->

		<!-- ******************************************************************************************      -->
		<div class="">		
		<h2>Upload de arquivos</h2>
				<div class="">
					<div class="anexoFilho1">
						<input type="file" name="arquivo">
						<input type="hidden" name="view" value="<?php echo $view ?>">
					</div>

					<div class="">

						<label for="descricao">descrição</label>
						<input type="text" size="50" name="descricao">
						<label for="data_inclusao">data inclusão</label>
						<input type="text" name="data_inclusao" value="<?php echo date('d-m-Y H:m:s'); ?>">
						<input size="100px" type="submit" value="Alterar" class="">


						<!-- <input type="hidden" name="view" value="<?php //echo "denuncia/Edit/".$denuncia->id_denuncia  ?>"> -->
					</div>
					
				</div>

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
					foreach($anexo as $a){?>
				<tr>
					<td><?php echo $a->id_upload?> </td>
					<td><?php echo $a->id_denuncia?> </td>
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
				<?php } }?>
			</table>
			</div> <!-- fim da classe filho2Denuncia -->
			</div> <!-- fim da classe paiDenuncia -->

<!-- tabela de denunciados !--> 
<fieldset>
			<legend>Denunciados</legend>
			<table>
				<tr>
					<th>id</th>
					<th>Matricula</th>
					<th>Nome</th>
					<th>CPF</th>
					<th>data inclusão</th>
					<th colspan="2">acao</th>
				</tr>
				
				<?php if(isset($denunciados)){
					foreach($denunciados as $d){?>
				<tr>
					<td><?php echo $d->id_denunciado?> </td>
					<td><?php echo $d->matricula?> </td>
					<td><?php echo $d->nome_servidor?> </td>
					<td><?php echo $d->cpf?> </td>
					<td><?php echo $d->data_inclusao?> </td> 
					<td>Editar </td> 
					<td>Excluir </td> 
		
				</tr>
				<?php } }?>
			</table>
			</fieldset>	

			<div class="">
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
