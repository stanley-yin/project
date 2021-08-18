<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="./data-list.php">商品列表</a>
        </li>
      </ul>

      <ul class="navbar-nav">
        <!-- 登入成功會出現的，在init.php 檔案裏要先啟用session才能執行 -->
        <?php if (isset($_SESSION['user'])) : ?>
          <li class="nav-item active">
            <a class="nav-link" style="color: red;"><?= '嗨~', $_SESSION['user']['nickname'] ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">登出</a>
          </li>
          <li class="nav-item active">
            <a href="cart-check.php">
              <i class="fas fa-shopping-cart"><?= isset($_SESSION['total'])? $_SESSION['total']: '';?></i>
            </a>
          </li>
          <!-- 沒登入時會出現的 -->
        <?php else : ?>
          <li class="nav-item active">
            <a href="cart-check.php">
              <i class="fas fa-shopping-cart"></i>
            </a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="login.php">登入</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">註冊</a>
          </li>
        <?php endif; ?>
      </ul>

    </div>
  </div>
</nav>