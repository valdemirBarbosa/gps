<div class="base-home">
		<h1 class="titulo-pagina"><span class="cor">Editar</span> Processo Administrativo Disciplinar - PAD </h1>
		<div class="base-formulario">	

		<span class="qtde">Há <b><?php  echo count($pad)?></b> processo preliminares e sindicâncias</span>

		<form action="<?php echo URL_BASE ."Pad/Salvar" ?>" method="POST">

		<?php foreach($pad as $pd){ ?>
		<fieldset><legend><h4>Códigos</h4></legend>	
				<label>Id do PAD</label>
					<input name="txt_id_pad" enable="false" value="<?php echo $pd->id_pad ?>" >

				<label>Id da denuncia</label>
					<input name="txt_id_denuncia"  enable="false" value="<?php echo $pd->id_denuncia ?>" >

				<label>id_pp_sindicancia</label>
				<input type="number" name="txt_id_pp_sindicancia" value="<?php echo $pd->id_pp_sindicancia ?>" >
		</fieldset>		

				<label>Número do Processo</label>
					<input name="txt_numero_processo" type="text" placeholder="Insira o número do processo" value="<?php echo $pd->numero_processo ?>">
				
				<label>Data de Instauração</label>
					<input name="txt_data_instauracao" type="date" value="<?php echo $pd->data_instauracao ?>">

				<label>Observação</label>
					<input name="txt_observacao" type="text" value="<?php echo $pd->observacao ?>">

		<?php } ?>

				<input type="hidden" name="id" value="">
				<input type="submit" value="Salvar Alterações" class="btn">
				<input type="reset" name="Reset" id="button" value="Voltar" class="btn limpar">

		</form>

<!-- Formulário para anexar arquivos   		
		<form action="<?php echo URL_BASE .'Pad/Anexar' ?>" method="POST" multiple="multiple">
			<?php //$id_pad = $pd->id_pad; ?>
		<table>
		  <tr>
		    <td>
		        <input type="hidden" name="id_pad" value="<?php //id_pad = $pd->id_pad; ?>">
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
	