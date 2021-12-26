
<?php 

require 'helpers/dbConnection.php';
require 'helpers/functions.php';
require 'checkLoginManager.php';


# Fetch Department Data .... 
$sql = "select * prod items";
$dep_op  = mysqli_query($con,$sql);



# Get Data related to id ...... 
   $id = $_GET['id'];

   $sql = "select * from prod where id = $id";
   $op   = mysqli_query($con,$sql);

     if(mysqli_num_rows($op) == 1){

        $data = mysqli_fetch_assoc($op);
     }else{

        $_SESSION['Message'] = "Access Denied";
        header("Location: addproduct.php");
     }






     if($_SERVER['REQUEST_METHOD'] == "POST"){

        // CODE ...... 
        $name     = Clean($_POST['name']);
        $Description     = Clean($_POST['Description']);
        $Purchasing_price     = Clean($_POST['Purchasing_price']);
        $selling_price     = Clean($_POST['selling_price']);
        $profit     = Clean($_POST['profit']);
        $id_item     = Clean($_POST['id_item']);
       
       
       
        # Validation ...... 
        $errors = [];
       
        # Validate Name 
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
           
       
        
          // db ..........
  
          $sql = "UPDATE `prod` SET `name`=$name,`Description`=$Description,`Purchasing_price`=$Purchasing_price,`selling_price`=$selling_price,`profit`=$profit,`Product_Picture`=$Product_Picture,`id_item`=$id_item WHERE id=$id";
          $op = mysqli_query($con, $sql);
  
          if ($op) {
              $_SESSION['Message'] = ['message' => 'Raw Updated'];
  
              header("Location: Store.php");
              exit();
  
          } else {
              $_SESSION['Message'] = ['message' => 'Error Try Again'];
  
          }
  
        }
      }
  }
  
  require './layouts/header.php';
  require './layouts/nav.php';
  require './layouts/sidNav.php';
  ?>
  
  
  <div id="layoutSidenav_content">
      <main>
          <div class="container-fluid">
  
  
  
  
              <h1 class="mt-4">Dashboard</h1>
              <ol class="breadcrumb mb-4">
  
                  <?php 
                              
                                if(isset($_SESSION['Message'])){
                                  foreach($_SESSION['Message'] as $key => $val){
                                  echo '* '.$key.' : '.$val;
                                  }
                                  unset($_SESSION['Message']); 
                              }else{
                              
                              ?>
  
                  <li class="breadcrumb-item active">Edit itme</li>
  
                  <?php } ?>
              </ol>
  
  
  
              <div class="card-body">
  
  
                  <div class="container">
  
  
  
                      <form action="edit.php?id=<?php echo $data['id']; ?>" method="post" enctype="multipart/form-data">
<div>
<label for="exampleInputName">Name items</label>
 <input type="text" class="form-control" id="exampleInputName" name="name" aria-describedby=""value="<?php echo $data['name'];?>"     placeholder="Enter Name Item">
                                    </div>



                                    <div class="form-group">
                                        <label for="exampleInputName">Description</label>
          <input type="text" class="form-control" id="exampleInputName" name="Description" aria-describedby=""value="<?php echo $data['Description'];?>"
                                            placeholder="Enter Name Item">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputName">Purchasing_price</label>
         <input type="text" class="form-control" id="exampleInputName" name="Purchasing_price" aria-describedby=""value="<?php echo $data['Purchasing_price'];?>"
                                            placeholder="Enter Name Item">
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleInputName">selling_price</label>
        <input type="text" class="form-control" id="exampleInputName" name="selling_price" aria-describedby=""value="<?php echo $data['selling_price'];?>"
                                            placeholder="Enter Name Item">
                                    </div>


                                    <div class="form-group">
                                        <label for="exampleInputName">profit</label>
            <input type="text" class="form-control" id="exampleInputName" name="profit" aria-describedby=""value="<?php echo $data['profit'];?>"
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
  
                          <button type="submit" class="btn btn-primary">Update</button>
                      </form>
  
  
  
  
  
  
  
                  </div>
              </div>
  
  
          </div>
      </main>
  
  
      <?php
      
      require './layouts/footer.php';
      ?>
  