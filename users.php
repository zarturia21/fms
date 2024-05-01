<link rel="stylesheet" href="styles.css">
<?php 

?>
<?php include 'db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loading.css">
    <script src="script.js"></script>

</head>
<body>
    <!-- Add the loading screen HTML -->
    <div class="loading-screen">
    <img src="image/ocd.png" alt="OCD Logo" class="ocd-logo">
    <img src="image/giflod.gif" alt="Loading..." class="loading-gif">
</div>

<div class="container-fluid">
	
	<div class="row">
	<div class="col-lg-12">
			<button class="btn btn-primary float-right btn-sm" id="new_user"><i class="fa fa-plus"></i> New user</button>
	</div>
	</div>
	<br>
	<div class="row">
		<div class="card col-lg-12">
			<div class="card-body">
				<table class="table-striped table-bordered col-md-12">
			<thead>
				<tr>
					<th class="text-center">#</th>
					<th class="text-center">Name</th>
					<th class="text-center">Username</th>
					<th class="text-center">Action</th>
				</tr>
			</thead>
			<tbody>
				<?php
 					include 'db_connect.php';
 					$users = $conn->query("SELECT * FROM users order by name asc");
 					$i = 1;
 					while($row= $users->fetch_assoc()):
				 ?>
				 <tr>
				 	<td>
				 		<?php echo $i++ ?>
				 	</td>
				 	<td>
				 		<?php echo $row['name'] ?>
				 	</td>
				 	<td>
				 		<?php echo $row['username'] ?>
				 	</td>
				 	<td>
				 		<center>
						 <div class="btn-group custom-action-btn">
    <button type="button" class="btn btn-primary custom-action-btn-main">Action</button>
    <button type="button" class="btn btn-primary dropdown-toggle dropdown-toggle-split custom-action-btn-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item edit_user" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Edit</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item delete_user" href="javascript:void(0)" data-id='<?php echo $row['id'] ?>'>Delete</a>
    </div>
</div>

								</center>
				 	</td>
				 </tr>
				<?php endwhile; ?>
			</tbody>
		</table>
			</div>
		</div>
	</div>

</div>
<script>
	
$('#new_user').click(function(){
	uni_modal('New User','manage_user.php')
})
$('.edit_user').click(function(){
	uni_modal('Edit User','manage_user.php?id='+$(this).attr('data-id'))
})

</script>
<script>
$('.delete_user').click(function(){
    var id = $(this).attr('data-id');
    if(confirm('Are you sure to delete this user?')){
        $.ajax({
            url:'ajax.php?action=delete_user',
            method:'POST',
            data:{id:id},
            success:function(resp){
                if(resp == 1){
                    alert('User deleted successfully');
                    // Refresh the page or remove the row from the table
                    location.reload(); // This will reload the page
                }else{
                    alert('Error deleting user');
                }
            }
        });
    }
});
</script>
</body>
</html>