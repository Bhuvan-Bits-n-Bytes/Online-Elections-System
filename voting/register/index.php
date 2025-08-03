<?php include ('head.php'); ?>
<body>

    <div id="wrapper">
    	<?php    
        include ('index_banner.php');
        ?>
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="row">
					
					<div class="form-panel">
                      
                        <div class="form-body"> 

                         <form method="POST" enctype="multipart/form-data">
                         	
                                <div class="form-heading">
                         		<center>Voter Registration</center>
                         		</div>
										<div class="form-field">
											<label>Student ID</label><br/>
											<input class ="form-control" type = "text" name = "id_number" placeholder = "Student ID" required="true">
										</div>
										
										<div class="form-field">											
											<label>Password</label><br/>
												<input class="form-control"  type = "password" name = "password" id = "pass" placeholder="Password" required="true"/>
										</div>
										<div class="form-field">											
											<label>Retype Password</label><br/>
												<input class="form-control"  type = "password" name = "password1" id = "pass" placeholder="Retype Password" required="true"/>
										</div>

										<div class="form-field">
											<label>First Name</label><br/>
												<input class="form-control" type ="text" name = "firstname" placeholder="First Name" required="true">
										</div>
										
										<div class="form-field">
											<label>Last Name</label><br/>
												<input class="form-control"  type = "text" name = "lastname" placeholder="Last Name" required="true">
										</div>

										<div class="form-field">
											<label>Gender</label> <br/>
												<select class = "form-control" name = "gender">
													<option ></option>
													<option >Male</option>
													<option >Female</option>
													<option >Others</option>													
												</select>
										</div>

										<div class="form-field">
											<label>Date of Birth</label><br/>
											<input class="form-control" type="date" name="dob" max="<?php echo date('Y-m-d'); ?>"  min="2001-01-01" required="true">
										</div>

										<div class="form-field">
											<label>Phone Number <i>(Enter numbers without spaces)</i></label><br/>
											<input class="form-control" 
												type="tel" 
												name="phone_number" 
												placeholder="Enter 10-digit Phone Number" 
												pattern="[0-9]{10}" 
												maxlength="10" 
												title="Please enter a valid 10-digit phone number" 
												required="true">
										</div>

										<div class="form-field">
											<label>Address <i>(Residential or Hostel)</i></label><br/>
												<input class="form-control"  type = "text" name = "address" placeholder="Address (Residential or Hostel)" required="true">
										</div>


										<div class="form-field">
											<label>College Name</label><br/>
												<input class="form-control"  type = "text" name = "col_name" placeholder="College Name" required="true">
										</div>

										<div class="form-field">
											<label>Change of College  <i>(If applicable, enter your Previous College Name. Otherwise type NO)</i></label><br/>
												<input class="form-control"  type = "text" name = "chng_col_name" placeholder="Change of College(if applicable)" required="true">
										</div>
										
										<div class="form-field">
											<label>Program of Study <i>(enter initials only i.e CSE..)</i></label><br/>
												<input class="form-control"  type = "text" name = "prog_study" placeholder="E.g CSE" required="true">
										</div>

										<div class="form-field">
											<label>Previous Program of Study  <i>(If applicable, enter initials only i.e CSE,EC,EEE,CV,ME. Otherwise enter NO)</i></label><br/>
												<input class="form-control"  type = "text" name = "pre_prog_study" placeholder="E.g CSE,EC,EEE,CV,ME" required="true">
										</div> 


										<div class="form-field">
											<label>Select Study Level</label> <br/>
												<select class = "form-control" name = "year_level">
													<option>1st Year</option>
													<option>2nd Year</option>
													<option>3rd Year</option>
													<option>4th Year</option>
												</select>
										</div>

										<div class="form-field">
											<label>Secret Question<i>(What is your childhood name:)</i></label><br/>
												<input class="form-control"  type = "text" name = "sec_question" placeholder="Childhood Pet Name" required="true"/>
										</div>
										
											<br/>												 
                                        <center><button name = "save" type="submit">Register</button></center>
                                    

                           </div>
</br>
					<center><p><h4>After Succesfully Registering as shown in alert, Click the below Recognition button for Face Recognition and to login..</h4></p></center>
										</form>
										
										<?php
									// PHP script to trigger Flask API for face capture
									if ($_SERVER['REQUEST_METHOD'] === 'POST') {
									    // Call Flask API
									    $url = "http://127.0.0.1:5000/run-function";
									    
									    $data = json_encode(["name" => $_POST['id_number']]);
									    
									    $ch = curl_init();
									    curl_setopt($ch, CURLOPT_URL, $url);
									    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
									    curl_setopt($ch, CURLOPT_POST, true);
									    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
									    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
									    
									    $response = curl_exec($ch);
									    curl_close($ch);
									    
									    // Decode the Flask response
									    $result = json_decode($response, true);
									    
									    // Display feedback to the user
									    if ($result && $result['message']) {
									        echo "<h3>Face capture triggered successfully: " . $result['message'] . "</h3>";
											// header("Location: login.php");

									    } else {
									        $error_message = $result['error'] ?? 'Unable to communicate with the face capture system.';
									        echo "<h3>Error: " . $error_message . "</h3>";
									    }
									}
									?>

									
									<?php 
									require 'signUpData.php';
									?>

							</div>
						    
					</form>
					<div>
    <form method="post" action="">
        <center><button type="submit" name="recognize">Recognition</button></center>
    </form>


    <?php
    if (isset($_POST['recognize'])) {
        $idno = $_POST['idno'] ?? '';
        $password = $_POST['password'] ?? '';

        // Display camera feed
        echo "<h3>Please look at the camera for face recognition. The process will start shortly...</h3>";
        echo "<script>
            const videoElement = document.createElement('video');
            videoElement.style.width = '300px';
            videoElement.style.height = '200px';
            videoElement.autoplay = true;
            document.body.appendChild(videoElement);

            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    videoElement.srcObject = stream;
                })
                .catch(err => {
                    console.error('Camera access error:', err);
                });

            setTimeout(() => {
                videoElement.remove();
            }, 5000);
        </script>";

        // Wait 5 seconds before proceeding
        sleep(5);

        // If successful, execute API call
        $data = array('idno' => $idno, 'password' => $password);
        $url = 'http://localhost:5000/recognition';
        $options = array(
            'http' => array(
                'header'  => "Content-type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ),
        );
        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            echo 'Error during API call.';
        } else {
            echo 'API call successful: ' . $result;
            echo "<script>window.location.href = '../login.php';</script>";
        }
    }
    ?>
</div>

<?php 
include ('footer.php');
?>

</div>
<!-- /#wrapper -->
</body>
</html>
