<?php include 'nav.php' ?>

<div class="main-content">
    <div class="wrapper">
        <div class="admin-header">
            <h2> <strong class="title-letter-space text-uppercase">Admin</strong></h2>
            <a href="add-admin.php" class="normal-word-space btn-add-color">ADD</a>
        </div>
            
       
                <?php
                if (isset($_SESSION['add'])) {

                    // Display the message whether admin is added or not
                    echo $_SESSION['add'];
                    // removing the message after reload
                    unset($_SESSION['add']);
                }



                if(isset($_SESSION['user-not-found'])){
                    echo $_SESSION['user-not-found'];
                    unset($_SESSION['user-not-found']);
                }
                
                if(isset($_SESSION['password-changed'])){
                    echo $_SESSION['password-changed'];
                    unset($_SESSION['password-changed']);
                }

                if (isset($_SESSION['pass-not-match'])) {
                    echo $_SESSION['pass-not-match'];
                    unset($_SESSION['pass-not-match']);
                }
        
               
                
                ?>

        <!-- javascript timer Function to hide the message box after 5 sec -->
                <script>setTimeout(function(){
                    document.getElementsByClassName('display-message')[0].style.display = "none";
                },3000);</script>
    

        <table class="full-width text-center normal-word-space">

            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php

                // Query for getting all the table value
                $sql = "select * from admin";
                $res = mysqli_query($conn,$sql);

                if($res){

                    //Checking whether there is any rows or not 
                    $num = mysqli_num_rows($res);

                     //If the user delete previous row then the count will be in order 
                    $id_new = 1;

                    // if there is any rows then num will more then 0
                    if($num > 0){

                        // Fetching all the data from database and add it to admin table
                        while($rows = mysqli_fetch_assoc($res)){
                            $id = $rows['id'];
                            $fullName = $rows['fullName'];
                            $UserName = $rows['userName'];

                    ?>

                    
                    
                    <tr>
                        <td><?php echo $id_new++; ?></td>
                        <td><?php echo $fullName; ?></td>
                        <td><?php echo $UserName; ?></td>
                        <td>
                            <a href="<?php echo INDEXPAGE ?>adminPanel/change-password.php?id=<?php echo $id; ?>" class="link-btn btn-change-color">Change Password</a>
                            <a href="<?php echo INDEXPAGE ?>adminPanel/update-admin.php?id=<?php echo $id; ?>" class="link-btn btn-primary-color">Update</a>
                            <a href="<?php echo INDEXPAGE ?>adminPanel/delete-admin.php?id=<?php echo $id; ?>" class="link-btn btn-danger-color">Delete</a>
                        </td>
                    </tr>

                    <?php
                        }
                        }
                        }
                        

                    ?>


       

            </tbody>
        </table>

    </div>
</div>

<?php include 'footer.php'  ?>