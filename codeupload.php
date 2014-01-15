<?php
 
if ( $_POST['payload'] ) {
  shell_exec( './update.sh' );
}else {
	header("Location: index.html");
}
 
?>
