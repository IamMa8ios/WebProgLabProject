<?php
    require_once 'account/config.php';
    if($mysqli){
        $mysqli->autocommit(false);
        $sql = "";
        if(isset($_GET['userID']) && isset($_GET['action']) ){

            if($_GET['action'] == "activate"){
                $sql = "UPDATE `users` SET `status` = 'Active' WHERE `users`.`id` = ?";
            }elseif ($_GET['action'] == "delete"){
                $sql = "DELETE FROM `users` WHERE `users`.`id` = ?";
            }

            if($stmt = $mysqli->prepare($sql)){
                $stmt->bind_param("i", $_GET['userID']);

                if($stmt->execute()){
                    $mysqli->commit();
                }
            }
        }

        $mysqli->autocommit(true);
    }
    header("Location: manage-users.php");
?>