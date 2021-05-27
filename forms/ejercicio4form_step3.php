
<H2>Paso 3. Puesto y empresa.</H2>

<table>
<TR>
<TH>Nombre: </TH><TD><?=htmlspecialchars(stripslashes($data['nombre']??''))?></TD>
</TR>
<TR>
<TH>Apellidos: </TH><TD><?=htmlspecialchars(stripslashes($data['apellidos']??''))?></TD>
</TR>
<TR>
<TH>Teléfono: </TH><TD><?=htmlspecialchars(stripslashes($data['telefono']??''))?></TD>
</TR>
<TR>
<TH>Email: </TH><TD><?=htmlspecialchars(stripslashes($data['email']??''))?></TD>
</TR>
</table>
<br>

<form action="" method="post">
    <label for="fecha">Puesto:</label>        
    <input type="text" name="puesto" value="<?=askAgain($errors,$data,'puesto')?>">
    <?=userWarning($errors,'puesto')?>    
    <br>
    <label for="cantidad">Empresa</label>
    <input type="text" name="empresa" value="<?=askAgain($errors,$data,'empresa')?>">
    <?=userWarning($errors,'empresa')?>
    <br>    <br>

    <input type="hidden" name="step" value="forward">
    <input type="submit" value="¡Solicitar!">
</form>    <br>

<form action="" method="post">
    <input type="hidden" name="step" value="back">
    <input type="submit" value="Volver a paso 2">
</form>