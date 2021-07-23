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
            <?php if(isset($processo)){
                foreach($processo as $p){ ?>
                
                    <label>Id_processo</label>
                    <input type="number" name="id_processo" value="<?php echo $p->id_processo ?>"><br/><br/>

                    <label>Id_Fase atual</label>
                    <input type="number" name="id_fase" value="<?php echo $p->id_fase ?>"><br/><br/>
                    
                    <label>Fase atual</label>
                    <input type="text" name="fase" value="<?php echo $p->fase ?>">
                <?php } ?>
    </fieldset>

    <fieldset>
        <legend>Próxima fase</legend>
            <label>Id_processo</label>
            <input type="number" name="id_processo" value="<?php echo $processo->id_processo ?>"><br/><br/>

            <label>Nova fase a tramitar</label>
            <?php foreach($fase as $f){}?>
                <select name="fase">
                    <option value="<?php $f->id_fase ?>"> <?php echo $f->fase ?> </option>
                </select>

                <input type="submit" name="Alterar Fase">

    </fieldset>
</form>

</body>
</html>