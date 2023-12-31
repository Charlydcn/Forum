<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="https://cdn.tiny.cloud/1/zg3mwraazn1b2ezih16je1tc6z7gwp5yd4pod06ae5uai8pa/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" integrity="sha256-h20CPZ0QyXlBuAw7A+KluUYx/3pK+c7lYEpqLTlxjYQ=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/style.css">
    <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/<?= isset($css) && $css ? $css : ""?>">
    <link rel="stylesheet" href="<?= PUBLIC_DIR ?>/css/<?= isset($css2) && $css2 ? $css2 : ""?>">
    <title>FORUM</title>
</head>

<body>
    <div id="wrapper">

        <div id="mainpage">
            
            <header>
                <nav>
                    <!-- RESPONSIVE NAV -->
                    <div id="openBtn">
                        <span></span>
                    </div>

                    <a href="index.php?ctrl=home">FORUM</a>

                    <!-- user login/register/details -->
                    <div id="user-nav">
                    <?php
                        if (App\Session::getUser()) {
                        ?>

                            <a href="index.php?ctrl=forum&action=userDetails&id=<?= App\Session::getUser()->getId() ?>"><i class="fas fa-user"></i></a>
                            <a href="index.php?ctrl=security&action=logOff&id=<?= App\Session::getUser()->getId() ?>">Log off</a>

                        <?php
                        } else {
                        ?>
                            <a href="index.php?ctrl=security&action=displayLogin"><i class="fas fa-user"></i></a>

                        <?php } ?>
                    </div>
                    <!-- ******************************** -->

                    <!-- DESKTOP NAV -->
                    <div id="nav-left">
                        <a class="hover-underline-animation" href="index.php?ctrl=home">Home</a>
                        <?php
                        if (App\Session::isAdmin()) {
                        ?>
                            <a class="hover-underline-animation"  href="index.php?ctrl=forum&action=listUsers">Users</a>

                        <?php
                        }
                        ?>
                        <a class="hover-underline-animation"  href="index.php?ctrl=forum&action=listCategories">Categories</a>
                        <a class="hover-underline-animation"  href="index.php?ctrl=forum&action=listTopics">Topics</a>
                    </div>

                    <div id="nav-right">

                        <?php
                        if (App\Session::getUser()) {
                        ?>

                            <a class="hover-underline-animation"  href="index.php?ctrl=forum&action=userDetails&id=<?= App\Session::getUser()->getId() ?>"><span class="fas fa-user"></span>&nbsp;<?= App\Session::getUser()->getUsername() ?></a>
                            <a class="hover-underline-animation"  href="index.php?ctrl=security&action=logOff&id=<?= App\Session::getUser()->getId() ?>">Log off</a>

                        <?php
                        } else {
                        ?>
                            <a class="hover-underline-animation"  href="index.php?ctrl=security&action=displayLogin">Log in</a>
                            <a class="hover-underline-animation"  href="index.php?ctrl=security&action=displayRegister">Register</a>

                        <?php } ?>

                    </div>
                    
                </nav>
                <div id="nav-menu">
                    <h1>FORUM</h1>
                    <ul>
                        <li><a href="index.php?ctrl=home">Home</a></li>
                        <?php
                        if (App\Session::isAdmin()) {
                        ?>
                            <li><a href="index.php?ctrl=forum&action=listUsers">Users</a></li>

                        <?php } ?>
                        <li><a href="index.php?ctrl=forum&action=listCategories">Categories</a></li>
                        <li><a href="index.php?ctrl=forum&action=listTopics">Topics</a></li>
                    </ul>
                </div>
            </header>

            <!-- c'est ici que les messages (erreur ou succès) s'affichent-->
            <h3 class="message errorMsg"><?= App\Session::getFlash("error") ?></h3>
            <h3 class="message successMsg"><?= App\Session::getFlash("success") ?></h3>

            <main id="forum">
                <?= $page ?>
            </main>
        </div>

        <footer>
            <div>
                <a href="#">Forum CDA</a> | <a href="#">Forum's regulations</a> | <a href="#">Legal notices</a>
            </div>
            <p>2020 © Forum</p>
        </footer>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
    </script>
    <script src="<?= PUBLIC_DIR ?>/js/script.js"></script>
    <script>
        $(document).ready(function() {
            $(".message").each(function() {
                if ($(this).text().length > 0) {
                    $(this).slideDown(500, function() {
                        $(this).delay(3000).slideUp(500)
                    })
                }
            })
            $(".delete-btn").on("click", function() {
                return confirm("Etes-vous sûr de vouloir supprimer?")
            })
            tinymce.init({
                selector: '.post',
                menubar: false,
                plugins: [
                    'advlist autolink lists link image charmap print preview anchor',
                    'searchreplace visualblocks code fullscreen',
                    'insertdatetime media table paste code help wordcount autoresize'
                ],
                toolbar: 'undo redo | bold italic backcolor',
                width: '100%',

                content_css: '//www.tiny.cloud/css/codepen.min.css'
            });
        })

        $(document).ready(function(){
            $('#nav-icon1,#nav-icon2,#openBtn,#nav-icon4').click(function(){
                $(this).toggleClass('open');
            });
        });
    </script>
</body>

</html>