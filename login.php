
<?php 
require 'helpers/dbConnection.php';
require 'helpers/functions.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){

// CODE ...... 
$email    = Clean($_POST['email']);
$password = Clean($_POST['password']);


# Validation ...... 
$errors = [];

# Validate Email 
if(!validate($email,1)){
    $errors['Email'] = "Field Required";
}elseif(!validate($email,2)){
   $errors['Email'] = "Invalid Email Format";
}


 # Validate Password 
 if(!validate($password,1)){
    $errors['password'] = "Field Required";
}elseif(!validate($password,3)){
   $errors['password'] = "Length Must >= 6 chs";
}



   if(count($errors) > 0){
       foreach ($errors as $key => $value) {
           # code...
           echo '* '.$key.' : '.$value.'<br>';
       }
   }else{

    // Login Code ....... 
    $password = md5($password);

    $sql = "select * from manager where email = '$email' and password = '$password' ";

    $op = mysqli_query($con,$sql);

    if(mysqli_num_rows($op) >= 1){
        
      $data = mysqli_fetch_assoc($op);
    
      $_SESSION['manager'] = $data;
      $_SESSION['seller'] = $data;
      header("Location: index.php");


    }else{
      $sql = "select * from seller where email = '$email' and password = '$password' ";

      $op = mysqli_query($con,$sql);
      if(mysqli_num_rows($op) >= 1){
        
        $data = mysqli_fetch_assoc($op);
      
        $_SESSION['seller'] = $data;
  
        header("Location: index.php");
      }else {
        echo 'Error in Email || Password Try Again !!!';
      }

    }


   }


}


?>

<!DOCTYPE html>
<html lang="en">
<head>
 <title>Login</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
 <h2>Login</h2>


 <form  action="<?php echo $_SERVER['PHP_SELF'];?>"   method="post"  enctype="multipart/form-data" >


 <div class="form-group">
   <label for="exampleInputEmail">Email</label>
   <input type="email"   class="form-control" id="exampleInputEmail1" name="email" aria-describedby="emailHelp" placeholder="Enter email">
 </div>

 <div class="form-group">
   <label for="exampleInputPassword"> Password</label>
   <input type="password"   class="form-control" id="exampleInputPassword1" name="password" placeholder="Password">
 </div>

 
 <button type="submit" class="btn btn-primary">Login</button>
</form>
</div>

</body>
</html>


