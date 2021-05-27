
    <H2>Paso 1. Nombres y apellidos.</H2>

    <form action="" method="post">
    <div>
        <label for="fecha">Nombre:</label>        
        <input type="text" name="nombre" value="<?=askAgain($errors,$data,'nombre')?>">
        <?=userWarning($errors,'nombre')?>    
    </div>
    <div>
    <label for="cantidad">Apellidos:</label>
    <input type="text" name="apellidos" value="<?=askAgain($errors,$data,'apellidos')?>">
    <?=userWarning($errors,'apellidos')?>    
    </div>
    <div>
    <input type="hidden" name="step" value="forward"><br>    
    <button type="submit">Ir a paso 2</button>
</div>
</form>
