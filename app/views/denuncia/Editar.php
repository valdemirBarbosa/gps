<div class="base-home">
		<h1 class="titulo-pagina">Alterar denúncia</h1>
	</div>

  <form enctype="multipart/form-data" action="<?php echo URL_BASE ."denuncia/Salvar" ?>" method="POST">

  	<?php
	  	$view = "denuncia/Index";
		$_SESSION['view'] = $view;
	?>
		<div class="EditarDenuncia">

		<br>
		<fieldset>
		<legend>Documentação</legend>
		<table>
			<tr>
				<th>numero documento</th>
				<th>tipo documento</th>
				<th>data de entrada</th>
			</tr>
			<tr>
			<td><input readonly type="text" value="<?php echo $denuncia->numero_documento ?>" name="numero"></td>
				<td> <?php echo $denuncia->tipo_de_documento ?> </td>
				<td><input readonly type="date" value="<?php echo $denuncia->data_entrada ?>"></td>
			</tr>
		</table>
		</fieldset>		
		
		<fieldset>
				<label>id:<?php echo $denuncia->id_denuncia ?></label>
				<input readonly name="txt_id" type="hidden" value="<?php echo $denuncia->id_denuncia ?>">

				<label>Narração dos fatos da denúncia</label>
				<textarea autofocus rows="1" cols="96" class="denuncia" name="txt_denuncia"><?php echo $denuncia->denuncia_fato ?></textarea>
				<br><br>
							
			<label>Denunciante</label>
			<select name="id_denunciante">
					<option value="<?php echo $denuncia->id_denunciante ?>"><?php echo $denuncia->nome_denunciante ?><option>
					<?php foreach($denunciante as $den){?>
						<option value="<?php echo $den->id_denunciante ?>"> <?php  echo $den->nome_denunciante  ?></option>
					<?php }  ?>	
			</select>
			<label>tipo de documento</label>
						<select name="id_tipo_doc">
							<option value="<?php echo $denuncia->id_tipo_documento ?>"> <?php echo $denuncia->tipo_de_documento ?> </option>
								<?php foreach($tipo_doc as $doc){?>
							<option value="<?php echo $doc->id_tipo_documento?>"> <?php echo $doc->tipo_de_documento ?> </option>
							<?php }  ?>	
						</select>

    		<label>Número</label>
				<input name="txt_numero_documento" type="text" value="<?php echo $denuncia->numero_documento ?>"  >

				<label for="dataMask">data de entrada</label>
						<input id="dataMask" name="txt_data_entrada" value="<?php echo $denuncia->data_entrada?>" type="date" required>

								<br>
					<label>Denunciados</label>
					<textarea rows="1" cols="67" name="txt_denunciados"><?php echo $denuncia->denunciados ?></textarea> 

					<label>Documentos anexados</label>
					<textarea rows="1" cols="59" clas="areaDenuncia" name="txt_documentos_anexados"><?php echo $denuncia->documentos_anexados?></textarea> 
						
						<br/><br/>
						<label id="obs">observação</label> 
						<textarea rows="1" cols="100" name="txt_observacao"><?php echo $denuncia->observacao?></textarea>

		</fieldset>		


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
				</tr>
				
				<?php if(isset($denunciados)){
					foreach($denunciados as $d){?>
				<tr>
					<td><?php echo $d->id_denunciado?> </td>
					<td><?php echo $d->matricula?> </td>
					<td><?php echo $d->nome_servidor?> </td>
					<td><?php echo $d->cpf?> </td>
					<td><?php echo $d->data_inclusao?> </td> 
		
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
