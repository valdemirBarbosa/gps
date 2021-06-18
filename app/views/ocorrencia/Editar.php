<div class="base-home">
		<h1 class="titulo"><span class="cor">Editar</span> Ocorrencia/Andamento - PAD </h1>
		<div class="base-formulario">	

		<span class="qtde">Há <b><?php  echo count($ocorrencia)?></b> processo preliminares e sindicâncias</span>

		<form action="<?php echo URL_BASE ."Ocorrencia/Salvar" ?>" method="POST">

		<?php foreach($ocorrencia as $ocor){ ?>
				<label>Id do PAD</label>
					<input name="txt_id_ocorrencia" enable="false" value="<?php echo $ocor->id ?>" >

				<label>Id fase</label>
					<input name="txt_id_fase"  enable="false" value="<?php echo $ocor->id_fase ?>" >

				<label>Número do Processo</label>
					<input name="txt_numero_processo" type="text" placeholder="Insira o número do processo" value="<?php echo $ocor->numero_processo ?>">
				
				<label>Data da ocorrencia</label>
					<input name="txt_data_ocorrencia" type="date" value="<?php echo $ocor->data_ocorrencia ?>">

				<label>Ocorrencia</label>
					<input name="txt_ocorrencia" type="text" value="<?php echo $ocor->ocorrencia ?>">

				<label>Observação</label>
					<input name="txt_observacao" type="text" value="<?php echo $ocor->observacao ?>">

		<?php } ?>
		</form>

<!-- Formulário para anexar arquivos  !--> 		
		<form action="<?php echo URL_BASE .'Pad/Anexar' ?>" method="POST" multiple="multiple">
			<?php $id = $ocor->id; ?>
		<table>
		  <tr>
		    <td>
		        <input type="hidden" name="id" value="<?php $id = $ocor->id; ?>">
		 	  <input type="file" name="arquivo"></label>
		    <td>
		    <td>
		  	 <input type="submit" value="Anexar arquivo">
		    </td>
		  </tr>
		</table>
		</form>	
				<input type="submit" value="Salvar Alterações" class="btn">
				<input type="reset" name="Reset" id="button" value="Voltar" class="btn limpar">
		</div>	
</div>	
	