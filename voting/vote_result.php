<?php include ('head.php');?>
<?php include ('sess.php');?>

<body>
<?php include 'side_bar.php'; ?>
    <div id="row">
        <?php
			if(ISSET($_POST['submit']))
				{
					if(!ISSET($_POST['pres_id']))
					{
						$_SESSION['pres_id'] = "";
					}
					else
					{
						$_SESSION['pres_id'] = $_POST['pres_id'];
					}
					if(!ISSET($_POST['vp_id']))
					{
						$_SESSION['vp_id'] = "";
					}
					else
					{
						$_SESSION['vp_id'] = $_POST['vp_id'];
					}
					if(!ISSET($_POST['ua_id']))
					{
						$_SESSION['ua_id'] = "";
					}
					else
					{
						$_SESSION['ua_id'] = $_POST['ua_id'];
					}

				}
		?>
    </div>
			<center>
		  <div class="col-lg-8" style = "margin-left:25%; margin-right:25%;" >
		  <div class = "alert alert-info">
			<div class="panel-heading"><center>PRESIDENT</center></div>
			<br />
			<?php
				if(!$_SESSION['pres_id'])
					{
						
					}
				else
					{
						$fetch = $conn->query("SELECT * FROM `candidate` WHERE `candidate_id` = '$_SESSION[pres_id]'")->fetch_array();
						
						echo $fetch['firstname']." ".$fetch['lastname']." "."<img src = 'admin/".$fetch['img']."' style = 'height:80px; width:80px; border-radius:500px;' />"; 
					}
			?>
			</div>
			<div class = "alert alert-success" >
			<div class="panel-heading"><center>VICE PRESIDENT</center></div>
			<br />
			<?php
				if(!$_SESSION['vp_id'])
					{
						
					}
				else
					{
						$fetch = $conn->query("SELECT * FROM `candidate` WHERE `candidate_id` = '$_SESSION[vp_id]'")->fetch_array();
						echo $fetch['firstname']." ".$fetch['lastname']." "."<img src = 'admin/".$fetch['img']."' style = 'height:80px; width:80px; border-radius:500px;' />"; 
					}
			?>
			</div>
			<div class = "alert alert-info">
			<div class="panel-heading"><center>UNION ADVISOR</center></div>
			<br/>
			<?php
				if(!$_SESSION['ua_id'])
					{
						
					}
				else
					{
						$fetch = $conn->query("SELECT * FROM `candidate` WHERE `candidate_id` = '$_SESSION[ua_id]'")->fetch_array();
						echo $fetch['firstname']." ".$fetch['lastname']." "."<img src = 'admin/".$fetch['img']."' style = 'height:80px; width:80px; border-radius:500px;' />"; 
					}
			?>
				
			</div>
			<br />
			</div>
	</center>


                                    <div class="modal-body">
										<p><center>Are you sure you want to submit your Votes? </center></p>
                                    </div>
									
									<div class="modal-footer">
    <center>
        <button type="button" class="btn btn-success" onclick="submitVote()">
            <i class="icon-check"></i>&nbsp;Yes
        </button>
        <a href="vote.php">
            <button class="btn btn-danger" aria-hidden="true">
                <i class="icon-remove icon-large"></i>&nbsp;Back
            </button>
        </a>
    </center>
</div>

<script>
    function submitVote() {
        // Submit the votes to the server
        window.location.href = 'submit_vote.php';

        // Show the alert after submission
        alert("Thank you for using our platform for voting!.. Your vote has been counted!.. Click the OK option for loging out..");

        // Redirect to the home page after a delay
        setTimeout(() => {
            window.location.href = 'index.php';
        }, 2000); // Redirect after 2 seconds
    }
</script>

                            
                            
	 
</body>



<?php include ('script.php');
include ('footer.php');?>
</html>


