
<?php 

require './helpers/dbConnection.php';
require './helpers/functions.php';
require 'checkLoginManager.php';


if($_SERVER['REQUEST_METHOD'] == "POST"){

 // CODE ...... 
 $name     = Clean($_POST['name']);
 


 # Validation ...... 
 $errors = [];

 # Validate Name 
 if(!validate($name,1)){
     $errors['Name'] = "Field Required";
 }
    if(count($errors) > 0){
        foreach ($errors as $key => $value) {
            # code...
            echo '* '.$key.' : '.$value.'<br>';
        }
    }
    else{

    

     $sql = "insert into items (item) values ('$name')";
     $op  = mysqli_query($con,$sql);

     
     if($op){
        $message = "Added successfully";
    }else{
        $message = "Error Try Again";
    }

     $_SESSION['Message'] =  [ $message];
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

< <div id="layoutSidenav_content">
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

                         <li class="breadcrumb-item active">Item</li>
                     
                     <?php } ?>                        </ol>
                        
 
  <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"   method="post"  enctype="multipart/form-data" >

  



  <div class="form-group">
                                        <label for="exampleInputName">Name items</label>
                                        <input type="text" class="form-control" id="exampleInputName" name="name" aria-describedby=""
                                            placeholder="Enter Name Item">
                                    </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

</body>
</html>


