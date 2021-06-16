<div class="base-home">
		<h1 class="titulo"><span class="cor">Novo</span> Processo Administrativo Disciplinar - PAD </h1>
		<div class="base-formulario">	
			<form action="<?php echo URL_BASE ."Pad/Salvar" ?>" method="POST">
			
				<label>Id do PAD</label>
					<input name="txt_id_pad" enable="false" readonly  >

					<label>Id da denuncia</label>
					<input name="txt_id_denuncia" enable="false" readonly >

					<label>Id do pp_sindicancia</label>
					<input name="txt_id_pp_sindicancia"  enable="false" readonly >

				<label>Número do Processo</label>
					<input autofocus name="txt_numero_processo" type="text" placeholder="Insira o número do processo">
				
				<label>Data de Instauração</label>
					<input name="txt_data_instauracao" type="date" >

				<label>Observação</label>
					<input name="txt_observacao" type="text" placeholder="Livre para observações">

					<label>Anexo</label>
					<input name="txt_anexo" type="file" >

				<input type="submit" value="Cadastrar" class="btn">
				<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
			</form>
		</div>	
</div>	
	