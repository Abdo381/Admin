
<?php 

require './helpers/dbConnection.php';
require './helpers/functions.php';
require 'checkLoginManager.php';

$sql = "select * from items";
$op  = mysqli_query($con,$sql);

if($_SERVER['REQUEST_METHOD'] == "POST"){

 $name     = Clean($_POST['name']);
 $Description     = Clean($_POST['Description']);
 $Purchasing_price     = Clean($_POST['Purchasing_price']);
 $selling_price     = Clean($_POST['selling_price']);
 $profit     = Clean($_POST['profit']);
 $id_item     = Clean($_POST['id_item']);



 $errors = [];

 if(!validate($name,1)){
     $errors['Name'] = "Field Required";
 }
 if(!validate($Description,1)){
    $errors['Description'] = "Field Required";
}

if(!validate($Purchasing_price,1)){
    $errors['Purchasing_price'] = "Field Required";
}elseif(!validate($Purchasing_price,4)){
   $errors['Purchasing_price'] = "Invalid Purchasing_price Format";
}

if(!validate($selling_price,1)){
    $errors['selling_price'] = "Field Required";
}elseif(!validate($selling_price,4)){
   $errors['selling_price'] = "Invalid selling_price Format";
}

if(!validate($profit,1)){
    $errors['profit'] = "Field Required";
}elseif(!validate($profit,4)){
   $errors['profit'] = "Invalid selling_price Format";
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

$Product_Picture = rand().time().'.'.$extension;

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
        $desPath = './image_prod/'.$Product_Picture;

        if(move_uploaded_file($tmpPath,$desPath)){
    

     $sql = "insert into prod (name,Description,Purchasing_price,selling_price,profit,Product_Picture,id_item) values ('$name','$Description','$Purchasing_price','$selling_price','$profit','$Product_Picture','$id_item')";
     $op  = mysqli_query($con,$sql);

     
     if($op){
        $message = "Added successfully";
    }else{
        $message = "Error Try Again";
    }

     $_SESSION['Message'] =  [ $message];
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

                         <li class="breadcrumb-item active">product</li>
                     
                     <?php } ?>                        </ol>
                        
 
  <form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>"   method="post"  enctype="multipart/form-data" >

  



  <div class="form-group">
                                        <label for="exampleInputName">Name pruduct</label>
                                        <input type="text" class="form-control" id="exampleInputName" name="name" aria-describedby=""
                                            placeholder="Enter Name Item">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputName">Description</label>
                                        <input type="text" class="form-control" id="exampleInputName" name="Description" aria-describedby=""
                                            placeholder="Enter Name Item">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputName">Purchasing_price</label>
                                        <input type="text" class="form-control" id="exampleInputName" name="Purchasing_price" aria-describedby=""
                                            placeholder="Enter Name Item">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputName">selling_price</label>
                                        <input type="text" class="form-control" id="exampleInputName" name="selling_price" aria-describedby=""
                                            placeholder="Enter Name Item">
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputName">profit</label>
                                        <input type="text" class="form-control" id="exampleInputName" name="profit" aria-describedby=""
                                            placeholder="Enter Name Item">
                                    </div>
                                    <div class="form-group">
    <label for="exampleInputPassword">Department</label>
   
   <select class="form-control"  name="id_item">
  <?php 
        while($data = mysqli_fetch_assoc($op)){
     ?>   
     <option value="<?php echo $data['id'];?>"><?php echo $data['item'];?></option>
   <?php } ?>
  </select>
  </div>

                                                                            <div class="form-group">
                                            <label for="exampleInputPassword">Image</label>
                                            <input type="file"   name="image" >
                                        </div>

                                    
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
</div>

</body>
</html>


