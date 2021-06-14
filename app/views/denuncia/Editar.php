<div class="base-home">
	<h1 class="titulo"><span class="cor">Alterar</span> denuncia</h1>
      <div class="base-formulario">	
	<form action="<?php echo URL_BASE ."denuncia/Salvar" ?>" method="POST">
		<label>id da denuncia</label>
			<input name="txt_id" value="<?php echo $denuncia->id_denuncia ?>" >

		<label>Naração dos fatos da denúncia</label>
			<input name="txt_denuncia" value="<?php echo $denuncia->denuncia_fato ?>" type="text" />

		<label>id_denunciante</label>
			<input name="txt_id_denunciante" value="<?php echo $denuncia->id_denunciante ?>" type="number" >
		
		<label>denunciante</label>
			<input name="txt_denunciante" value="<?php echo $denuncia->nome_denunciante ?>" type="text">
		<label>Tipo de documento</label>
			<input name="txt_tipo_documento" value="<?php echo $denuncia->tipo_documento ?>" type="text"> 

		<div class="col">
		<label>numero do documento</label>
			<input name="txt_numero_documento" type="text" value="<?php echo $denuncia->numero_documento ?>"  >

		<label>data de entrada</label>
			<input id="dataMask" name="txt_data_entrada" value="<?php echo date('d/m/Y', strtotime($denuncia->data_entrada)); ?>" type="date" >

		<label>Observação</label>
			<input type="text" name="txt_observacao" value="<?php echo $denuncia->observacao ?>"  > 

		</div>
		
		<input type="hidden" name="id_denuncia" value="<?php echo $denuncia->id_denuncia ?>">
		<input type="submit" value="Editar" class="btn">
		<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
	</form>
</div>	
</div>	
	