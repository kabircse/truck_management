
<?php 
echo "<option value=''>Select Please</option>";
foreach ($results as $result) {
	 echo "<option value='".$result['id']."'>".$result[$field]."</option>";
}

?>