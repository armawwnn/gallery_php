<?php
include_once ("init.php");
?>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">
                Blank Page
                <small>Subheading</small>
            </h1>
            <?php
//
//            $users = User::find_all_users();
//            foreach ($users as $user){
//                echo $user->password . "<hr>";
//            }
            $found_user = User::find_user_by_id(2);
          echo  $found_user->username;



            ?>
            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="index.html">Dashboard</a>
                </li>
                <li class="active">
                    <i class="fa fa-file"></i> Blank Page
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->

</div>
<?php
$user = new User();
$user->username= "test";
$user->password= "test";
$user->first_name= "test";
$user->last_name= "test";
$user->create();
?>