<?php
require_once '../helper/data-base.php';
require_once '../helper/helper-functions.php';
?>

<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>وبسایت آرمان رجایی</title>
  <link rel="stylesheet" href="../Assets/style/main.css" />
  <link rel="stylesheet" href="../Assets/style/post.css" />
  <!-- <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    /> -->
</head>

<body>
  <?php
  if (isset($_GET['posts_id'])) {
    $post_id = $_GET['posts_id'];
    global $pdo;
    $query = 'SELECT * FROM posts WHERE id = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$post_id]);
    $post = $stmt->fetch();
  ?>
    <div class="post-container">
      <div class="post-section">
        <h3 class="post-title"><?= $post['title'] ?></h3>
      </div>
      <div class="post-meta">
        <div class="meta-item">
          <i class="fa-solid fa-calendar-days"></i>
          <span><?= $post['created_at'] ?></span>
        </div>
        <div class="meta-item">
          <i class="fa-solid fa-clock"></i>
          <span><?= $post['time_reading'] ?> دقیقه</span>
        </div>
        <div class="meta-item">
          <i class="fa-solid fa-industry"></i>
          <span><?= $post['user_id'] ?></span>
        </div>
      </div>
      <hr class="line">
      <img
        class="post-thumbnail"
        src="<?= asset($post['image']) ?>"
        alt="عکس پست" />
      <div class="content-of-post">
        <div class="tabs-header">
          <button class="tab-btn active">توضیحات</button>
          <button class="tab-btn" onclick="showAlert()">نظرات</button>
        </div>
        <section class="tab-content">
          <p>
            <?= $post['content'] ?>
          </p>
        </section>
      </div>
    </div>
    <script src="../assets/js/script.js"></script>
</body>

</html>
<?php } ?>