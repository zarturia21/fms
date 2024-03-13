<link rel="stylesheet" type="text/css" href="modal-backdrop-styles.css">


<?php 
include('db_connect.php');
if(isset($_GET['id'])){
    // Fetch file details from the database
    $qry = $conn->query("SELECT * FROM files WHERE id=".$_GET['id']);
    if($qry->num_rows > 0){
        // Store file details in $meta array
        foreach($qry->fetch_array() as $k => $v){
            $meta[$k] = $v;
        }
    }
}
?>

<div class="container-fluid">
    <form action="" id="manage-files" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo isset($_GET['id']) ? $_GET['id'] :'' ?>">
        <input type="hidden" name="folder_id" value="<?php echo isset($_GET['fid']) ? $_GET['fid'] :'' ?>">

        <?php if(!isset($_GET['id']) || empty($_GET['id'])): ?>
            <div class="input-group mb-3">
    <div class="input-group-prepend">
        <span class="input-group-text">Upload</span>
    </div>
    <div class="custom-file">
        <input type="file" class="custom-file-input" name="upload" id="upload" onchange="displayname(this,$(this))">
        <label class="custom-file-label" for="upload">Choose file</label>
    </div>
</div>

        <?php endif; ?>

        <div class="form-group">
            <label for="organization" class="control-label">Organization</label>
            <select name="organization" id="organization" class="form-control">
                <option value="">Select Organization</option>
                <option value="OCD">OCD</option>
                <option value="RDRRMC">RDRRMC</option>
                <!-- Add more options as needed -->
            </select>
        </div>

        <div class="form-group">
            <label for="description" class="control-label">Description</label>
            <select name="description" id="description" class="form-control">
                <?php
                if (isset($meta['description'])) {
                    echo '<option value="' . $meta['description'] . '" selected>' . $meta['description'] . '</option>';
                } else {
                    echo '<option value="">Select Description</option>';
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="year" class="control-label">Year</label>
                <select name="year" id="year" class="form-control">
            <option value="">Select Year</option>
        <?php
        for ($year = 2010; $year <= 2030; $year++) {
            echo '<option value="' . $year . '">' . $year . '</option>';
        }
        ?>
    </select>
</div>


        <div class="form-group">
            <label for="is_public" class="control-label"><input type="checkbox" name="is_public" id="is_public"> Share to All Users</label>
        </div>

        <div class="form-group" id="msg"></div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


<script>
    $(document).ready(function(){
        $('#organization').change(function(){
            var organization = $(this).val();
            $.ajax({
                url: 'ajax.php?action=get_options',
                method: 'POST',
                data: { organization: organization },
                success:function(resp){
                    $('#description').html(resp);
                }
            });
        });

        $('#manage-files').submit(function(e){
            e.preventDefault();
            start_load();
            $('#msg').html('');
            $.ajax({
                url:'ajax.php?action=save_files',
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success:function(resp){
                    if(typeof resp != undefined){
                        resp = JSON.parse(resp);
                        if(resp.status == 1){
                            alert_toast("New File successfully added.",'success')
                            setTimeout(function(){
                                location.reload()
                            },1500)
                        }else{
                            $('#msg').html('<div class="alert alert-danger">'+resp.msg+'</div>')
                            end_load()
                        }
                    }
                }
            })
        });
    });

    function displayname(input,_this) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                _this.siblings('label').html(input.files[0]['name']);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>