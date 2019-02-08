<?php include 'includes/header.php'; ?>
<?php
    //create db object
    $db = new Database;
    
    if(isset($_POST['submit'])){
        //assign variables
        $title = mysqli_real_escape_string($db->link, $_POST['title']);
        $body = mysqli_real_escape_string($db->link, $_POST['body']);
        $category = mysqli_real_escape_string($db->link, $_POST['category']);
        $author = mysqli_real_escape_string($db->link, $_POST['author']);
        $tags = mysqli_real_escape_string($db->link, $_POST['tags']);

        //validation
        if($title == '' || $body == ''|| $category == '' || $author == ''){
            //set error
            $error = 'Please fill out all required fields';
        }else{
            //create query
            $query = "INSERT INTO posts (title, body, category, author, tags) VALUES ('$title', '$body', '$category', '$author', '$tags')";

            //run query
            $insert_row = $db->insert($query);
        }
    }
?>
<?php
    //create a query
    $query = "SELECT * FROM categories";
    //run query
    $categories = $db->select($query);
?>
    <form action="add_post.php" method="post" role="form">
        <div class="form-group">
            <label>Post Tile</label>
            <input type="text" name="title" class="form-control" placeholder="Enter Title">
        </div>
        <div class="form-group">
            <label>Post Body</label>
            <textarea name="body" placeholder="Enter Post Body" class="form-control" rows="20"></textarea>
        </div>
        <div class="form-group">
            <label>Category</label>
            <select name="category" class="form-control">
                <?php while ($row = $categories->fetch_assoc()) : ?>
                    <?php
                    if ($row['id'] == $post['category']) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                    ?>
                    <option <?php echo $selected; ?> value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group">
            <label>Author</label>
            <input type="text" name="author" class="form-control" placeholder="Enter author name">
        </div>
        <div class="form-group">
            <label>Tags</label>
            <input type="text" name="tags" class="form-control" placeholder="Enter Tags">
        </div>
        <div>
            <input type="submit" name="submit" class="btn btn-default" value="Submit">
            <a href="index.php" class="btn btn-default">Cancel</a>
        </div>
        <br>
    </form>

<?php include 'includes/footer.php'; ?>