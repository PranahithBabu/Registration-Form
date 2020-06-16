<?php  
require_once('config.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<link rel="stylesheet" type="text/css" href="css/registration.css">
</head>
<body>
<div>
	<?php  
	if(isset($_POST['create'])){
		$name = $_POST['name'];
		$email = $_POST['email'];
		$phonenumber = $_POST['phonenumber'];
		$branch = $_POST['branch'];

		$sql ="INSERT INTO users (name, email, phonenumber, branch ) VALUES(?,?,?,?,?)";
		$stmtinsert = $db->prepare($sql);
		$result = $stmtinsert->execute([$name, $email, $phonenumber, $branch]);
		if($result){
			echo "Submitted successfully";
		}
		else {
			echo "Errors found while submitting";
		}
	}
	?>
</div>
	<div>
		<form action="index.php" method="post">
			<div class="container">
				<h1>Registration Form</h1>
				<div class="inner_container">
				<label for="name"><b>Full Name</b></label>
				<input type="text" id="name" placeholder="Enter Name" name="name" required>
				<br>
				<br>
				<label for="email"><b>E-mail Id</b></label>
				<input type="E-mail" id="email" placeholder="Enter E-mail Id" name="email" required>
				<br>
				<br>
				<label for="phonenumber"><b>Phone Number</b></label>
				<input type="text" id="phonenumber" placeholder="Enter Phone Number" name="phonenumber" required>
				<br>
				<br>
				<label for="branch"><b>Branch</b></label>
					<select name="branch" id="branch" required>
						<option value="CSE">CSE</option>
						<option value="IT">IT</option>
						<option value="ECE">ECE</option>
						<option value="Mechanical">Mechanical</option>
						<option value="EEE">EEE</option>
						<option value="Mechatronics">Mechatronics</option>
						<option value="Civil">Civil</option>
					</select>
				<input id="submit_btn" type="submit" name="submit" value="Submit">
				<input id="reset_btn" type="reset" name="reset" value="Reset">
			</div>
		</form>
	</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
<script type="text/javascript">
	$(function(){
		$('#register').click(function(e){

			var valid = this.form.checkValidity();

			if(valid){
				var name = $('#name').val();
				var email = $('#email').val();
				var phonenumber = $('#phonenumber').val();
				var branch = $('#branch').val();

				e.preventDefault();	

				$.ajax({
					type: 'POST',
					url: 'process.php',
					data: {name: name,email: email,phonenumber: phonenumber,branch: branch},
					success: function(data){
					Swal.fire({
								'title': 'Successful',
								'text': data,
								'type': 'success'
								})
							
					},
					error: function(data){
						Swal.fire({
								'title': 'Errors',
								'text': 'There were errors while saving the data.',
								'type': 'error'
								})
					}
				});

				
			}else{
				
			}

			



		});		

		
	});
	
</script>
</body>
</html>