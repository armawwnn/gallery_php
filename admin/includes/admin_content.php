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
//########### CRUD test ##########################
//$user = new User();
//$user->username= "testNew1";
//$user->password= "testNew1";
//$user->first_name= "testNew1";
//$user->last_name= "testNew1";
//$user->create();

//$user = User::find_user_by_id(7);
//$user->username = "changed00";
//$user->password = "changed";
//$user->first_name = "changed";
//$user->last_name = "changed";
//$user->update();

//$user = User::find_user_by_id(6);
//$user->password = "1002";
//$user->save();

//$user = User::find_user_by_id(6);
//$user->delete();

?>