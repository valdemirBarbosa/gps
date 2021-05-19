<div class="base-home">
			<h1 class="titulo"><span class="cor">Nova</span> denúncia</h1>
		<div class="base-formulario">	
			<form action="<?php echo URL_BASE ."denuncia/Salvar" ?>" method="POST">

			<div class="col">
				<label>id</label>
					<input name="txt_id" disabled type="number">
			</div>

			<div class="col">
					<label>id_denunciante</label>
					<input name="txt_id_denunciante"  type="text"autofocus placeholder="Insira o id do denunciante"  >
			</div>

			<div class="col">
				<label>denuncia</label>
					<input name="txt_denuncia" required  type="text" placeholder="Insira a denuncia com até 255 caracteres">
			</div>

				
				<div class="col">
					<label>tipo_documento</label>
					<input name="txt_tipo_documento" value="" type="text" placeholder="Insira o tipo de documento (ofício, CI, bilhete, etc...">
				</div>	
				
				<div class="col">
					<label>numero do documento</label>
					<input name="txt_numero_documento" value="" type="number" placeholder="número do documento">
				</div>

				<div class="col">
					<label>data_entrada</label>
					<input name="txt_data_entrada" value="" type="date" placeholder="data de entrada da documentação na Coordenadoria">	
				</div>

					<label>observações</label>
					<input name="txt_observacao" value="" type="text" placeholder="Insira as observações com até 255 caracteres">
			<table>
			<tr><td>
			<form action="<?php echo URL_BASE."denunciado/adicionar"?>" method="POST">
			    <label for="denunciante">Informe o nome do denunciado</label>
					<select  name="denunciante" id="denunciante">			
					<?php foreach($denunciado as $den){?>
						<option selected="0" value="<?php echo $den->id_denunciado; ?>">
							<?php echo $den->nome." - ".$den->cpf ?>
					  	</option> 
					  <?php } ?>
					</select>
					<td><input type="submit" value="+" class="btn"></td>
					
			</form></tr>
			</table>

			<table>
				<tr>
					<td><label>Nome</label> <input type="text" value=""></td>
					<td><label>Cpf</label> <input type="number" value=""></td>
				</tr>

				<tr>
					<?php foreach($denunciado as $d){}?>
						<td><?php echo $d->nome?></td>
						<td><?php echo $d->cpf?></td>
				</tr>
			</table>


			<table
				<input type="hidden" name="acao" value="Cadastrar">
				<input type="hidden" name="id" value="">
				<input type="submit" value="Cadastrar" class="btn">
				<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
			</form>
		</div>	
</div>	
	