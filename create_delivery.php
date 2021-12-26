<?php

require './helpers/dbConnection.php';
require './helpers/functions.php';

$sql = "select * from singup_team";
$op  = mysqli_query($con,$sql);

if($_SERVER['REQUEST_METHOD'] == "POST"){

 $name     = Clean($_POST['name']);
 $email    = Clean($_POST['email']);
 $password = Clean($_POST['password']);
 $Moving_line     = Clean($_POST['Moving_line']);
 $Service_Price     = Clean($_POST['Service_Price']);

 $id_rol     = Clean($_POST['id_rol']);



 $errors = [];

 if(!validate($name,1)){
     $errors['Name'] = "Field Required";
 }


 if(!validate($email,1)){
     $errors['Email'] = "Field Required";
 }elseif(!validate($email,2)){
    $errors['Email'] = "Invalid Email Format";
 }


 
  if(!validate($password,1)){
     $errors['password'] = "Field Required";
 }elseif(!validate($password,3)){
    $errors['password'] = "Length Must >= 6 chs";
 }

 if(!validate($Moving_line,1)){
    $errors['Moving_line'] = "Field Required";
}
if(!validate($Service_Price,1)){
    $errors['Service_Price'] = "Field Required";
}




  

    if(count($errors) > 0){
        foreach ($errors as $key => $value) {
  
            echo '* '.$key.' : '.$value.'<br>';
        }
    }else{



    

     $password = md5($password);  

     $sql = "insert into delivery (name,email,password,Moving_line,Service_Price,id_rol) values ('$name','$email','$password','$Moving_line','$Service_Price',$id_rol)";
     $op = mysqli_query($con, $sql);


      if($op){
          echo 'Data Inserted';
      }else{
          echo 'Error Try Again'.mysqli_error($con);                      
      }
    

    }
}
require './layouts/header.php';
require './layouts/nav.php'; 
require './layouts/sidNav.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Register</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

 <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
  
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                        <?php 
                            
                            if(isset($_SESSION['Message'])){
                              foreach($_SESSION['Message'] as $key => $val){
                              echo $val;
                              }
                              unset($_SESSION['Message']); 
                          }else{
                          
                          ?>

                         <li class="breadcrumb-item active">Delivery</li>
                     
                     <?php } ?>                        </ol>
                        
 
  <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"   method="post"  enctype="multipart/form-data" >

  



  <div class="form-group">
                                        <label for="exampleInputName">Name delivery</label>
                                        <input type="text" class="form-control" id="exampleInputName" name="name" aria-describedby=""
                                            placeholder="Enter Name delivery">
                                    </div>

                                            <div>
                                    <label for="exampleInputName">email</label>
                                        <input type="email" class="form-control" id="exampleInputName" name="email" aria-describedby=""
                                            placeholder="Enter email">
                                    </div>

                                    <div>
                                    <label for="exampleInputName">password</label>
                                        <input type="password" class="form-control" id="exampleInputName" name="password" aria-describedby=""
                                            placeholder="Enter password">
                                    </div>


                                    <div>
                                         <label for="exampleInputName">Moving_line</label>
                                        <input type="text" class="form-control" id="exampleInputName" name="Moving_line" aria-describedby=""
                                            placeholder="Enter Moving_line">
                                    </div>



                                    <div>
                                         <label for="exampleInputName">Service_Price</label>
                                        <input type="text" class="form-control" id="exampleInputName" name="Service_Price" aria-describedby=""
                                            placeholder="Enter Service_Price">
                                    </div>


  <div class="form-group">
    <label for="exampleInputPassword">type</label>
   
   <select class="form-control"  name="id_rol">
  <?php 
        while($data = mysqli_fetch_assoc($op)){
    ?>   
    <option value="<?php echo $data['id'];?>"><?php echo $data['type'];?></option>
   <?php } ?>
  </select>
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

</body>
</html>
