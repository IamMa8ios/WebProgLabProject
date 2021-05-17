<?php
    include_once "../../query-executor.php";

    function loadExp(){

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

    }

    function loadListings(){

        if (isset($_SESSION) && isset($_SESSION['role']) && isset($_SESSION['status'])) {

            if ($_SESSION['role'] == 'Freelancer' && $_SESSION['status'] == 'Active') {

                include_once "../../query-executor.php";

                $mysqli=connect();

                if($mysqli){

                    $stmt=getStatement($mysqli, "SELECT `id` FROM `users` WHERE `username`=?");
                    $stmt->bind_param("s", $_SESSION['username']);
                    $results=fetchResults($stmt);

                    $userID = $results[0]['id'];

                    $stmt = getStatement($mysqli, "SELECT `l`.`id`, `job_title`, `techs`, `payment_amount`, `location`,
                                            `date_submitted`, `status`, `exp_level`, `rate`
                                            FROM `listings` AS `l`, `exp_levels` AS el, `payment_rates` AS pr
                                            WHERE `userID`=? AND `el`.`id`=`job_level` AND `pr`.`id`=`payment_rate`");
                    $stmt->bind_param("i", $userID);
                    $results=fetchResults($stmt);

                    for ($i=0;$i<sizeof($results);$i++){ ?>
                        <tr class='odd pointer'>
                            <td class='a-center '><input type='checkbox' class='flat' name='table_records'></td>
                            <td> <?php echo $results[$i]['id'] ?> </td>
                            <td> <?php echo $results[$i]['job_title'] ?> </td>
                            <td> <?php echo $results[$i]['exp_level'] ?> </td>
                            <td> $<?php echo $results[$i]['payment_amount'] ?>/<?php echo $results[$i]['rate'] ?> </td>
                            <td> <?php echo $results[$i]['techs'] ?> </td>
                            <td> <?php echo $results[$i]['location'] ?> </td>
                            <td> <?php echo $results[$i]['date_submitted'] ?> </td>
                            <td> <?php echo $results[$i]['status'] ?> </td>
                            <td class=' last'><i href='#'>View</i>
                        </tr>
                    <?php }

                    disconnect($mysqli);
                }

            }

        }

    }

    function loadRates(){

        $mysqli=connect();

        if ($mysqli) {

            $stmt = getStatement($mysqli,"SELECT `rate` From `payment_rates` ORDER BY id ASC");
            $result = fetchResults($stmt);

            if (sizeof($result)>0) {//check if any data exists

                for ($i=0;$i<sizeof($result);$i++){
                    echo"<option>". $result[$i]['rate'] ."</option>";
                }

            } else {
                echo "ERROR WHILE COMMUNICATING WITH HOST";
            }

            disconnect($mysqli);
        } else {
            echo "COULD NOT ESTABLISH CONNECTION WITH HOST";
        }

    }

?>