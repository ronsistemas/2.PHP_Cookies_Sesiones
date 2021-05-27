
<H2>Paso 4. Confirmación de registro.</H2>

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
<TR>
<TH>Puesto: </TH><TD><?=htmlspecialchars(stripslashes($data['puesto']??''))?></TD>
</TR>
<TR>
<TH>Empresa: </TH><TD><?=htmlspecialchars(stripslashes($data['empresa']??''))?></TD>
</TR>
</table>
<?php if (isset($saved) && $saved===true) { ?>

    <H1>¡¡Se registró tu solicitud para el evento!!</H1>

<?php  } elseif (isset($saved)) { ?>

    <H1>Hubo un problema registrando su solicitud. Contacte con el administrador del sistema.</H1>

<?php } ?>
<H2>Un agente se pondrá en contacto contigo</H2>
<form action="" method="post">
    <input type="hidden" name="step" value="clear">
    <input type="submit" value="¿Registrar otra solicitud?">
</form>