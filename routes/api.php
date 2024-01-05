<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/app/service/IyeoService.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/app/service/MailService.php';

use app\service\IyeoService;
use app\service\MailService;

$mode = isset($_POST['mode']) ? $_POST['mode'] : null;

switch ($mode) {

  case "write":
    try {
      $type = isset($_POST['type']) ? $_POST['type'] : null;

      $iyeoService = new IyeoService();
      $mailService = new MailService();

      $inputData = match ($type) {
        "startups" => [
          "inquiry_type" => $type,
          "name" => $_POST['name'],
          "phone" => $_POST['phone'],
          "area" => $_POST['area'],
          "area2" => $_POST['area2'],
          "area3" => $_POST['area3'],
          "content" => $_POST['content'],
          "created_at" => date('Y-m-d H:i:s')
        ],
        "customer" => [
          "inquiry_type" => $type,
          "name" => $_POST['name'],
          "phone" => $_POST['phone'],
          "pw" => $_POST['pw'],
          "title" => $_POST['title'],
          "content" => $_POST['content'],
          "created_at" => date('Y-m-d H:i:s')
        ],
        default => [],
      };

      $iyeoService->inquiryCreate($inputData);

      $mailService->inquirySendMail();

      echo ("<script>location.href='/page/inquiry_success.php?type=" . $type . "'; </script>");
    } catch (Exception $e) {
      // echo $e->getMessage();
      exit;
    }
    break;

  case "getList":
    try {
      $iyeoService = new IyeoService();
      $page = $_POST['page'] ?? 1;
      $type = $_POST['type'] ?? "customer";
      $datas = $iyeoService->inquiryList($type, $page);
      $inquiryCount = $iyeoService->inquiryCount($type);

      $cnt = 0;

      foreach ($datas as $data) {
        $results["datas"][$cnt]["seqs"] = $data['seq'];
        $results["datas"][$cnt]["inquiry_type"] = $data['inquiry_type'];
        $results["datas"][$cnt]["name"]  = ($type === "notice" ? $data['name'] : preg_replace('/.(?=.$)/u', '*', $data['name']));
        $results["datas"][$cnt]["title"] = $data['title'];
        $results["datas"][$cnt]["content"] = $data['content'];
        $results["datas"][$cnt]["reg_date"] = date("Y-m-d", strtotime($data['created_at']));
        $results["datas"][$cnt]["reple_yn"] = $data['is_check'];
        $cnt++;
      }

      $results["result"] = 200;
      $results["total_count"] = $inquiryCount;
      echo json_encode($results);
    } catch (Exception $e) {

      echo json_encode([
        "result" => 400,
        "message" => $e->getMessage()
      ]);
    }
    break;

  case "passwordCheck":
    try {
      $seq = $_POST['seq'];
      $password = $_POST['password'];

      $iyeoService = new IyeoService();

      $inquiryPwd = $iyeoService->inquiryDetail($seq)['pw'];

      $results["result"] = 200;
      $results["seq"] = $seq;
      $results["passwordCheck"] = ($password == $inquiryPwd);

      echo json_encode($results);
    } catch (Exception $e) {

      echo json_encode([
        "result" => 400,
        // "message" => $e->getMessage()
      ]);
    }

    break;

  case "getProducts":
    try {
      $iyeoService = new IyeoService();
      $page = $_POST['page'] ?? 1;
      $datas = $iyeoService->productList($page);
      $productCount = $iyeoService->productCount($type);

      $cnt = 0;

      foreach ($datas as $data) {
        $results["datas"][$cnt]["seqs"] = $data['seq'];
        $results["datas"][$cnt]["name"]  = $data['name'];
        $results["datas"][$cnt]["sort"] = $data['sort'];
        $results["datas"][$cnt]["content"] = $data['content'];
        $results["datas"][$cnt]["reg_date"] = date("Y-m-d", strtotime($data['reg_date']));
        $results["datas"][$cnt]["img"] = $data['img'];
        $cnt++;
      }

      $results["result"] = 200;
      $results["total_count"] = $productCount;

      echo json_encode($results);
    } catch (Exception $e) {

      echo json_encode([
        "result" => 400,
        "message" => $e->getMessage()
      ]);
    }

    break;

  case "viewDetail":
    try {
      $seq = $_POST['seq'];

      $iyeoService = new IyeoService();

      $data = $iyeoService->inquiryDetail($seq);
      // $preNextSeqs = $iyeoService->getNextPreSeqs($seq);

      $results["datas"] = [
        "seq" => $data['seq'],
        "inquiry_type" => $data['inquiry_type'],
        "name" => $data['name'],
        "phone" => $data['phone'],
        "area" => $data['area'],
        "area2" => $data['area2'],
        "area3" => $data['area3'],
        "title" => $data['title'],
        "content" => $data['content'],
        "check_name" => $data['check_name'],
        "is_check" => $data['is_check'],
        "check_date" => $data['check_date'],
        "memo" => $data['memo'],
        "created_at" => $data['created_at'],
      ];

      $results["result"] = 200;



      echo json_encode($results);
    } catch (Exception $e) {

      echo json_encode([
        "result" => 400,
        "message" => $e->getMessage()
      ]);
    }

    break;

    case "getMenus":
    try {
      $iyeoService = new IyeoService();

      $datas = $iyeoService->getMenus();
      $cnt = 0;

      foreach ($datas as $data) {
        $results["datas"][$cnt]["img"] = $data['img'];
        $content = str_replace('<span style="color:rgb(31,31,31);">', '', $data['content']);
        $content = str_replace('</span>', '', $content);
        $results["datas"][$cnt]["tit"] = $data['name'];
        $results["datas"][$cnt]["dec"] = $content;
        $results["datas"][$cnt]["sort"] = $data['sort'];
        $cnt++;
      }

      $results["result"] = 200;

      echo json_encode($results);
    } catch (Exception $e) {

      echo json_encode([
        "result" => 400,
        "message" => $e->getMessage()
      ]);
    }

    break;
};

exit;
