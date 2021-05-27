
<H2>Paso 2. Teléfono e email.</H2>

<div>
<table>
<TR>
<TH>Nombre: </TH><TD><?=htmlspecialchars(stripslashes($data['nombre']??''))?></TD>
</TR>
<TR>
<TH>Apellidos: </TH><TD><?=htmlspecialchars(stripslashes($data['apellidos']??''))?></TD>
</TR>
</table>
</div><br>
<div>
<form action="" method="post">
    <div>
    <label for="fecha">Teléfono:</label>        
    <input type="text" name="telefono" value="<?=askAgain($errors,$data,'telefono')?>">
    <?=userWarning($errors,'telefono')?>    
    </div>
    <div>
    <label for="cantidad">Email:</label>
    <input type="text" name="email" value="<?=askAgain($errors,$data,'email')?>">
    <?=userWarning($errors,'email')?>
    </div>
    <input type="hidden" name="step" value="forward">
    <br>
    <div>
    <input type="submit" value="Ir a paso 3">
    </div>
</form>
</div>
<br>
<form action="" method="post">
    <input type="hidden" name="step" value="back">
    <input type="submit" value="Volver a paso 1">
</form>