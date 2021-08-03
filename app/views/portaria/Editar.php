<div class="base-home">
	<h1 class="titulo-pagina">Alterar dados da Portaria</h1>
</div>

<form action="<?php echo URL_BASE ."Portaria/Salvar" ?>" method="POST">
	<legend><h4>ids</h4></legend>
		<?php foreach($portaria as $port){ ?>
		<fieldset>
			<legend><h4>Códigos</h4></legend>	
				<label>Id Portaria</label>
					<input id="txt_id" readonly name="txt_id_portaria" enable="false" value="<?php echo $port->id_portaria ?>" >

				<label>Número do Processo</label>
					<input id="txt_numero_processo" type="number" readonly name="txt_numero_processo" value="<?php echo $port->numero_processo?>" >
		</fieldset>		
		<fieldset>
			<legend>Informações da Portaria</legend>
				<label>Tipo</label>
					<input autofocus name="txt_tipo" type="text" placeholder="tipo da portaria" value="<?php echo $port->tipo ?>">

				<label>Número</label>
					<input name="txt_numero" type="number" placeholder="Insira o  Número da Portaria" value="<?php echo $port->numero ?>">
				
				<label>Data de elaboracao</label>
					<input name="txt_data_elaboracao" type="date" value="<?php echo $port->data_elaboracao ?>">

				<label>Conteúdo</label>
					<input name="txt_conteudo" type="text" placeholder="conteúdo da portaria" value="<?php echo $port->conteudo ?>">

				<label>Data Publicação</label>
					<input name="txt_data_publicacao" type="date" value="<?php echo $port->data_publicacao ?>">

				<label>Veículo</label>
					<input name="txt_veículo" type="text" placeholder="veículo da publicação" value="<?php echo $port->veiculo ?>">
				
				<label>Prazo</label>
					<input name="txt_prazo" type="number" placeholder="Prazo para cumprimento em dias" value="<?php echo $port->prazo ?>">
				
				<label>Data final</label>
					<input name="txt_data_final" type="date" value="<?php echo $port->data_final ?>">

				<label>Data realizada</label>
					<input name="txt_data_realizada" type="date" value="<?php echo $port->data_realizada ?>">

				<label>Prazo atendido</label>
					<input name="txt_prazo_atendido" type="text" placeholder="Prazo para cumprimento em dias" value="<?php echo $port->prazo ?>">
				
				<div class="obs">
					<label id="obs">observação</label> 
				</div>
				<textarea rows="4" cols="100" name="txt_observacao" 
					<?php echo $port->observacao ?> >
				</textarea>		
		</fieldset>
		<?php } ?>
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
	