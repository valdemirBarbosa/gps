<div class="base-home">
	<h1 class="titulo-pagina"><span class="cor">Incluir </span>nova Portaria</h1>
</div>
<form action="<?php echo URL_BASE ."portaria/Salvar" ?>" method="POST">
		<fieldset>
			<legend><h4>Códigos</h4></legend>	

				<label>Id do Processo</label>
				<input id="txt_id_processo" type="number"  name="txt_id_processo" value="<?php foreach($vincProcess as $vp){ echo $vp->id_processo; }?>">

				<label>Número do Processo</label>
				<input value="<?php echo $vp->numero_processo; ?>"  id="txt_numero_processo" type="number"  name="txt_numero_processo">

				<label>fase</label>
					<input autofocus name="txt_id_fase" type="number" min="1" max="3" placeholder="Id da portaria de 1 a 3" required>
			</fieldset>		

		<fieldset>
		<table>
			<tr><td>
			<legend>Informações da Portaria</legend>
				<label>Tipo</label>
					<input name="txt_tipo" type="text" placeholder="tipo da portaria" required>

				<label>Número da Portaria</label>
					<input name="txt_numero" type="number" placeholder="Insira o  Número da Portaria" required>
				
				<label>Data de elaboracao</label>
					<input name="txt_data_elaboracao" type="date" required>
			</td>
			</tr>

			<tr>
			<td>
			
				<label>Data de publicação</label>
					<input name="txt_data_publicacao" type="date" required>

				<label>Veículo</label>
					<input name="txt_veículo" type="text" placeholder="veículo da publicação" required>

									
				<label>Prazo</label>
					<input name="txt_prazo" min="1" type="number" placeholder="Prazo para cumprimento em dias" required>
				
			</td>
			</tr>

			<tr>
			<td>
	
				<label>Conteúdo</label>
					<textarea name="txt_conteudo" rows="4" cols="100" placeholder="redação da portaria">
				</textarea> 
			</td>
			</tr>

			<tr>
			<td>
	
				<div class="obs-portaria">
					<label id="obs">observação</label> 
				</div>
				<textarea rows="2" cols="112" name="txt_observacao">
				</textarea>
			</td>
			</tr>
		</table>		
		</fieldset>
				<input type="submit" value="Salvar" class="btn">
				<input type="reset" name="Reset" id="button" value="Voltar" class="btn limpar">

		</form>

<!-- Formulário para anexar arquivos   		
		<form action="<?php echo URL_BASE .'Pad/Anexar' ?>" method="POST" multiple="multiple">
			<?php //$id_pad = $port->id_pad; ?>
		<table>
		  <tr>
		    <td>
		        <input type="hidden" name="id_pad" value="<?php //id_pad = $port->id_pad; ?>">
		 	  <input type="file" name="arquivo"></label>
		    <td>
		    <td>
		  	 <input type="submit" value="Anexar arquivo">
		    </td>
		  </tr>
		</table>
		</form>	!-->
		</div>	
</div>	
	