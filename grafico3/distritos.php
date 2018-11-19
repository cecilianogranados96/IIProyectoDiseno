<option value=''>Todos</option>
<?php 
include "../config.php";
    $sth = mysqli_query($link,"SELECT DISTINCT(distrito.distrito),distrito.id_distrito FROM canton,distrito,`accidente` WHERE canton.id_canton = accidente.canton and distrito.id_distrito = accidente.distrito and canton.id_canton = ".$_POST['canton']." ORDER by distrito.distrito"); 
    while($r = mysqli_fetch_assoc($sth)) {
       echo "<option value='".utf8_encode($r['id_distrito'])."'>".utf8_encode($r['distrito'])."</option>";
    } 
?>   