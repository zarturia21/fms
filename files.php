<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Management Page</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="loading.css">
    <script src="script.js"></script>
<?php 
include 'db_connect.php';
$folder_parent = isset($_GET['fid'])? $_GET['fid'] : 0;
$folders = $conn->query("SELECT * FROM folders where parent_id = $folder_parent and user_id = '".$_SESSION['login_id']."'  order by name asc");


$files = $conn->query("SELECT *, organization FROM files where folder_id = $folder_parent and user_id = '".$_SESSION['login_id']."'  order by date_updated desc");


?>
<style>
	/* Advanced CSS design for the file management page */

/* Body styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f7f7f7;
    color: #333;
}

/* Container styles */
.container-fluid {
    margin-top: 20px;
}

/* Card styles */
.card {
    border: none;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    background-color: #fff;
}

.card-body {
    margin-bottom: -100px;
}

/* Button styles */
.btn {
    border-radius: 5px;
    font-weight: bold;
    transition: all 0.3s ease;
}

.btn-primary {
    background-color: #ffa722; /* Orange color */
    border-color: #ffa722; /* Orange color */
    color: #fff; /* White text color */
    font-size: 14px;
    padding: 8px 16px; /* Smaller padding */
    margin-right: 10px; /* Add some space between buttons */
}

.btn-primary:hover {
    background-color: #007bff; /* Blue color */
    border-color: #007bff; /* Blue color */
    color: #fff; /* White text color */
}

/* Input styles */
.form-control {
    border-radius: 5px;
}

/* Table styles */
#file-table {
    width: 100%;
    border-collapse: collapse;
    border-radius: 10px;
    overflow: hidden;
    
}

#file-table th,
#file-table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
    color: #333;
    font-size: 14px;
}

/* Header styles */
#file-table th {
    background-color: #002858; /* Change the background color to black */
    border-bottom: 2px solid black; /* Orange border bottom */
    color: #fff; /* Set text color to white */
    font-weight: bold;
    padding-top: 3px;
    padding-bottom: 3px;
    text-transform: uppercase; /* Uppercase text */
}


/* Alternate row background color */
#file-table tr:nth-child(even) {
    background-color: #f2f2f2; /* Light gray background color */
}

/* Hover effect for rows */
#file-table tr:hover {
    background-color: #e0e0e0; /* Lighter gray background color on hover */
}

/* File icon styles */
#file-table .fa {
    margin-right: 10px;
    color: #ff8c00; /* Orange icon color */
}

/* Custom menu styles */
.custom-menu {
    z-index: 999999999999;
    position: absolute;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 8px;
    min-width: 150px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.custom-menu-list {
    width: 100%;
    display: flex;
    align-items: center;
    color: #333;
    font-weight: bold;
    font-size: 14px;
    padding: 8px 16px;
    border-radius: 5px;
    transition: background-color 0.3s;
}

.custom-menu-list:hover {
    background-color: #f2f2f2;
}

.custom-menu-list span.icon {
    margin-right: 10px;
}

/* Path styles */
/* Path Card Box Styles */
/* Path styles */
/* Path Card Box Styles */
#paths {
    font-size: 16px;
    color: #555;
    /* background-color: #fff; Remove the background color */
    /* padding: 10px; Remove the padding */
}

#paths a {
    color: #007bff;
    text-decoration: none;
}

#paths a:hover {
    text-decoration: underline;
}


/* Search Box Styles */
.input-group {
    margin-top: 20px;
}

.input-group-text {
    background-color: #ffffff; /* Orange color */
    color: #1b1b1b; /* White text color */
}

.input-group-text:hover {
    background-color: #007bff; /* Blue color */
    border-color: #007bff; /* Blue color */
    color: #fff; /* White text color */
}

.form-control {
    border-radius: 5px;
}

#search {

}

#search:focus {
    border-color: #007bff; /* Blue color */
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25); /* Blue focus shadow */
}


/* Back button styles */
#back {
    font-size: 14px;
    padding: 8px 16px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
    background-color: #ffa72; /* Orange color */
    border-color: #ffa72; /* Orange color */
    color: #fff; /* White text color */
    border-radius: 5px;
}

#back:hover {
    background-color: #007bff; /* Blue color */
    border-color: #007bff; /* Blue color */
    color: #fff; /* White text color */
}

/* Additional Button styles */
#new_folder,
#new_file {
    font-size: 14px;
    padding: 8px 16px;
    margin-bottom: 20px;
    transition: all 0.3s ease;
    background-color: #ffa72; /* Orange color */
    border-color: #ffa72; /* Orange color */
    color: #fff; /* White text color */
    border-radius: 5px;
}

#new_folder:hover,
#new_file:hover {
    background-color: #007bff; /* Blue color */
    border-color: #007bff; /* Blue color */
    color: #fff; /* White text color */
}


/* Sidebar styles */
.sidebar {
    position: fixed;
    top: 0;
    right: -320px; /* Initial position off-screen */
    width: 150px; /* Increased width */
    height: 100%;
    max-height: calc(200vh - 100px); /* Limiting the height to 100% of the viewport height minus 60px for the header */
    overflow-y: auto; /* Enable vertical scrolling */
    background-color: rgba(0, 0, 0, 0.5); /* Transparent black background */
    backdrop-filter: blur(5px); /* Apply blur effect */
    transition: right 0.3s ease, box-shadow 0.3s ease; /* Added transition for smoother animation */
    z-index: 9999;
    border-top-left-radius: 20px; /* Rounded top-left corner */
    border-bottom-left-radius: 20px; /* Rounded bottom-left corner */
    box-shadow: -10px 0 20px rgba(0, 0, 0, 0.4); /* Curved shadow effect */
}

.sidebar-active {
    right: 0; /* Slide in from the right */
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.4); /* Increase shadow when active */
}



/* Sidebar title styles */
.sidebar h3 {
    color: #fff;
    text-align: center;
    padding: 20px 0;
    margin: 0;
    font-size: 24px;
}

/* Folder list styles */
/* Sidebar Folder Styles */
#sidebar-folder-list {
    list-style-type: none;
    padding: 0;
    margin: 20px 0;
}

.folder-item {
    padding: 10px;
    margin: 5px 0;
    /* background-color: #333; Remove the background color */
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.folder-item:hover {
    background-color: #555; /* Folder background color on hover */
}

.folder-item i {
    color: #ffa722; /* Folder icon color */
    font-size: 24px;
}

.folder-item div {
    color: #fff; /* Folder name color */
    text-align: center;
    margin-top: 5px;
    font-size: 16px;
}



/* Toggle button/icon styles */
#sidebar-toggle {
    position: fixed;
    top: 50%; /* Align to the vertical center of the viewport */
    transform: translateY(-50%); /* Adjust vertically to center */
    right: -10px; /* Keep the button aligned to the right */
    z-index: 10000;
    color: #fff; /* Make sure the toggle button is visible */
    background-color: rgba(0, 0, 0, 0.5); /* Transparent black background */
    border: none;
    border-radius: 50%;
    width: 40px; /* Set the width and height to match the button size */
    height: 40px;
    font-size: 20px;
    display: flex;
    justify-content: center;
    align-items: center;
    cursor: pointer;
    transition: background-color 0.3s ease;
    overflow: hidden; /* Hide overflowing content */
}

#sidebar-toggle::before {
    content: "\f060"; /* Unicode for the arrow icon */
    font-family: 'Font Awesome\ 5 Free'; /* Specify the Font Awesome font family */
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
    color: #fff; /* Icon color */
    font-size: 20px; /* Adjust icon size */
}

/* Additional styles for the arrow icon */
.toggle-button .chevron {
    position: absolute;
    right: 50%;
    top: 50%;
    transform: translate(-50%, -50%); /* Center the chevron icon */
    z-index: -200; /* Ensure it's above the circle */
    color: #fff; /* Match the color of the background */
}

.toggle-button .chevron i {
    font-size: 40px; /* Adjust the size of the arrow icon */
}
 
.toggle-button:hover {
    background-color: rgba(0, 0, 0, 0.8); /* Darken the background color on hover */
}

.toggle-button:hover .chevron {
    color: rgba(255, 255, 255, 0.8); /* Darken the color of the chevron icon on hover */
    text-shadow: 0 0 10px rgba(255, 255, 255, 0.8); /* Add a shadow effect to the chevron icon on hover */
    transition: all 0.3s ease; /* Smooth transition for the hover effect */
}



.chevron {
    position: absolute;
    left: 40%; /* Adjust the left position */
    top: 60%; /* Adjust the top position */
    transform: translate(-50%, -50%); /* Center the chevron icon */
    z-index: -200; /* Ensure it's above the circle */
    color: #fff; /* Match the color of the background */
}




/* Custom back button styles */
.custom-back-button {
    background-color: #6c757d; /* Gray color */
    border-color: #6c757d; /* Gray color */
    color: #fff; /* White text color */
}

.custom-back-button:hover {
    background-color: #5a6268; /* Darker gray color on hover */
    border-color: #5a6268; /* Darker gray color on hover */
    color: #fff; /* White text color */
}

</style>

<body>
<div class="loading-screen">
    <img src="image/ocd.png" alt="OCD Logo" class="ocd-logo">
    <img src="image/giflod.gif" alt="Loading..." class="loading-gif">
</div>



<div class="container-fluid">
    <div class="row align-items-center">
        <div class="col-md-auto">
            <button class="btn btn-primary btn-smb custom-back-button" id="back" onclick="goBack()">
                <i class="fa fa-arrow-left"></i> Back
            </button>
        </div>
        <div class="col-md-auto">
            <button class="btn btn-primary btn-sm" id="new_folder"><i class="fa fa-plus"></i> New Folder</button>
            <button class="btn btn-primary btn-sm ml-4" id="new_file"><i class="fa fa-upload"></i> Upload File</button>
        </div>
        <div class="col-md-auto ml-auto">
            <div class="input-group mt-n4 mr-3">
                <input type="text" class="form-control" id="search" placeholder="Search" aria-label="Search" aria-describedby="search-addon">
                <div class="input-group-append">
                    <span class="input-group-text" id="search-addon"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="sidebar" class="sidebar">
    <h3>Folders</h3>
    <ul id="sidebar-folder-list">
        <?php while($row = $folders->fetch_assoc()): ?>
        <li class="folder-item" data-id="<?php echo $row['id'] ?>">
            <i class="fas fa-folder fa-5x d-block mb-2" style="margin-right: auto; margin-left: auto; color: dodgerblue;"></i>
            <div class="text-center"><?php echo $row['name'] ?></div>
        </li>
        <?php endwhile; ?>
    </ul>
</div>

<div class="container-fluid">
    <div class="col-lg-12">
        <div class="row">
            <div class="card-body">
                <h3></h3>
                <?php 
                    $id = $folder_parent;
                    while($id > 0) {
                        $path = $conn->query("SELECT * FROM folders where id = $id  order by name asc")->fetch_array();
                        echo '<h4>'.$path['name'].' - Folder</h4>';
                        $id = $path['parent_id'];
                    }
                    echo '<script>$("#paths").prepend("<a href=\"index.php?page=files\">..</a>/")</script>';
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 table-container">
            <table id="file-table">
                <tr>
                    <th width="40%">Filename</th>
                    <th width="20%">Upload Date</th>
                    <th width="20%">Description</th>
                    <th width="15%">Organization</th>
                    <th width="20%">File Date</th>
                </tr>



						<?php 
while($row=$files->fetch_assoc()):
    $name = explode(' ||',$row['name']);
    $name = isset($name[1]) ? $name[0] ." (".$name[1].").".$row['file_type'] : $name[0] .".".$row['file_type'];
    $img_arr = array('png','jpg','jpeg','gif','psd','tif');
    $doc_arr = array('doc','docx');
    $pdf_arr = array('pdf','ps','eps','prn');
    $icon ='fa-file';
    if(in_array(strtolower($row['file_type']),$img_arr))
        $icon ='fa-image';
    if(in_array(strtolower($row['file_type']),$doc_arr))
        $icon ='fa-file-word';
    if(in_array(strtolower($row['file_type']),$pdf_arr))
        $icon ='fa-file-pdf';
    if(in_array(strtolower($row['file_type']),['xlsx','xls','xlsm','xlsb','xltm','xlt','xla','xlr']))
        $icon ='fa-file-excel';
    if(in_array(strtolower($row['file_type']),['zip','rar','tar']))
        $icon ='fa-file-archive';
?>

<tr class='file-item' data-id="<?php echo $row['id'] ?>" data-name="<?php echo $name ?>">
                            <td>
                                <large><span><i class="fa <?php echo $icon ?>"></i></span><b class="to_file"> <?php echo $name ?></b></large>
                                <input type="text" class="rename_file" value="<?php echo $row['name'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type'] ?>" style="display: none">
                            </td>
                            <td><i class="to_file"><?php echo date('Y/m/d h:i A', strtotime($row['date_updated'])) ?></i></td>
                            <td><i class="to_file"><?php echo $row['description'] ?></i></td>
                            <td><i class="to_file"><?php echo $row['organization'] ?></i></td>
                            <td><i class="to_file"><?php echo $row['year'] ?></i></td>
                        </tr>
                    <?php endwhile; ?>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="menu-folder-clone" style="display: none;">
	<a href="javascript:void(0)" class="custom-menu-list file-option edit">Rename</a>
	<a href="javascript:void(0)" class="custom-menu-list file-option delete">Delete</a>
</div>
<div id="menu-file-clone" style="display: none;">
	<a href="javascript:void(0)" class="custom-menu-list file-option edit"><span><i class="fa fa-edit"></i> </span>Rename</a>
	<a href="javascript:void(0)" class="custom-menu-list file-option download"><span><i class="fa fa-download"></i> </span>Download</a>
	<a href="javascript:void(0)" class="custom-menu-list file-option delete"><span><i class="fa fa-trash"></i> </span>Delete</a>
</div>

<script>
	
	$('#new_folder').click(function(){
		uni_modal('','manage_folder.php?fid=<?php echo $folder_parent ?>')
	})
	$('#new_file').click(function(){
		uni_modal('','manage_files.php?fid=<?php echo $folder_parent ?>')
	})
	$('.folder-item').dblclick(function(){
		location.href = 'index.php?page=files&fid='+$(this).attr('data-id')
	})
	$('.folder-item').bind("contextmenu", function(event) { 
    event.preventDefault();
    $("div.custom-menu").hide();
    var custom =$("<div class='custom-menu'></div>")
        custom.append($('#menu-folder-clone').html())
        custom.find('.edit').attr('data-id',$(this).attr('data-id'))
        custom.find('.delete').attr('data-id',$(this).attr('data-id'))
    custom.appendTo("body")
	custom.css({top: event.pageY + "px", left: event.pageX + "px"});

	$("div.custom-menu .edit").click(function(e){
		e.preventDefault()
		uni_modal('Rename Folder','manage_folder.php?fid=<?php echo $folder_parent ?>&id='+$(this).attr('data-id') )
	})
	$("div.custom-menu .delete").click(function(e){
		e.preventDefault()
		_conf("Are you sure to delete this Folder?",'delete_folder',[$(this).attr('data-id')])
	})
})

	//FILE
	$('.file-item').bind("contextmenu", function(event) { 
    event.preventDefault();

    $('.file-item').removeClass('active')
    $(this).addClass('active')
    $("div.custom-menu").hide();
    var custom =$("<div class='custom-menu file'></div>")
        custom.append($('#menu-file-clone').html())
        custom.find('.edit').attr('data-id',$(this).attr('data-id'))
        custom.find('.delete').attr('data-id',$(this).attr('data-id'))
        custom.find('.download').attr('data-id',$(this).attr('data-id'))
    custom.appendTo("body")
	custom.css({top: event.pageY + "px", left: event.pageX + "px"});

	$("div.file.custom-menu .edit").click(function(e){
		e.preventDefault()
		$('.rename_file[data-id="'+$(this).attr('data-id')+'"]').siblings('large').hide();
		$('.rename_file[data-id="'+$(this).attr('data-id')+'"]').show();
	})
	$("div.file.custom-menu .delete").click(function(e){
		e.preventDefault()
		_conf("Are you sure to delete this file?",'delete_file',[$(this).attr('data-id')])
	})
	$("div.file.custom-menu .download").click(function(e){
		e.preventDefault()
		window.open('download.php?id='+$(this).attr('data-id'))
	})

	$('.rename_file').keypress(function(e){
		var _this = $(this)
		if(e.which == 13){
			start_load()
			$.ajax({
				url:'ajax.php?action=file_rename',
				method:'POST',
				data:{id:$(this).attr('data-id'),name:$(this).val(),type:$(this).attr('data-type'),folder_id:'<?php echo $folder_parent ?>'},
				success:function(resp){
					if(typeof resp != undefined){
						resp = JSON.parse(resp);
						if(resp.status== 1){
								_this.siblings('large').find('b').html(resp.new_name);
								end_load();
								_this.hide()
								_this.siblings('large').show()
						}
					}
				}
			})
		}
	})

})
//FILE


	$('.file-item').click(function(){
		if($(this).find('input.rename_file').is(':visible') == true)
    	return false;
		uni_modal($(this).attr('data-name'),'manage_files.php?<?php echo $folder_parent ?>&id='+$(this).attr('data-id'))
	})
	$(document).bind("click", function(event) {
    $("div.custom-menu").hide();
    $('#file-item').removeClass('active')

});
	$(document).keyup(function(e){

    if(e.keyCode === 27){
        $("div.custom-menu").hide();
    $('#file-item').removeClass('active')

    }

});
	$(document).ready(function(){
		$('#search').keyup(function(){
			var _f = $(this).val().toLowerCase()
			$('.to_folder').each(function(){
				var val  = $(this).text().toLowerCase()
				if(val.includes(_f))
					$(this).closest('.card').toggle(true);
					else
					$(this).closest('.card').toggle(false);

				
			})
			$('.to_file').each(function(){
				var val  = $(this).text().toLowerCase()
				if(val.includes(_f))
					$(this).closest('tr').toggle(true);
					else
					$(this).closest('tr').toggle(false);

				
			})
		})
	})
	function delete_folder($id){
		start_load();
		$.ajax({
			url:'ajax.php?action=delete_folder',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp == 1){
					alert_toast("Folder successfully deleted.",'success')
						setTimeout(function(){
							location.reload()
						},1500)
				}
			}
		})
	}
	function delete_file($id){
		start_load();
		$.ajax({
			url:'ajax.php?action=delete_file',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp == 1){
					alert_toast("Folder successfully deleted.",'success')
						setTimeout(function(){
							location.reload()
						},1500)
				}
			}
		})
	}


	$(document).ready(function(){
    $('#search').keyup(function(){
        var searchText = $(this).val().toLowerCase();

        // Filter files based on search text
        $('.file-item').each(function(){
            var fileName = $(this).find('.to_file').text().toLowerCase();
            var fileRow = $(this);

            if(fileName.includes(searchText)) {
                fileRow.show();
            } else {
                fileRow.hide();
            }
        });
    });
});

$(document).ready(function () {
    // Load folder content when a folder item in the sidebar is clicked
    $('#sidebar-folder-list').on('click', '.folder-item', function () {
        var folderId = $(this).attr('data-id');
        // Redirect to the page with the folder content
        window.location.href = 'index.php?page=files&fid=' + folderId;
    });

    // Toggle sidebar visibility
	$('#sidebar-toggle').click(function () {
        $('.sidebar').toggleClass('sidebar-active');
    });

	$('#sidebar-chevron').click(function () {
        $('.sidebar').toggleClass('sidebar-active');
    });

    // Hide sidebar when clicking outside of it
    $(document).click(function (event) {
        if (!$(event.target).closest('.sidebar').length && !$(event.target).is('#sidebar-toggle')) {
            $('.sidebar').removeClass('sidebar-active');
        }
    });
});


function goBack() {
        window.history.back();
    }
</script>

</body>
</html>