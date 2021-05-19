<div class="base-home">
	<h1 class="titulo"><span class="cor">Alterar</span> denuncia</h1>
      <div class="base-formulario">	
	<form action="<?php echo URL_BASE ."denuncia/Salvar" ?>" method="POST">
		<label>id da denuncia</label>
			<input name="txt_id" value="<?php echo $denuncia->id_denuncia ?>" >
		<label>denunciante</label>
			<input name="txt_denunciante" value="<?php echo $denuncia->nome_denunciante ?>" type="text" >
		<label>documento</label>
			<input name="txt_documento" value="<?php echo $denuncia->tipo_documento ?>" type="text"> 
		<div class="col">
			<label>numero do documento</label>
			<input name="txt_num_doc" value="<?php echo $denuncia->numero_documento ?>" type="number">
		</div>	
		
		<div class="col">
			<label>data de entrada</label>
			<input name="txt_dt_entrada" value="<?php echo date('d/m/Y', strtotime($denuncia->data_entrada)); ?>" type="text" >
		</div>
		<div class="col">
			<label>denunciado</label>
			<input name="txt_denunciado" value="<?php echo $denuncia->nome ?>" type="text" >
		</div>	
		
		<div class="col">
			<label>id_denuciado</label>
			<input name="txt_id_denunciado" value="<?php echo $denuncia->id_denunciado ?>" type="text" >
		</div>

<!--		// trecho incluído 15/05/2021   !-->
		
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


		<input type="hidden" name="id_denuncia" value="<?php echo $denuncia->id_denuncia ?>">
		<input type="submit" value="Editar" class="btn">
		<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
	</form>
</div>	
</div>	
	