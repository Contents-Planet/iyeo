<?php
    $type = $_GET['type'] ?? null ;
    $_title = ($type == 'startups') ? "창업 문의" : "1:1 문의";
?>

<!doctype html>
<html lang="ko">

<head>
    <title><?= $_title ?> | 이여 F&B</title>
    <meta property="og:title" content="<?= $_title ?> | 이여 F&B" />
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
                    <h2 class="header-tit"><?= $_title ?></h2>
                </header>
                <ul class="location-bar flex">
                    <li><a href="/" class="nav-item hone"><span class="a11y">Home</span></a></li>
                    <li><span class="nav-item"><span class="txt">창업안내</span></span></li>
                    <li><span class="nav-item"><span class="txt"><?= $_title ?></span></span></li>
                </ul>
            </div>
        </section>
        <div id="container">
            <div id="contents">
                <section class="sec sec4">
                    <div class="m-main">
                        <article class="article a2">
                            <header class="sec-header">
                                <h3 class="small-tit"><?= $_title ?></h3>
                            </header>
                            <div class="tbl-container">
                                <div class="over-wrap">
                                    <form action='/routes/api' method='post'>
                                        <table class="tbl">
                                            <input type='hidden' value='write' name='mode'>
                                            <input type='hidden' value='<?= $type ?>' name='type'>
                                            <colgroup>
                                                <col style="width:33%" />
                                                <col style="width:66%" />
                                            </colgroup>
                                            <thead>
                                                <tr>
                                                    <th colspan="2">이여곰탕 <?= $_title?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <th>성명</th>
                                                    <td><input type='text' style='border:0; border-bottom:1px solid #eee;' name='name'  placeholder="성명을 입력해주세요."></td>
                                                </tr>
                                                <tr>
                                                    <th>연락처</th>
                                                    <td><input type='text' style='border:0; border-bottom:1px solid #eee;' name='phone'  placeholder="연락처를 입력해주세요."></td>
                                                </tr>
                                                <?php if($type == 'startups'){?>
                                                    <tr>
                                                        <th rowspan="2">희망지역</th>
                                                        <td>
                                                            <input type='text' style='width:48%;border:0; border-bottom:1px solid #eee;' placeholder="시/도" name='area'>
                                                            <input type='text' style='width:48%;border:0; border-bottom:1px solid #eee;' placeholder="시/구/군" name='area2'>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <input type='text' style='width:98%; border:0; border-bottom:1px solid #eee;'  placeholder="상세주소" name='area3'>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                <?php if($type == 'customer'){?>
                                                    <tr>
                                                        <th>문의 제목</th>
                                                        <td><input type='text' style='border:0; border-bottom:1px solid #eee;'  placeholder="문의제목을 입력해주세요."name='title'></td>
                                                    </tr>
                                                <?php } ?>
                                                    <tr>
                                                        <th>문의 내용</th>
                                                        <td><textarea style='width:100%; height:240px; border:0; border-bottom:1px solid #eee;'  placeholder="문의내용을 입력해주세요." name='content'></textarea></td>
                                                    </tr>
                                                <?php if($type == 'customer'){?>
                                                    <tr>
                                                        <th>문의 비밀번호</th>
                                                        <td><input type='password' style='width:100%;border:0; border-bottom:1px solid #eee;' placeholder="1:1문의 비밀번호를 입력해주세요." name='pw'></td>
                                                    </tr>
                                                <?php } ?>
                                                <tr>
                                                    <th colspan='2'><input type='submit' value='문의하기' style='width:340px;'></th>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </form>
                                </div>
                            </div>
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