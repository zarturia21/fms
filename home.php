<style>
	.custom-menu {
        z-index: 1000;
	    position: absolute;
	    background-color: #ffffff;
	    border: 1px solid #0000001c;
	    border-radius: 5px;
	    padding: 8px;
	    min-width: 13vw;
}
a.custom-menu-list {
    width: 100%;
    display: flex;
    color: #4c4b4b;
    font-weight: 600;
    font-size: 1em;
    padding: 1px 11px;
}
	span.card-icon {
    position: absolute;
    font-size: 3em;
    bottom: .2em;
    color: #ffffff80;
}
.file-item{
	cursor: pointer;
}
a.custom-menu-list:hover,.file-item:hover,.file-item.active {
    background: #80808024;
}
table th,td{
	/*border-left:1px solid gray;*/
}
a.custom-menu-list span.icon{
		width:1em;
		margin-right: 5px
}
</style>

<div class="containe-fluid">
	<?php include('db_connect.php') ;
	$files = $conn->query("SELECT f.*,u.name as uname FROM files f inner join users u on u.id = f.user_id where  f.is_public = 1 order by date(f.date_updated) desc");

	?>
	<div class="row">
		<div class="col-lg-12">
			<div class="card col-md-4 offset-2 bg-info float-left">
				<div class="card-body text-white">
					<h4><b>Users</b></h4>
					<hr>
					<span class="card-icon"><i class="fa fa-users"></i></span>
					<h3 class="text-right"><b><?php echo $conn->query('SELECT * FROM users')->num_rows ?></b></h3>
				</div>
			</div>
			<div class="card col-md-4 offset-2 bg-primary ml-4 float-left">
				<div class="card-body text-white">
					<h4><b>Files</b></h4>
					<hr>
					<span class="card-icon"><i class="fa fa-file"></i></span>
					<h3 class="text-right"><b><?php echo $conn->query('SELECT * FROM files')->num_rows ?></b></h3>
				</div>
			</div>
		</div>
	</div>

	<div class="row mt-3 ml-3 mr-3">
    <div class="col-md-6 mb-3">
        <select class="form-control sorter" id="organizationSorter">
            <option value="">Sort by Organization</option>
            <option value="OCD">OCD</option>
            <option value="RDRRMC">RDRRMC</option>
        </select>
    </div>
    <div class="col-md-6 mb-3">
        <select class="form-control" id="descriptionSorter" style="display: none;">
            <!-- Description options will be dynamically populated here -->
        </select>
    </div>
</div>

	<div class="row mt-3 ml-3 mr-3">
			<div class="card col-md-12">
				<div class="card-body">
				<table width="100%">
    <tr>
        <th width="12%" class="">Uploader</th>
        <th width="40%" class="">Filename</th>
        <th width="20%" class="">Date</th>
        <th width="15%" class="">Description</th>
        <th width="10%" class="">Organization</th>
    </tr>
    <?php 
    while($row = $files->fetch_assoc()):
        $name = explode(' ||', $row['name']);
        $name = isset($name[1]) ? $name[0] ." (".$name[1].").".$row['file_type'] : $name[0] .".".$row['file_type'];
        $img_arr = array('png','jpg','jpeg','gif','psd','tif');
        $doc_arr = array('doc','docx');
        $pdf_arr = array('pdf','ps','eps','prn');
        $icon = 'fa-file';
        if (in_array(strtolower($row['file_type']), $img_arr))
            $icon = 'fa-image';
        if (in_array(strtolower($row['file_type']), $doc_arr))
            $icon = 'fa-file-word';
        if (in_array(strtolower($row['file_type']), $pdf_arr))
            $icon = 'fa-file-pdf';
        if (in_array(strtolower($row['file_type']), ['xlsx','xls','xlsm','xlsb','xltm','xlt','xla','xlr']))
            $icon = 'fa-file-excel';
        if (in_array(strtolower($row['file_type']), ['zip','rar','tar']))
            $icon = 'fa-file-archive';
    ?>
    <tr class='file-item' data-id="<?php echo $row['id'] ?>" data-name="<?php echo $name ?>" data-organization="<?php echo $row['organization'] ?>" data-description="<?php echo $row['description'] ?>">

        <td><i><?php echo ucwords($row['uname']) ?></i></td>
        <td>
            <large>
                <span><i class="fa <?php echo $icon ?>"></i></span>
                <b> <?php echo $name ?></b>
            </large>
            <input type="text" class="rename_file" value="<?php echo $row['name'] ?>" data-id="<?php echo $row['id'] ?>" data-type="<?php echo $row['file_type'] ?>" style="display: none">
        </td>
        <td><i><?php echo date('Y/m/d h:i A', strtotime($row['date_updated'])) ?></i></td>
        <td><i><?php echo $row['description'] ?></i></td>
        <td><i><?php echo $row['organization'] ?></i></td>
    </tr>
							
					<?php endwhile; ?>
					</table>
					
				</div>
			</div>
			
		</div>
	</div>

</div>
<div id="menu-file-clone" style="display: none;">
	<a href="javascript:void(0)" class="custom-menu-list file-option download"><span><i class="fa fa-download"></i> </span>Download</a>
</div>
<script>
	//FILE
	$('.file-item').bind("contextmenu", function(event) { 
    event.preventDefault();

    $('.file-item').removeClass('active')
    $(this).addClass('active')
    $("div.custom-menu").hide();
    var custom =$("<div class='custom-menu file'></div>")
        custom.append($('#menu-file-clone').html())
        custom.find('.download').attr('data-id',$(this).attr('data-id'))
    custom.appendTo("body")
	custom.css({top: event.pageY + "px", left: event.pageX + "px"});

	
	$("div.file.custom-menu .download").click(function(e){
		e.preventDefault()
		window.open('download.php?id='+$(this).attr('data-id'))
	})

	

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
})

$(document).ready(function() {
    // Handle sorting when any sorter dropdown value changes
    $('.sorter').change(function() {
        var sortBy = $(this).val();
        var organization = $('#organizationSorter').val();
        var description = $('#descriptionSorter').val();
        
        // Populate description dropdown based on the selected organization
        if (organization === 'OCD') {
            $('#descriptionSorter').html(`
			<option value="">Select Description</option>
                <option value="Officer Order">Officer Order</option>
                <option value="PPBER">PPBER</option>
                <option value="MAR">MAR</option>
                <option value="OPC/OPCR">OPC/OPCR</option>
                <option value="NARRATIVE ACCOMPLISHMENT">NARRATIVE ACCOMPLISHMENT</option>
                <option value="LETTER">LETTER</option>
                <option value="ACTIVITY DESIGN">ACTIVITY DESIGN</option>
                <option value="PROJECT PROPOSAL">PROJECT PROPOSAL</option>
                <option value="DF">DF</option>
                <option value="PROCUREMENT DOCS">PROCUREMENT DOCS</option>
                <option value="ATTENDANCE">ATTENDANCE</option>
                <option value="TRAVEL ORDER">TRAVEL ORDER</option>
                <option value="OTHER PLEASE SPECIFY">OTHER PLEASE SPECIFY</option>
            `);
        } else if (organization === 'RDRRMC') {
            $('#descriptionSorter').html(`
			<option value="">Select Description</option>
                <option value="MEMORANDUM">MEMORANDUM</option>
                <option value="RESOLUTION">RESOLUTION</option>
                <option value="MINUTES">MINUTES</option>
                <option value="ATTENDANCE">ATTENDANCE</option>
                <option value="LETTERS">LETTERS</option>
                <option value="AFTER ACTIVITY REPORT">AFTER ACTIVITY REPORT</option>
                <option value="GAWAD KALASAG SEAL">GAWAD KALASAG SEAL</option>
                <option value="GAWAD KALASAG SPECIAL AWARD">GAWAD KALASAG SPECIAL AWARD</option>
                <option value="LOCAL DRRM PLAN REVIEW">LOCAL DRRM PLAN REVIEW</option>
                <option value="TRAVEL ORDER">TRAVEL ORDER</option>
            `);
        } else {
            $('#descriptionSorter').html('<option value="">Sort by Description</option>');
        }
        
        // Perform the sorting and filtering
        $('.file-item').each(function() {
            var organizationMatch = true;
            var descriptionMatch = true;
            
            if (organization && $(this).data('organization') !== organization) {
                organizationMatch = false;
            }
            if (description && $(this).data('description') !== description) {
                descriptionMatch = false;
            }
            
            if (organizationMatch && descriptionMatch) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
        
        // Show/hide the description dropdown based on the selected organization
        if (organization) {
            $('#descriptionSorter').show();
        } else {
            $('#descriptionSorter').hide();
        }
    });
});

$(document).ready(function() {
    // Handle sorting when any sorter dropdown value changes
    $('.sorter').change(function() {
        var organization = $('#organizationSorter').val();
        var description = $('#descriptionSorter').val();
        
        // Perform the sorting and filtering
        $('.file-item').each(function() {
            var organizationMatch = true;
            var descriptionMatch = true;
            
            if (organization && $(this).data('organization') !== organization) {
                organizationMatch = false;
            }
            if (description && $(this).data('description') !== description) {
                descriptionMatch = false;
            }
            
            if (organizationMatch && descriptionMatch) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
        
        // Show/hide the description dropdown based on the selected organization
        if (organization) {
            $('#descriptionSorter').show();
        } else {
            $('#descriptionSorter').hide();
        }
    });
    
    // Handle sorting when description dropdown value changes
    $('#descriptionSorter').change(function() {
        var organization = $('#organizationSorter').val();
        var description = $(this).val();
        
        // Perform the sorting and filtering
        $('.file-item').each(function() {
            var organizationMatch = true;
            var descriptionMatch = true;
            
            if (organization && $(this).data('organization') !== organization) {
                organizationMatch = false;
            }
            if (description && $(this).data('description') !== description) {
                descriptionMatch = false;
            }
            
            if (organizationMatch && descriptionMatch) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });
});
	

</script>