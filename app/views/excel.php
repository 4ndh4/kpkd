<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache, must-revalidate");
header("Content-type: application/x-msdownload");
header("Content-Disposition: attachment; filename=$filename.xls");          
echo $excel;
?>

