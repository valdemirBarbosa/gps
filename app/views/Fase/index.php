<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fase</title>
</head>
<body>
<form method="POST"  action="<?php echo  URL_BASE . "Fase/Salvar" ?>">
    <fieldset>
        <legend>Dados atuais do processo</legend><br/>
            <?php if(isset($tramitar)){
                foreach($tramitar as $p){ ?>
                <?php 
            } ?>
        <table>
            <tr>
                <td>        
                    <label>Id_processo</label>
                    <input type="number" name="txt_id_processo" value="<?php echo $p->id_processo ?>">

                    <label>id_denuncia</label>
                    <input type="number" name="txt_id_denuncia" value="<?php echo $p->id_denuncia ?>">

                    <label>Fase atual</label>
                    <input type="text" name="fase" value="<?php  echo $p->fase ?>">
                </td>
            </tr>    
            
            <tr>
                <td>        
                    <label>Número do Processo</label>
                    <input type="number" name="txt_numero_processo" value="<?php  echo $p->numero_processo ?>">
                    
                    <label>Data instauração</label>
                    <input type="date" name="txt_data_instauracao" value="<?php echo 
                     $p->data_instauracao ?>"><br/><br/>

                    <label>Data encerramento</label>
                    <input autofocus type="date" name="txt_data_encerramento" value="<?php echo $p->data_encerramento ?>">
                </td>
            </tr>
            
            <tr>
                <td>

                    <label>Observação</label>
                    <textarea readonly rows="3" cols="100">
                        <?php  echo $p->observacao ?> 
                    </textarea>
                </td>
            </tr>
        </table>

    </fieldset>
    <fieldset>
        <legend>Próxima fase</legend>
        <table>
            <tr><td>
            <label>Nova fase a tramitar</label>
                <select name="txt_fase">
                
                <?php foreach($fase as $f){?>
                <option  value="<?php echo $f->id_fase ?>"> <?php echo $f->fase ?> </option>
                    <?php } ?>
                </select>
            </td></tr>
            
            <tr><td>

            <label>Data instauração nova fase</label>
                    <input required type="date" name="txt_nova_data_instauracao" ><br/><br/>
            </td></tr>

            <tr>
                <td>
                    <label>Observação</label>
                    <textarea rows="3" cols="100" name="txt_observacao">
                    </textarea>
                </td>
            </tr>
        </table>
    </fieldset>

    <fieldset>
        <input type="submit" name="AlterarFase" value="Alterar Fase">
    </fieldset>
    <?php } ?>
</form>

</body>
</html>