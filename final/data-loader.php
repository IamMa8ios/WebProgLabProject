<?php
	
	require_once "scripts.php";
	
	function loadSubjects(){
	    
	    $mysqli=connect();
	    
	    if($mysqli){
	        
	        $sql="SELECT  `id`, `name`, `description`, `requirements` FROM subjects";
	        
	        $stmt=getStatement($mysqli, $sql);
	        
	        if($stmt){
	            
	            $results=fetchResults($stmt);
	            disconnect($mysqli);
	            return $results;
	            
            }
	        
	        disconnect($mysqli);
        }else{
	        header("Location: 500.php");
	        exit();
        }
	    
	    return null;
	    
    }
    
    function displaySubjects($results, $role){
	
		if(sizeof($results)>0){
		
			foreach ($results as $row){ ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['description']; ?></td>
                    <td><?php echo $row['requirements']; ?></td>
                    <td><?php loadButtons($role, $row['id']); ?></td>
                </tr>
			<?php }
		
		}else{ ?>
            <tr>
                <td>Nothing here yet</td>
                <td> </td>
                <td> </td>
                <td> </td>
            </tr>
		<?php }
	   
    }
    
    function loadButtons($role, $id){
	    
	    if($role==0){ ?>
            <a class="btn btn-outline-primary fa fa-eye" href="#" title="View" data-placement="auto" data-toggle="tooltip"></a>
        <?php }elseif($role==1){ ?>
            <a class="btn btn-outline-primary fa fa-eye" href="#" title="View" data-placement="auto" data-toggle="tooltip"></a>
            <a class="btn btn-outline-primary fa fa-pencil" href="#" title="Edit" data-placement="auto" data-toggle="tooltip"></a>
            <a class="btn btn-outline-primary fa fa-erase" href="#" title="Delete" data-placement="auto" data-toggle="tooltip"></a>
        <?php }elseif ($role==2){ ?>
            <a class="btn btn-outline-primary fa fa-eye" href="#" title="View" data-placement="auto" data-toggle="tooltip"></a>
            <a class="btn btn-outline-primary fa fa-pencil" href="#" title="Edit" data-placement="auto" data-toggle="tooltip"></a>
        <?php }elseif ($role==3){ ?>
            <a class="btn btn-outline-primary fa fa-eye" href="#" title="View" data-placement="auto" data-toggle="tooltip"></a>
        <?php }
	    
    }
    
    function loadProfile($userID){
	
		if(isset($userID) && $userID!=0){
		
			$mysqli=connect();
		
			if($mysqli){
			    
			    $sql="SELECT `first_name`, `last_name`, `rank`, `phone`, `website`, `photo`, `email` FROM `profiles` WHERE `userID`=?";
			    
			    $stmt=getStatement($mysqli, $sql);
			    
			    if($stmt){
			        
			        $stmt->bind_param("i", $userID);
			        
			        $results=fetchResults($stmt);
			        
			        if(sizeof($results)==1){
			            disconnect($mysqli);
			            return $results[0];
                    }
			        
                }
			    
			    disconnect($mysqli);
			    
			}else{
				displayError("Could not establish connection with host.");
            }
	        
        }
	    
		return null;
    }
    
    function loadProfileStats($userID){
	    
	    return $userID." Stats";
	    
    }
	
?>