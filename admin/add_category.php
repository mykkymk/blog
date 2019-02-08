<?php include 'includes/header.php'; ?>
<?php
    //create db object
    $db = new Database;

    if(isset($_POST['submit'])) {
        //assign variables
        $name = mysqli_real_escape_string($db->link, $_POST['name']);

        //validation
        if ($name == '') {
            //set error
            $error = 'Please fill out all required fields';
        } else {
            //create query
            $query = "INSERT INTO categories (name) VALUES ('$name')";

            //run query
            $update_row = $db->update($query);
        }
    }
?>
<form action="add_category.php" method="post" role="form">
    <div class="form-group">
        <label>Category Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter Category">
    </div>
    <div>
        <input type="submit" name="submit" class="btn btn-default" value="Submit">
        <a href="index.php" class="btn btn-default">Cancel</a>
    </div>
    <br>
</form>

<?php include 'includes/footer.php'; ?>