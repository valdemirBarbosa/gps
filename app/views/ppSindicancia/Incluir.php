<div class="base-home">
		<h1 class="titulo"><span class="cor">Novo</span> Processo Sindicância</h1>
		<div class="base-formulario">	
			<form action="<?php echo URL_BASE ."PpSindicancia/Salvar" ?>" method="POST">
				<label>id</label>
					<input name="txt_id" class="txt-id" type="number" 
					enable="true">

				<label>Id da Denuncia</label>
					<input autofocus name="txt_id_denuncia" required  type="number" >

				<label for="fase">Escolha uma Fase</label>
					<select name="txt_fase" id="txt_fase">
						<option value="1">PROCEDIMENTO PRELIMINAR</option>
						<option value="2">SINDICÂNCIA</option>
					</select> 

				<label>Número do Processo</label>
					<input name="txt_numero_processo" type="text" placeholder="Insira o número do processo">
				
				<label>Data de Instauração</label>
					<input name="txt_data_instauracao" type="date" placeholder="Infome a data de instauração do processo">

				<label>Data de Ocorrência</label>
					<input name="txt_data_ocorrencia" type="date" placeholder="Infome a data de ocorrência de movimentação do processo">

				<label>Ocorrência</label>
					<input name="txt_ocorrencia" type="text" placeholder="Descreva a ocorrência / andamento / movimentação do processo">

				<label>Observação</label>
					<input name="txt_observacao" type="text" placeholder="Livre para observações">

<!--			
				<input type="hidden" name="acao" value="Cadastrar">
				<input type="hidden" name="id" value="">
!-->
				<input type="submit" value="Cadastrar" class="btn">
				<input type="reset" name="Reset" id="button" value="Limpar" class="btn limpar">
			</form>
		</div>	
</div>	
	