<?php 

$page = $_GET['page'] ?? 1;

?>

<!doctype html>
<html lang="ko">

<head>
    <title>창업 안내 | 이여 F&B</title>
    <meta property="og:title" content="창업 안내 | 이여 F&B" />
    <meta property="og:url" content="https://iyeo.co.kr/page/startup" />

    <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/page/_inc/head.php"; ?>
</head>

<body>

    <div id="wrap" class="page-startup type-sub">
        <header id="header">
            <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/page/_inc/header.php"; ?>
            <input type="hidden" id="depth1" value="4" />
        </header>

        <section class="sec sec-kv" style="background-image:url(https://static.econtents.co.kr/_img/iyeo/bg_sub4.webp)">
            <div class="m-main">
                <header class="page-header">
                    <h2 class="header-tit">창업 안내</h2>
                </header>
                <ul class="location-bar flex">
                    <li><a href="/" class="nav-item hone"><span class="a11y">Home</span></a></li>
                    <li><span class="nav-item"><span class="txt">창업 안내</span></span></li>
                </ul>
            </div>
        </section>
        <div id="container">
            <div id="contents">
                <input type='hidden' id='inquiry_page' name='inquiry_page' value="<?= $page ?>">
                <section class="sec sec2">
                    <div class="m-main">
                        <ul class="feat-flex flex">
                            <li>
                                <div class="box" style='border-radius:5px;'>
                                    <a href='/page/inquiry_write?type=startups'>
                                        <strong class="tit t4">창업 문의</strong>
                                    </a>
                                    <p class="dec">
                                        창업을 문의해보세요. 상세하게 안내해 드립니다.
                                    </p>

                                </div>
                            </li>
                            <li>
                                <div class="box" style='border-radius:5px;'>
                                    <a href='/page/inquiry_write?type=customer'>
                                        <strong class="tit t3">1:1 문의</strong>
                                    </a>
                                    <p class="dec">
                                        궁금한 것을 말씀해주세요. 친절하게 답변해드립니다.
                                    </p>
                                </div>
                            </li>
                        </ul>
                        <article class="article">
                            <table class="tbl t-list">
                                <colgroup>
                                    <col style="width:120px" />
                                    <col />
                                    <col style="width:160px" />
                                    <col style="width:100px" />
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>문의자</th>
                                        <th>문의 제목</th>
                                        <th>문의 일자</th>
                                        <th>답변여부</th>
                                    </tr>
                                </thead>
                                <tbody data-selector="listAppend"></tbody>
                            </table>
                        </article>
                    </div>

                </section>
            </div>
        </div>

        <footer id="footer">
            <?php include_once $_SERVER["DOCUMENT_ROOT"] . "/page/_inc/footer.php"; ?>
        </footer>
    </div>
    <script src="/_asset/_js/page.inquiry.js"></script>
</body>

</html>