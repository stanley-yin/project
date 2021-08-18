<style>
    .cart-icon{
        padding-top: 6px;
    }
</style>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="./index_.php">首頁</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./data-list.php">門市資訊</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">醫院</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">商品</a>
                </li>

            </ul>

            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link"></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">登入</a>
                </li>

                <li class="nav-item active">
                    <a class="nav-link" href="login.php">登出</a>
                </li>
                <li class="nav-item active cart-icon">
                        <a class="nav-link" href="cart-check.php" >
                            <i class="fas fa-shopping-cart"><?= isset($_SESSION['total']) ? $_SESSION['total']: ''; ?></i>
                        </a>
                </li>

            </ul>

        </div>
    </div>
</nav>