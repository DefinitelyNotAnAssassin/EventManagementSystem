<!DOCTYPE html>
<html lang="en">
<?php 

include('admin/db_connect.php');
session_start();
ob_end_flush();


echo $_SESSION['login_id']; 

// query the attendance where the $_SESSION['login_id'] is the user_id and get the event details on the join
$user_events =  $conn->query("SELECT a.*,e.event, e.schedule, e.description FROM audience a inner join events e on e.id = a.event_id where a.user_id = {$_SESSION['login_id']} ");
$result = $user_events->fetch_all(MYSQLI_ASSOC);
// echo user_events as json 


?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $_SESSION['system']['name'] ?></title>
 	


</head>
<style>
	body{
		width: 100%;
	    height: calc(100%);
	    /*background: #007bff;*/
	}
	main#main{
		width:100%;
		height: calc(100%);
		background:white;
	}
	#login-right{
		position: absolute;
		right:0;
		width:100%;
		height: calc(100%);
		background:white;
		display: flex;
		align-items: center;
	}
	#login-left{
		position: absolute;
		left:0;
		width:60%;
		height: calc(100%);
		background:#59b6ec61;
		display: flex;
		align-items: center;
		background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>);
	    background-repeat: no-repeat;
	    background-size: cover;
	}
	#login-right .card{
		margin: auto;
		z-index: 1
	}
	.logo {
    margin: auto;
    font-size: 8rem;
    background: white;
    padding: .5em 0.7em;
    border-radius: 50% 50%;
    color: #000000b3;
    z-index: 10;
}
div#login-right::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: calc(100%);
    height: calc(100%);
    background: #000000e0;
}

</style>

<body>


  <main id="main" class=" bg-dark">
  		
        
  		<div id="login-right">
            <div class="card col-md-8">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Event</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Description</th>
                            <th>Name</th>
                            <th>Contact</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($result as $row): ?>
                            <tr>
                                <td><?php echo $row['event']; ?></td>
                                <td><?php echo date("M d, Y",strtotime($row['schedule'])); ?></td>
                                <td>
                                    <?php 
                                        $status = $row['status'];
                                        if ($status == 0) {
                                            echo "For Verification";
                                        } elseif ($status == 1) {
                                            echo "Confirmed";
                                        } elseif ($status == 2) {
                                            echo "Declined";
                                        }
                                    ?>
                                </td>
                                <td><?php echo substr(strip_tags(html_entity_decode($row['description'])), 0, 255); ?></td>
                                <td><?php echo $row['name']; ?></td>
                                <td><?php echo $row['contact']; ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
  		</div>
   

  </main>

  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


</body>

</html>