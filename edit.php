
<?php 

require 'helpers/dbConnection.php';
require 'helpers/functions.php';
require 'checkLoginManager.php';


# Fetch Department Data .... 
$sql = "select * from items";
$dep_op  = mysqli_query($con,$sql);



# Get Data related to id ...... 
   $id = $_GET['id'];

   $sql = "select * from items where id = $id";
   $op   = mysqli_query($con,$sql);

     if(mysqli_num_rows($op) == 1){

        $data = mysqli_fetch_assoc($op);
     }else{

        $_SESSION['Message'] = "Access Denied";
        header("Location: additems.php");
     }






     if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // CODE ......
      $name = Clean($_POST['name']);
  
      # Validation ......
      $errors = [];
  
      # Validate Name
      if (!validate($name, 1)) {
          $errors['name'] = 'Field Required';
      }
  
      if (count($errors) > 0) {
          $_SESSION['Message'] = $errors;
      } else {
          // db ..........
  
          $sql = "update  items  set item = '$name' where id = $id";
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
  
  
  
                          <div class="form-group">
                              <label for="exampleInputName">Title</label>
                              <input type="text" class="form-control" id="exampleInputName" name="title"
                                  aria-describedby=""  value="<?php echo $data['item'];?>"  placeholder="Enter Title">
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
  