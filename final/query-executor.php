<?php

function connect(){

    /* Attempt to connect to MySQL database */
    $mysqli = new mysqli('localhost', 'root', '', 'bytes4hire');

    // Check connection
    if($mysqli === false){
        die("ERROR: Could not connect. " . $mysqli->connect_error);
    }

    return $mysqli;
}

function disconnect($mysqli){
    $mysqli->close();
}

function getStatement($mysqli, $sql){

    if($mysqli) {
        if ($stmt = $mysqli->prepare($sql)) {
            return $stmt;
        }
    }

    return null;
}

function executeUpdate($stmt)
{
    $executed=false;

    if($stmt){

        if($stmt->execute()){
            $executed=true;
        }

        $stmt->close();
    }


    return $executed;

}

function fetchResults($stmt)
{
    $data=array();

    if($stmt){

        if($stmt->execute()){

            $results = $stmt->get_result();

            while ($row = $results->fetch_assoc()) {
                array_push($data, $row);
            }

        }

        $stmt->close();
    }



    return $data;

}


//    require_once "account/config.php";
//
//    $values=array("username", "email", "pass", "Freelancer", "Active");
//    //executeUpdate("INSERT INTO `users`(`username`, `email`, `pass`, `role`, `status`) VALUES(?,?,?,?,?)", "sssss", $values);
//
//    $mysqli=connect();
//    $stmt=getStatement($mysqli, "SELECT `exp_level` From `exp_levels`");
//    echo "<pre>";
//    print_r(fetchResults($mysqli, $stmt));
//    echo "</pre>";
//    $mysqli=connect();
//    $stmt=getStatement($mysqli, "SELECT `exp_level` From `exp_levels`");
//    $results=fetchResults($mysqli, $stmt);
//    $row=$results[0];
//    echo $results[0]['exp_level'];
?>






















