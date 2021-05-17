<?php
require_once "scripts.php";
require_once "data-uploader.php";
require_once "data-loader.php";

if (isset($_POST)) {
    if (isset($_POST['submit'])) {

        $pollTitle = $_POST['Title'];
        $pollOptions = $_POST['options']; // options is an array

        insertPoll($pollTitle);

        insertPollChoices($pollTitle, $pollOptions);
        
        header("Location: pages-admin-polls-ongoing.php");
        exit();
    }elseif (isset($_POST['delete_poll'])){
        deletePollWithID($_POST['delete_poll']);
        header("Location: pages-admin-polls-ongoing.php");
        exit();
    }elseif (isset($_POST['open_poll'])){
        changePollStatusWithID($_POST['open_poll'], 'Open');
        header("Location: pages-admin-polls-history.php");
        exit();
    }elseif (isset($_POST['close_poll'])){
        changePollStatusWithID($_POST['close_poll'], 'Closed');
        header("Location: pages-admin-polls-history.php");
        exit();
    }elseif (isset($_POST['view_poll'])){
        header("Location: pages-admin-view-poll.php");
        exit();
    }

}

function deletePollWithID($theID){
    if($con = connect()){
        $sql = "DELETE FROM polls WHERE `id`=?";
        $stmt = getStatement($con, $sql);
        $stmt->bind_param("i", $theID);
        executeUpdate($stmt);
    }
}

function changePollStatusWithID($theID, $action){
    if($con = connect()){
        $sql = "UPDATE polls SET `status`=? WHERE `id`=?";
        $stmt = getStatement($con, $sql);
        $stmt->bind_param("si",$action, $theID);
        executeUpdate($stmt);
    }
}
?>
