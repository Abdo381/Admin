
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
                            <li class="breadcrumb-item active">Stor</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Items
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                                            <th>ID</th>
                                                            <th>Name</th>
                                                           
                                                            <th>action</th>
                                                        </tr>

                                            <?php 
                                            $sql = "select * from items ";

                                            $op  = mysqli_query($con,$sql);
                                            while($data = mysqli_fetch_assoc($op)){

                                            ?>
                                                <tr>
                                                <td><?php echo $data['id'];?></td>
                                                <td><?php echo $data['item'];?></td>
                                                
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
                                Items
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Purchasing price</th>
                <th>selling price</th> 
                <th>profit</th> 
                <th>Product_Picture</th> 
                <th>id_item</th> 

                
                <th>action</th>
                                                        </tr>

                                            <?php 
                                            $sql = "SELECT * FROM prod";

                                            $op  = mysqli_query($con,$sql);
                                            while($data = mysqli_fetch_assoc($op)){

                                            ?>
                                                <tr>
                                    <td><?php echo $data['id'];?></td>
                                    <td><?php echo $data['name'];?></td>
                                    <td><?php echo $data['Description'];?></td>
                                    <td><?php echo $data['Purchasing_price'];?></td>
                                    <td><?php echo $data['selling_price'];?></td>
                                    <td><?php echo $data['profit'];?></td>
                                    <td><img src="./image_prod/<?php echo $data['Product_Picture'];?>" width="50" hight="50"></td>
                                    <?php  $sql = "select * from items";
                                    $opp  = mysqli_query($con,$sql);
                                    ?>
                                    <td name="id_item"> <?php $data = mysqli_fetch_assoc($opp)?>   
                                       <option value="<?php echo $data['id'];?>"><?php echo $data['item'];?></option> </td>
        <td>
             <a href='deletee.php?id=<?php echo $data['id'];?>' class='btn btn-danger m-r-1em'>Delete</a>
             <a href='editt.php?id=<?php echo $data['id'];?>' class='btn btn-primary m-r-1em'>Edit</a>

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