<?php
	$check_user_id = CCGetUserID();
	if(empty($check_user_id)){
		echo "<script>
			top.top.location.href='index.php'
		</script>
		";
		exit;
	}
?>