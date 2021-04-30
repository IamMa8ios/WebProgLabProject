<?php

function loadUserWithStatus($userStatus){
    if (isset($_SESSION) && isset($_SESSION['role'])) {

        $con = mysqli_connect('127.0.0.1', 'root', '', 'bytes4hire');

        if ($con) {
            $stmt = $con->prepare("SELECT * FROM `users` WHERE `status`= ?");

            $stmt->bind_param("s", $str);
            $str = $userStatus;
            $stmt->execute();

            $results = $stmt->get_result();

            while ($row = $results->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $row['id'] ?></td>
                    <td><?php echo $row['username'] ?></td>
                    <td><?php echo $row['email'] ?></td>
                    <td><?php echo $row['role'] ?></td>
                    <td><?php echo $row['registration_date'] ?></td>
                    <td>
                        <?php
                        if ($userStatus == "Pending Confirmation") { ?>
                            <a href="../upload/approve.php?userID= <?php echo $row['id'] ?>&action=activate" class="mr-3"
                               title="Approve" data-placement="auto" data-toggle="tooltip"><span class="glyphicon glyphicon-ok-circle"></span></a>
                            <a href="../upload/approve.php?userID= <?php echo $row['id'] ?>&action=delete" class="mr-3"
                               title="Dismiss" data-placement="auto" data-toggle="tooltip"><span
                                        class="glyphicon glyphicon-remove-circle"></span></a>
                        <?php } elseif ($userStatus == "Suspended") { ?>
                            <a href="../upload/approve.php?id= <?php echo $row['id'] ?>&action=activate" class="mr-3"
                               title="Activate" data-placement="auto" data-toggle="tooltip"><span class="glyphicon glyphicon-ok-circle"></span></a>
                            <a href="../upload/approve.php?id= <?php echo $row['id'] ?>&action=delete" class="mr-3"
                               title="Delete" data-placement="auto" data-toggle="tooltip"><span class="glyphicon glyphicon-remove-circle"></span></a>
                        <?php } ?>
                    </td>
                </tr>
                <?php
            }
        }
    }
}

function approve($id_del)
{
    $con = mysqli_connect('127.0.0.1', 'root', '', 'bytes4hire');

    if ($con) {
        $stmt = $con->prepare("UPDATE users SET status = 'Active' WHERE id = ?");

        $stmt->bind_param("i", $id_del);
        $stmt->execute();
    }
}

function setStatus($status)
{
    if (isset($_SESSION) && isset($_SESSION['role'])) {
        if(isset($_POST) && $_POST['btnApprove'] == "Approve"){

        }

        include_once 'account/config.php';

        if ($mysqli) {
            $stmt = $mysqli->prepare("UPDATE `users` SET `status` = ? WHERE `users`.`id` = ?");

            $stmt->bind_param("s", $str);
            $str = $userStatus;
            $stmt->execute();

            $results = $stmt->get_result();
        }
    }




}

function loadTypeOfUser($typeOfUser){
    if (isset($_SESSION) && isset($_SESSION['role'])) {

        $con = mysqli_connect('127.0.0.1', 'root', '', 'bytes4hire');

        if($con){
            $stmt = $con->prepare("SELECT * FROM `users` WHERE `status`= ? AND `role`=?");

            $stmt->bind_param("ss", $s_status, $s_role);
            $s_status = "Active";
            $s_role = $typeOfUser; // role to pull from db -> based on $typeOfUser
            $stmt->execute();

            $results = $stmt->get_result();

            while($row = $results->fetch_assoc()){ ?>
                <tr>
                    <td><?php echo $row['id']  ?></td>
                    <td><?php echo $row['username']  ?></td>
                    <td><?php echo $row['email']  ?></td>
                    <td><?php echo $row['role']  ?></td>
                    <td><?php echo $row['registration_date']  ?></td>
                    <td><?php echo $row['last_update']  ?></td>
                    <td><?php echo $row['last_login']  ?></td>
                    <td>
                        <form method="POST">
                            <input type="submit" name="btnApprove" class="btn-small btn-success" value="Approve"/>
                            <input type="submit" name="btnDismiss" class="btn-small btn-danger" value="Dismiss"/>
                        </form>
                    </td>
                </tr>
                <?php
            }
        }
    }
}
