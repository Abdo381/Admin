<?php

require '../helpers/dbConnection.php';
require '../helpers/functions.php';

# Fetch Roles .....
$sql = 'select * from roles';
$roleData = mysqli_query($con, $sql);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // CODE ......
    $name = Clean($_POST['name']);
    $email = Clean($_POST['email']);
    $password = Clean($_POST['password']);
    $role_id = $_POST['role_id'];
    $phone = Clean($_POST['phone']);

    # Validation ......
    $errors = [];

    # Validate Name
    if (!validate($name, 1)) {
        $errors['Name'] = 'Field Required';
    } elseif (!validate($name, 7)) {
        $errors['Name'] = 'Invalid String';
    }

    # Validate Email
    if (!validate($email, 1)) {
        $errors['Email'] = 'Field Required';
    } elseif (!validate($email, 2)) {
        $errors['Email'] = 'Invalid Email Format';
    }

    # Validate Password
    if (!validate($password, 1)) {
        $errors['password'] = 'Field Required';
    } elseif (!validate($password, 3)) {
        $errors['password'] = 'Length Must >= 6 chs';
    }

    # Validate role_id
    if (!validate($role_id, 4)) {
        $errors['Role'] = 'Invalid Role';
    }

    # Validate phone
    if (!validate($phone, 1)) {
        $errors['phone'] = 'Field Required';
    } elseif (!validate($phone, 6)) {
        $errors['phone'] = 'Invalid Phone Number';
    }

    # Validate image
    if (!validate($_FILES['image']['name'], 1)) {
        $errors['Image'] = 'Field Required';
    } else {
        $tmpPath = $_FILES['image']['tmp_name'];
        $imageName = $_FILES['image']['name'];
        $imageSize = $_FILES['image']['size'];
        $imageType = $_FILES['image']['type'];

        $exArray = explode('.', $imageName);
        $extension = end($exArray);

        $FinalName = rand() . time() . '.' . $extension;

        $allowedExtension = ['png', 'jpg'];

        if (!validate($extension, 5)) {
            $errors['Image'] = 'Error In Extension';
        }
    }

    if (count($errors) > 0) {
        $_SESSION['Message'] = $errors;
    } else {
        // db ..........

        $desPath = './uploads/' . $FinalName;

        if (move_uploaded_file($tmpPath, $desPath)) {
            $password = md5($password); // e10adc3949ba59abbe56e057f20f883e

            $sql = "insert into users (name,email,password,image,role_id,phone) values ('$name','$email','$password','$FinalName',$role_id,'$phone')";
            $op = mysqli_query($con, $sql);

            if ($op) {
                $message = 'Raw Inserted';
            } else {
                $message = 'Error Try Again';
            }
        } else {
            $message = 'Error In Uploading file';
        }

        $_SESSION['Message'] = ['message' => $message];
    }
}

require '../layouts/header.php';
require '../layouts/nav.php';
require '../layouts/sidNav.php';
?>










<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">




            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">

                <?php 
                            
                              if(isset($_SESSION['Message'])){
                                foreach($_SESSION['Message'] as $key => $val){
                                echo '* '.$key.' : '.$val.'<br>';
                                }
                                unset($_SESSION['Message']); 
                            }else{
                            
                            ?>

                <li class="breadcrumb-item active">Dashboard/Add User</li>

                <?php } ?>
            </ol>






            <div class="card-body">


                <div class="container">



                    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">



                        <div class="form-group">
                            <label for="exampleInputName">Name</label>
                            <input type="text" class="form-control" id="exampleInputName" name="name"
                                aria-describedby="" placeholder="Enter Name">
                        </div>


                        <div class="form-group">
                            <label for="exampleInputEmail">Email address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" name="email"
                                aria-describedby="emailHelp" placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputPassword">New Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password"
                                placeholder="Password">
                        </div>



                        <div class="form-group">
                            <label for="exampleInputPassword"> Phone</label>
                            <input type="phone" class="form-control" id="exampleInputPassword1" name="phone"
                                placeholder="phone">
                        </div>


                        <div class="form-group">
                            <label for="exampleInputPassword">Role</label>

                            <select class="form-control" name="role_id">
                                <?php
                                while($data = mysqli_fetch_assoc($roleData)){
                                ?>
                                <option value="<?php echo $data['id']; ?>"><?php echo $data['title']; ?></option>
                                <?php } ?> ?>
                            </select>
                        </div>



                        <div class="form-group">
                            <label for="exampleInputPassword">Image</label><br>
                            <input type="file" name="image">
                        </div>


                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>







                </div>
            </div>


        </div>
    </main>


    <?php
    
    require '../layouts/footer.php';
    ?>
