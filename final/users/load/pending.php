<?php
require_once "C:/xampp/htdocs/gentelella-master/final/query-executor.php";
require_once "C:/xampp/htdocs/gentelella-master/final/users/upload/approve.php";

function loadUsersWithStatus($userStatus){
    if (isset($_SESSION) && isset($_SESSION['role'])) {

        $con = connect();

        if ($con) {
            $stmt = getStatement($con, "SELECT * FROM `users` WHERE `status`= ?");

            $stmt->bind_param("s", $userStatus);
            $stmt->execute();
            $results = fetchResults($stmt);

            printUsers($results, $userStatus);

            disconnect($con);
        }
    }

}

function loadUsersWithRole($role, $status){

    if (isset($_SESSION) && isset($_SESSION['role'])) {

        $con=connect();

        if($con){

            $stmt = getStatement($con, "SELECT * FROM `users` WHERE `status`= ? AND `role`=?");
            $stmt->bind_param("ss", $status, $role);
            $results = fetchResults($stmt);

            printUsers($results, $status);

            disconnect($con);
        }
    }
}

function printUsers($users, $status){

    foreach ($users as $user){ ?>
        <tr>
            <td><?php echo $user['id']  ?></td>
            <td><?php echo $user['username']  ?></td>
            <td><?php echo $user['email']  ?></td>
            <td><?php echo $user['role']  ?></td>
            <td><?php echo $user['registration_date']  ?></td>
            <td>
                <?php loadButtons($user['id'], $status); ?>
            </td>
        </tr>
        <?php
    }

}

function loadButtons($id, $status){ ?>
    <a href="../upload/approve.php?id=<?php echo $id ?>&action=accept&status=<?php echo $status ?>" class="mr-3"
       title="Accept" data-placement="auto" data-toggle="tooltip"><span class="glyphicon glyphicon-ok-circle"></span></a>
    <a href="../upload/approve.php?id= <?php echo $id ?>&action=decline&status=<?php echo $status ?>" class="mr-3"
       title="Decline" data-placement="auto" data-toggle="tooltip"><span class="glyphicon glyphicon-remove-circle"></span></a>
<?php } ?>