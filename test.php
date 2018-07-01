<?php
$password= 'haha';
$new_pass= '$2y$10$iJrZf6AD/76aWN5EFWFSluyAdhvt7p4WuGBmtQUnrpSBoTxfvTWoa';
$has = password_hash($password, PASSWORD_DEFAULT, array('cost' => 10));
echo strlen($new_pass);
echo "<br/>";
echo strlen($has);
if(password_verify($password, $new_pass)){
echo "yes";}
else{echo "no";};
?>