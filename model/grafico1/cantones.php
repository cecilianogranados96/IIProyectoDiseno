<option value=''>Todos</option>
<?php 
include "../../config.php";

    $sth = mysqli_query($link,"SELECT DISTINCT(canton.canton),canton.id_canton FROM canton,provincia,`accidente` WHERE canton.id_canton = accidente.canton and provincia.id_provincia = accidente.provincia and provincia.id_provincia = ".$_POST['provincia']." ORDER by canton.canton"); 
    while($r = mysqli_fetch_assoc($sth)) {
       echo "<option value='".utf8_encode($r['id_canton'])."'>".utf8_encode($r['canton'])."</option>";
    } 
               
            ?>   