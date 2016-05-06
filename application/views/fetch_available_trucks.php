<?php
   echo "<option value=''>Select Please</option>";
foreach($trucks as $truck){
    echo "<option value='".$truck['truck_id']."'>".$truck['truck_number']."</option>";
    
}
?>