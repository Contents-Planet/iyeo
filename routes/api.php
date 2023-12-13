<?php

require_once $_SERVER["DOCUMENT_ROOT"] . '/app/service/IyeoService.php';

use app\service\IyeoService;

$mode = isset($_POST['mode']) ? $_POST['mode'] : null;

switch ($mode) {

  case "write":
    try {
      $type = isset($_POST['type']) ? $_POST['type'] : null;

      $iyeoService = new IyeoService();

      $inputData = match ($type) {
        "startups" => [
          "inquiry_type" => $type,
          "name" => $_POST['name'],
          "phone" => $_POST['phone'],
          "area" => $_POST['area'],
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

      echo ("<script> alert('문의를 등록했습니다.'); location.href='/page/inquiry'; </script>");
    } catch (Exception $e) {
      // echo $e->getMessage();
      exit;
    }
  case "getList":
    try {
      $iyeoService = new IyeoService();
      $page = $_GET['page'] ?? 1;
      $type = $_GET['type'] ?? "customer";
      $datas = $iyeoService->inquiryList($type,$page);
      $cnt = 0;

      foreach ($datas as $data) {
        $results["datas"][$cnt]["name"]  = preg_replace('/.(?=.$)/u', '*', $data['name']);
        $results["datas"][$cnt]["title"] = $data['title'];
        $results["datas"][$cnt]["reg_date"] = date("Y-m-d", strtotime($data['created_at']));
        $results["datas"][$cnt]["reple_yn"] = $data['is_check'];
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
    exit;
    break;

    break;
};
exit;
