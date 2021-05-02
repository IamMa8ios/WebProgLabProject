<?php
// database connection code
// $con = mysqli_connect('localhost', 'database_user', 'database_password','database');
	
	include_once "../../query-executor.php";

    $mysqli=connect();

	if ($mysqli) {

        $results=fetchResults("SELECT `exp_level` From `exp_levels`");

        if (sizeof($results)>0){

            for($i=0;$i<sizeof($results);$i++){
                $row=$results[$i];
                echo "<option>" . $row['exp_level'] . "</option>";
            }

        }else{
            echo "ERROR WHILE COMMUNICATING WITH HOST";
        }


        $mysqli->close();
    }else{
        echo "COULD NOT ESTABLISH CONNECTION WITH HOST";
    }

	//TODO:handle exceptions in separate pages
?>