<form method="POST"  action="<?php echo  URL_BASE . "Fase/Salvar" ?>">
<fieldset>
        <legend>Dados atuais do processo</legend><br/>
            <?php if(isset($tramitar)){
                foreach($tramitar as $p){ ?>
                <?php 
            } ?>
                    <label>Id_processo</label>
                    <input type="number" name="txt_id_processo" value="<?php echo $p->id_processo ?>">

                    <label>id_denuncia</label>
                    <input type="number" name="txt_id_denuncia" value="<?php echo $p->id_denuncia ?>">

                    <label>Fase atual</label>
                    <input type="text" name="fase" value="<?php  echo $p->fase ?>">
                    <input type="number" name="txt_id_fase" value="<?php  echo $p->id_fase ?>">
                    <label>Número do Processo</label>
                    <input type="number" name="txt_numero_processo" value="<?php  echo $p->numero_processo ?>">
                    
                    <label>Data instauração</label>
                    <input type="date" name="txt_data_instauracao" value="<?php echo 
                     $p->data_instauracao ?>"><br/><br/>

                    <label>Observação</label>
                    <textarea disabled readonly rows="2" cols="126">
                        <?php  echo $p->observacao ?> 
                    </textarea>

                    <label>Data encerramento da fase: <?php  echo $p->fase ?></label>
                    <input autofocus type="date" name="txt_data_encerramento" value="<?php echo $p->data_encerramento ?>">


    </fieldset>
    <fieldset>
        <legend>Próxima fase</legend>
            <label>Nova fase a tramitar</label>
                <select name="txt_id_nova_fase">
                    
                <?php foreach($fase as $f){?>
                <option readonly value="<?php echo $f->id_fase ?>"> <?php echo $f->fase ?> </option>
                    <?php } ?>
                </select>

            <label>Número</label>
      		<input name="txt_numero_processo_novo" type="number" required>

            <label>Data instauração nova fase</label>
                    <input required type="date" name="txt_nova_data_instauracao" ><br/><br/>
            <div>
                <label>observação</label>
	        		<input name="txt_observacao" type="text" size="110" cols="40" rows="2" value="<?php echo $p->observacao ?>" >
		    </div>
    </fieldset>

    <fieldset>				
			<input type="hidden" name="acao" value="Editar">
				<input type="submit" value="Mudar" class="btn">
				<input type="reset" name="Reset" id="button" value="Limpar" class="btn">
				<input name="Voltar" onclick="history.back()" type="submit" value="Voltar" class="btn">
			</fieldset>
	</form>
    <?php } ?>
    <div class="fim">
	</div>
