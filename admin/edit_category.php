<?php include 'includes/header.php'; ?>
<?php
    $id = $_GET['id'];

    //create db object
    $db = new Database;
    
    //create query
    $query = "SELECT * FROM categories WHERE id=". $id;
    //run query
    $category = $db->select($query)->fetch_assoc();

    //create a query
    $query = "SELECT * FROM categories";
    //run query
    $categories = $db->select($query);
?>
<?php
    if (isset($_POST['submit'])) {
        //assign variables
        $name = mysqli_real_escape_string($db->link, $_POST['name']);

        //validation
        if ($name == '') {
            //set error
            $error = 'Please fill out all required fields';
        } else {
            //create query
            $query = "UPDATE categories
                SET
                name = '$name'
                WHERE id=".$id;

            //run query
            $update_row = $db->update($query);
    }
}
?>
<?php
    if (isset($_POST['delete'])) {
        //create a query
        $query = "DELETE FROM categories WHERE id= " . $id;
        $delete_row = $db->delete($query);
    }
?>
<form action="edit_category.php?id=<?php echo $id; ?>" method="post" role="form">
    <div class="form-group">
        <label>Category Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter Category" value="<?php echo $category['name']; ?>">
    </div>
    <div>
        <input type="submit" name="submit" class="btn btn-default" value="Submit">
        <a href="index.php" class="btn btn-default">Cancel</a>
        <input type="submit" name="delete" class="btn btn-danger" value="Delete">
    </div>
    <br>
</form>

<?php include 'includes/footer.php'; ?>