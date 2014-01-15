<?php
 
if ( $_POST['payload'] ) {
  shell_exec( 'git reset --hard HEAD && git pull https://github.com/littlehawk93/DBMS-Project.git' );
}else {
	header("Location: index.html");
}
 
?>
