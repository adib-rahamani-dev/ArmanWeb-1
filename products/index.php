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

  <link rel="stylesheet" href="../Assets/style/sample_work.css" />
  <link rel="stylesheet" href="../Assets/style/main.css" />
  <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
    />
</head>

<body>
  <?php
  if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    global $pdo;
    $query = 'SELECT * FROM products WHERE id = ?';
    $stmt = $pdo->prepare($query);
    $stmt->execute([$product_id]);
    $product = $stmt->fetch();
  ?>
    <div class="page-wrap">
      <section class="information-section">
        <div class="content">
          <h1 class="product-name"><?= $product['title'] ?></h1>
          <p class="short-info"><?= $product['information'] ?></p>
          <p class="short-info"><?= $product['information_2'] ?></p>
          <p class="short-info"><?= $product['information_3'] ?></p>
          <div class="price-and-actions">
            <div class="price">
              <h4 class="title">قیمت:</h4>
              <span class="old-price">190,000</span>
              <p class="new-price"><?= $product['price'] ?></p>
              <div class="price-unit">
                <p>تومان</p>
              </div>
            </div>
            <div class="add-action">
              <button class="add-to-cart">افزودن به سبد خرید</button>
              <button class="add-to-favorites"><i class="fa-solid fa-floppy-disk"></i></button>
            </div>
          </div>
        </div>
        <div class="image-wrapper">
          <img src="<?= asset($product['image']) ?>"alt="عکس محصول" />
        </div>
      </section>
      <div class="information">
        <div class="info-item">
          <i class="fa-solid fa-shield-halved"></i>
          <p>ضمانت</p>
        </div>
        <div class="info-separator"></div>
        <div class="info-item">
          <i class="fa-solid fa-truck-fast"></i>
          <p>تحویل سریع</p>
        </div>
        <div class="info-separator"></div>
        <div class="info-item">
          <i class="fa-solid fa-star"></i>
          <p>رضایت کارفرما</p>
        </div>
      </div>
      <div class="comments-and-description">
        <div class="tabs-header">
          <button class="tab-btn active">توضیحات</button>
          <button class="tab-btn" onclick="showAlert()">نظرات</button>
        </div>
        <section class="tab-content show-long-description">
          <p>
          <?= $product['description'] ?>
          </p>
        </section>
      </div>
      <div class="information">
        <div class="info-item">
          <i class="fa-solid fa-calendar-days"></i>
          <p>تاریخ تولید</p>
        </div>
        <div class="info-separator"></div>
        <div class="info-item">
          <i class="fa-solid fa-box"></i>
          <p>نوع محصول</p>
        </div>
        <div class="info-separator"></div>
        <div class="info-item">
          <i class="fa-solid fa-chart-line"></i>
          <p>بازدهی</p>
        </div>
        <div class="info-separator"></div>
        <div class="info-item">
          <i class="fa-solid fa-industry"></i>
          <p>سازنده</p>
        </div>
      </div>
    </div>
    </div>
    <script src="../assets/js/script.js"></script>
</body>

</html>
<?php } ?>