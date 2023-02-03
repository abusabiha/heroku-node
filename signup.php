<?php

ob_start();
session_start();
include '../db-connection/db-connection.php';

if(isset($_POST['submit']))

  {
    $username=$_POST['username'];
    $email=$_POST['email'];
    $gender=$_POST['gender'];
    $country=$_POST['country'];
    $pssword=$_POST['passw'];
    $repassw=$_POST['repassw'];

    $username=mysqli_real_escape_string($connect, $username);
    $email=mysqli_real_escape_string($connect, $email);
    $gender=mysqli_real_escape_string($connect, $gender);
    $country=mysqli_real_escape_string($connect, $country);


    $username=htmlentities($username);
    $email=htmlentities($email);
    $gender=htmlentities($gender);
    $country=htmlentities($country);

    $pssword=password_hash($pssword, PASSWORD_BCRYPT);
    $repassw=password_hash($repassw, PASSWORD_BCRYPT);

    $image=$_FILES['image'];
    $imageName=$_FILES['image']['name'];
    $imageSize=$_FILES['image']['size'];
    $imageType=$_FILES['image']['type'];
    $imageDir=$_FILES['image']['tmp_name'];


    if(!empty($username) && !empty($email) && !empty($gender) && !empty($country) && !empty($pssword) && !empty($repassw) && !empty($image))

      {
         if($imageName == 'image.jpg' || $imageName == 'image.jpeg' || $imageName == 'image.png')

         {
            if($imageSize<=5242880)
            {
                move_uploaded_file($imageDir, "user_img/" . $imageName);

                $sql="INSERT INTO signup (username,email,gender,country,image,passw,repassw) VALUES ('$username','$email','$gender','$country','$imageName','$pssword','$repassw')";


                $result=mysqli_query($connect,$sql);

                if($result)
                {
                    echo "Signup successfully";
                }  
                else{
                    echo "Signup unsuccessfull";
                }  
            }
         }
      }else{
     echo"<script>alert('This field is empty')</script>";
  }

  
  }

?>



<!DOCTYPE html>
<html>
<head>
	<title>Signup Form</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

</head>

<body>
     
        <div class="container">
        	 <div class="row">
        	 	<div class="col-md-8">
        	 		<form method="POST" enctype="multipart/form-data" action="#">
        	 		  <h2 class="text-center mt-5 bg-dark text-light p-5">Signup</h2>	
        	 		  <div class="form-group">
        	 		  	<b>Username</b>
        	 			<input type="text" name="username" class="form-control" placeholder="Enter Username"><br>

        	 			<b>Email</b>
        	 			<input type="email" name="email" class="form-control" placeholder="Enter Username"><br>

        	 			<b>Gender</b><br>
        	 			<input type="radio" name="gender" value="male">
        	 			<b>Male</b>
        	 			<input type="radio" name="gender" value="female">
        	 			<b>Female</b>
        	 			<input type="radio" name="gender" value="other">
        	 			<b>Other</b><br><br>

        	 			<b>Select Your Country</b>
        	 			<select name="country" class="form-control">
        	 				 <option>Bangladesh</option>
        	 				 <option>India</option>
        	 				 <option>America</option>
        	 				 <option>Austrila</option>
        	 			</select><br>

        	 			<b>Image</b>
        	 			<input type="file" name="image" class="form-control"><br>

        	 			<b>Password</b>
        	 			<input type="password" name="passw" class="form-control" placeholder="Enter Password"><br>

        	 			<b>Re-Password</b>
        	 			<input type="password" name="repassw" class="form-control" placeholder="Enter Re-Password"><br><br>

        	 			<input type="submit" name="submit" value="submit" class="btn btn-success btn-block"><input type="submit" name="cancel" value="cancel" class="btn btn-danger btn-block">

        	 		  </div>
        	 	    </form>
        	 	</div>
        	 </div>
        </div>

	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    
</body>
</html>