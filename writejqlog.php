<?php
$fp = fopen('jqlog.txt','a+');
fwrite($fp,'hello');
fclose($fp);
?>
