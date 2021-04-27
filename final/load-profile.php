<?php

    require_once "account/config.php";

    if (!isset($_SESSION)) {
        session_start();
    }

    if (!(isset($_SESSION['loggedin']) && isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['status']))) {
        header("Location: account/login.php");
    }

    if ($_SESSION['loggedin'] != true) {
        header("Location: account/login.php");
    }

    $disabled = "disabled='disabled'";
    $first = "First Name";
    $last = "Last Name";
    $email = "Email";
    $phone = "Phone";
    $gender = "";
    $birthday = "";
    $selected = "";
    $fClass = "";
    $mClass = "";

    if ($mysqli) {

        //echo "connected";
        $mysqli->autocommit(false);
        $sql = "SELECT `email` FROM `users` WHERE `id`=? AND `username`=?";
        if ($stmt = $mysqli->prepare($sql)) {
            $id = intval($_SESSION['id']);
            $stmt->bind_param("is", $id, $_SESSION['username']);

            if ($stmt->execute()) {

                $stmt->store_result();
                $stmt->bind_result($email);

                if ($stmt->fetch()) {

                    $stmt->free_result();
                    $sql = "SELECT `first_name`, `last_name`, `phone`, `gender`, `birthday` FROM `profiles` 
                            WHERE `user_id`=? AND `email`=?";

                    if ($stmt = $mysqli->prepare($sql)) {

                        $stmt->bind_param("is", $id, $email);

                        if ($stmt->execute()) {
                            $stmt->store_result();
                            $stmt->bind_result($first, $last, $phone, $gender, $birthday);
                            if ($stmt->fetch()) {
                                if ($gender == 'M') {
                                    $mClass = "btn btn-primary";
                                    $fClass = "btn btn-secondary";
                                } else {
                                    $fClass = "btn btn-primary";
                                    $mClass = "btn btn-secondary";
                                }
                            }
                        }
                    }
                }
            }

        }


        $mysqli->autocommit(true);
    }

?>