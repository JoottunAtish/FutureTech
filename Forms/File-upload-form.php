<form class="p-3" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="file" class="form-label">Choose file</label>
            <input
                type="file"
                class="form-control"
                name="file-select"
                id="file-select"
                placeholder="Choose a File..."
                
            />
            <div id="fileHelpId" class="form-text">Upload type: jpg, jpeg, png</div>
        </div>

        <p class="text-danger"> <?php echo $err_msg ?> </p>
        <p class="text-success"> <?php echo $success_msg ?> </p>

        <button type="submit" class="btn btn-primary">Submit</button>

    </form>