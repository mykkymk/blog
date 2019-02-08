<?php include 'includes/header.php'; ?>
<?php
  //create DB Object
  $db = new Database();

  //create query
  $query = "SELECT * FROM posts ORDER BY date DESC";

  //run the query
  $posts = $db->select($query);
  
  //create query
  $query = "SELECT * FROM categories";

  //run the query
  $categories = $db->select($query);
?>
<?php if($posts) : ?>
  <?php while($row = $posts->fetch_assoc()) : ?>
    <div class="blog-post">
      <h2 class="blog-post-title"><?php echo $row['title']; ?></h2>
      <p class="blog-post-meta"><?php echo formatDate($row['date']); ?> by <a href="#"><?php echo $row['author']; ?></a></p>
      <?php echo shortenText($row['body']); ?>
      <a href="post.php?id=<?php echo urlencode($row['id']); ?>" class="readmore">Read more</a>
    </div><!-- /.blog-post -->
  <?php endwhile; ?>
<?php else : ?>
  <p>There are no posts yet.</p>
<?php endif; ?>
<?php include 'includes/footer.php'; ?>

        