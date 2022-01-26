<?php include 'nav.php' ?>

<div class="main-content">
    <div class="wrapper">
        <div class="admin-header">
            <h2> <strong class="title-letter-space text-uppercase">Customers Details</strong></h2>
        </div>
            
        <!-- javascript timer Function to hide the message box after 5 sec -->
                <script>setTimeout(function(){
                    document.getElementsByClassName('display-message')[0].style.display = "none";
                },3000);</script>
    

        <table class="full-width text-center normal-word-space">

            <thead>
                <tr>
                    <th>S.N</th>
                    <th>Email</th>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php

                // Query for getting all the table value
                $sql = "select * from customer_signup";
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
                            $email = $rows['email'];
                            $UserName = $rows['username'];
                            $pass = $rows['password'];

                    ?>

                    
                    
                    <tr>
                        <td><?php echo $id_new++; ?></td>
                        <td><?php echo $email; ?></td>
                        <td><?php echo $UserName; ?></td>
                        <td><?php echo $pass; ?></td>
                        <td>
                            <a href="<?php echo INDEXPAGE ?>adminPanel/change-password-customers.php?id=<?php echo $id; ?>" class="link-btn btn-change-color">Change Password</a>
                            <a href="<?php echo INDEXPAGE ?>adminPanel/update-customers.php?id=<?php echo $id; ?>" class="link-btn btn-primary-color">Update</a>
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