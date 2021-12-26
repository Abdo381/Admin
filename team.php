
 <?php 
require './helpers/dbConnection.php';
require './helpers/functions.php';
require 'checkLoginManager.php';
  require './layouts/header.php';
  require './layouts/nav.php'; 
  require './layouts/sidNav.php';

  ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
  
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Team</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Seller
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>password</th> 
                                                            <th>city</th> 
                                                            <th>action</th>
                                                        </tr>

                                            <?php 
                                            $sql = "select * from seller ";

                                            $op  = mysqli_query($con,$sql);
                                            while($data = mysqli_fetch_assoc($op)){

                                            ?>
                                                <tr>
                                                <td><?php echo $data['id'];?></td>
                                                <td><?php echo $data['name'];?></td>
                                                <td><?php echo $data['email'];?></td>
                                                <td><?php echo $data['password'];?></td>
                                                <td><?php echo $data['City'];?></td>

                                                            <td>
                                                                <a href='delete.php?id=<?php echo $data['id'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                                                                <a href='edit.php?id=<?php echo $data['id'];?>' class='btn btn-primary m-r-1em'>Edit</a>

                                                            </td>
                                                        </tr>
                                            <?php 
                                            }
                                            ?>
                                                                                        
                                        </thead>
                                        
                                    </table>
                                </div>
                            </div>







                            
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Delivery
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>password</th> 
                <th>Moving_line</th> 
                <th>Service_Price</th>
                <th>action</th>
            </tr>

<?php 
$sql = "select * from delivery ";

$op  = mysqli_query($con,$sql);
while($data = mysqli_fetch_assoc($op)){

?>
    <tr>
       <td><?php echo $data['id'];?></td>
       <td><?php echo $data['name'];?></td>
       <td><?php echo $data['email'];?></td>
       <td><?php echo $data['password'];?></td>
       <td><?php echo $data['Moving_line'];?></td>
       <td><?php echo $data['Service_Price'];?></td>

                <td>
                    <a href='delete.php?id=<?php echo $data['id'];?>' class='btn btn-danger m-r-1em'>Delete</a>
                    <a href='edit.php?id=<?php echo $data['id'];?>' class='btn btn-primary m-r-1em'>Edit</a>

                </td>
            </tr>
<?php 
}
?>
                                            
                                        </thead>
                                        
                                    </table>
                                </div>
                            </div>




                         

                        
                        
                       
                </main>
              
              
              <?php 
                 
                 require './layouts/footer.php';
              ?>