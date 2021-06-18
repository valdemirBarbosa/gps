<div class="base-home">
		<h1 class="titulo"><span class="cor">Novo</span>Ocorrencias/Andamento</h1>
		<div class="base-formulario">	
			<form action="<?php echo URL_BASE ."Ocorrencia/Salvar" ?>" method="POST">
			
				<label>Id ocorrencia</label>
					<input name="txt_id_ocorrencia" enable="false" readonly  >

					<label>Id fase</label>
					<input name="txt_id_fase" enable="false" readonly >

				<label>Número do Processo/Documento</label>
					<input autofocus name="txt_numero_processo" type="text" placeholder="Insira o número do processo">
				
				<label>Data de ocorrencia</label>
					<input name="txt_data_ocorrencia" type="date" >

				<label>Ocorrencia/Andamento</label>
					<input name="txt_ocorrencia" type="text" >

				<label>Observação</label>
					<input name="txt_observacao" type="text" placeholder="Livre para observações">

					<label>Anexo</label>
					<input name="txt_anexo" type="file" >

				<input type="submit" value="Cadastrar" class="btn">
				<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
			</form>
		</div>	
</div>	
	