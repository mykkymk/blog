<?php include 'includes/header.php'; ?>
<?php
    $id = $_GET['id'];

    //create db object
    $db = new Database;
    
    //create query
    $query = "SELECT * FROM posts WHERE id=".$id;
    //run query
    $post = $db->select($query)->fetch_assoc();

    //create a query
    $query = "SELECT * FROM categories";
    //run query
    $categories = $db->select($query);
?>
<?php
if (isset($_POST['submit'])) {
        //assign variables
    $title = mysqli_real_escape_string($db->link, $_POST['title']);
    $body = mysqli_real_escape_string($db->link, $_POST['body']);
    $category = mysqli_real_escape_string($db->link, $_POST['category']);
    $author = mysqli_real_escape_string($db->link, $_POST['author']);
    $tags = mysqli_real_escape_string($db->link, $_POST['tags']);

        //validation
    if ($title == '' || $body == '' || $category == '' || $author == '') {
            //set error
        $error = 'Please fill out all required fields';
    } else {
            //create query
        $query = "UPDATE posts
                        SET
                        title = '$title',
                        body = '$body',
                        category = '$category',
                        author = '$author',
                        tags = '$tags'
                        WHERE id = ".$id;

            //run query
        $update_row = $db->update($query);
    }
}
?>
<?php
    if(isset($_POST['delete'])){
        //create a query
        $query = "DELETE FROM posts WHERE id= ".$id;
        $delete_row = $db->delete($query);
    }
?>
    <form action="edit_post.php?id=<?php echo $id; ?>" method="post" role="form">
        <div class="form-group">
            <label>Post Tile</label>
            <input type="text" name="title" class="form-control" placeholder="Enter Title" value="<?php echo $post['title']; ?>">
        </div>
        <div class="form-group">
            <label>Post Body</label>
            <textarea name="body" placeholder="Enter Post Body" class="form-control" rows="20"><?php echo $post['body']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Category</label>
            <select name="category" class="form-control">
                <?php while($row = $categories->fetch_assoc()) : ?>
                    <?php
                        if($row['id'] == $post['category']){
                            $selected = 'selected';
                        }else{
                            $selected = '';
                        }
                    ?>
                    <option  value="<?php echo $row['id']; ?>" <?php echo $selected; ?>><?php echo $row['name']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Author</label>
            <input type="text" name="author" class="form-control" placeholder="Enter author name" value="<?php echo $post['author']; ?>">
        </div>
        <div class="form-group">
            <label>Tags</label>
            <input type="text" name="tags" class="form-control" placeholder="Enter Tags" value="<?php echo $post['tags']; ?>">
        </div>
        <div>
            <input type="submit" name="submit" class="btn btn-default" value="Submit">
            <a href="index.php" class="btn btn-default">Cancel</a>
            <input type="submit" name="delete" class="btn btn-danger" value="Delete">
        </div>
        <br>
    </form>

<?php include 'includes/footer.php'; ?>