<?php

require './helpers/dbConnection.php';
require './helpers/functions.php';

if($_SERVER['REQUEST_METHOD'] == "POST"){

 $name     = Clean($_POST['name']);
 $email    = Clean($_POST['email']);
 $password = Clean($_POST['password']);
 $phone     = Clean($_POST['phone']);



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

 if(!validate($phone,1)){
    $errors['phone'] = "Field Required";
}

if(!validate($_FILES['image']['name'],1)){
    $errors['Image'] = "Field Required";
}else{
    
$tmpPath    =  $_FILES['image']['tmp_name'];
$imageName  =  $_FILES['image']['name'];
$imageSize  =  $_FILES['image']['size'];
$imageType  =  $_FILES['image']['type'];

$exArray   = explode('.',$imageName);
$extension = end($exArray);

$image = rand().time().'.'.$extension;

$allowedExtension = ["png",'jpg'];

   if(!validate($extension,5)){
     $errors['Image'] = "Error In Extension";
   }

}
    if(count($errors) > 0){
        foreach ($errors as $key => $value) {
            # code...
            echo '* '.$key.' : '.$value.'<br>';
        }
    }else{
        $desPath = './image_user/'.$image;

        if(move_uploaded_file($tmpPath,$desPath)){


    

     $password = md5($password);  

     $sql = "insert into singup_user (name,email,password,image,phone) values ('$name','$email','$password','$image',$phone)";
     $op = mysqli_query($con, $sql);


      if($op){
          echo 'Data Inserted';
      }else{
          echo 'Error Try Again'.mysqli_error($con);                      
      }
    

    }
}
}

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
                   
                        <?php 
                            
                            if(isset($_SESSION['Message'])){
                              foreach($_SESSION['Message'] as $key => $val){
                              echo $val;
                              }
                              unset($_SESSION['Message']); 
                          }else{
                          
                          ?>

                     
                     <?php } ?>                        </ol>
                        
 
  <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"   method="post"  enctype="multipart/form-data" >

  



  <div class="form-group">
                                        <label for="exampleInputName">Name seller</label>
                                        <input type="text" class="form-control" id="exampleInputName" name="name" aria-describedby=""
                                            placeholder="Enter Name seller">
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
                                    <div class="form-group">
                                            <label for="exampleInputPassword">Image</label>
                                            <input type="file"   name="image" >
                                        </div>
                                    <div>
                                         <label for="exampleInputName">phone</label>
                                        <input type="text" class="form-control" id="exampleInputName" name="phone" aria-describedby=""
                                            placeholder="Enter Name city">
                                    </div>


 
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

</body>
</html>
