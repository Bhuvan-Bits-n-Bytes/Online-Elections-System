<?php 
    require 'dbcon.php';
								
		if (isset($_POST['save'])){
			$firstname=$_POST['firstname'];
			$lastname=$_POST['lastname'];
			$gender=$_POST['gender'];
			$phone_number=$_POST['phone_number'];
			$address=$_POST['address'];
			$col_name=$_POST['col_name'];
			$chng_col_name=$_POST['chng_col_name'];
			$id_number=$_POST['id_number'];
			$prog_study=$_POST['prog_study'];
			$pre_prog_study=$_POST['pre_prog_study'];
			$year_level=$_POST['year_level'];
			$password = $_POST['password'];
			$password1 = $_POST['password1'];
			$sec_question = $_POST['sec_question'];
			$date = date("Y-m-d H:i:s");
			$dob = $_POST['dob'];

			$query = $conn->query("SELECT * FROM ids WHERE id_number='$id_number'") or die ($conn->error);
			$count = $query->fetch_array();
	if ($count  < 1){
?>
	<script>
			alert( 'Invalid Student ID');
			window.location='index.php';
	</script>		
<?php
	}
	else{
		
		$query = $conn->query("SELECT * FROM voters WHERE id_number='$id_number'") or die ($conn->error);
		$count1 = $query->fetch_array();
		if ($count1 == 0) {
			if ($password == $password1) {
				$conn->query("insert into voters(id_number, password, firstname,lastname, gender, dob, phone_number, address, col_name, chng_col_name, prog_study, pre_prog_study, year_level, sec_question, status, date) VALUES('$id_number', '".md5($password)."','$firstname','$lastname', '$gender', '$dob', '$phone_number', '$address', '$col_name', '$chng_col_name', '$prog_study', '$pre_prog_study', '$year_level', '".md5($sec_question)."', 'Unvoted', '$date')");
			?>
	            <script>
			        alert( 'Successfully Registered');
			         window.location='../voters.php';
	            </script>
            <?php
			}else{
				?>
	            <script>
			        alert( 'Your Passwords Did Not Match');
			         window.location='index.php';
	            </script>
            <?php
			}
		}else{
			?>
	            <script>
			        alert( 'ID Already Registered');
			         window.location='../voters.php';
	            </script>
            <?php
		}
		

	}
} 
?>


					  