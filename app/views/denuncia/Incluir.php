<div class="base-home">
		<h1 class="titulo"><span class="cor">Novo</span> cadastro</h1>
		<div class="base-formulario">	
			<form action="<?php echo URL_BASE ."denuncia/Salvar" ?>" method="POST">
				<label>id_denuncia</label>
					<input name="txt_id" class="txt-id" type="number" >

				<label>denúncia</label>
					<input name="txt_denuncia" required autofocus  type="text" placeholder="Insira aqui a naração dos fatos da denúncia">

				<label>id_denunciante</label>
					<input name="txt_id_denunciante" required type="text" placeholder="Insira o denunciante">

				<div class="col">
					<label>tipo de documento</label>
					<input name="txt_tipo_documento" value="" type="text" placeholder="Insira o tipo de documento anexado">
				</div>	
				
				<div class="col">
					<label>número do documento</label>
					<input name="txt_numero_documento" value="" type="number" placeholder="número do documento">
				</div>

				<div class="col">
					<label>data de entrada</label>
					<input name="txt_data_entrada" value="" type="date" placeholder="00/00/0000">

					<label>observação</label>
					<input name="txt_observacao" value="" type="text" placeholder="Insira observações">
				</div>	
				
				
				<input type="hidden" name="acao" value="Cadastrar">
				<input type="hidden" name="id" value="">
				<input type="submit" value="Cadastrar" class="btn">
				<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
			</form>
		</div>	
</div>	
	