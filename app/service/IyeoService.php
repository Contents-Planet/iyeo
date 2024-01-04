<?

namespace app\service;

require_once  $_SERVER["DOCUMENT_ROOT"] . '/app/service/MysqlService.php';

use \app\service\MysqlService;

class IyeoService extends MysqlService
{
    private $table = '';

    function __construct()
    {
        $this->table = 'inquiry';
        parent::__construct("iyeo");
    }

    public function inquiryList($type, $page)
    {
        $orderBy = [
            "column" => "created_at",
            "sort" => "desc"
        ];
        $column = ["*"];
        $where = [
            "inquiry_type = '" . $type . "'",
        ];

        return $this->getMultiSelect($this->table, $where, $column, $orderBy, $page, 10);
    }

    public function inquiryCount($type = ""): mixed
    {
        $where = [
            "inquiry_type = '" . $type . "'",
        ];
        return $this->getDataCount($this->table, $where);
    }

    public function inquiryCreate($data): void
    {
        $this->createRow($this->table, $data);
    }

    public function inquiryDetail($seq, $type = ""): array
    {
        $where = ["seq = " . $seq];
        $column = ["*"];

        if ($type) {
            array_push($where, "inquiry_type = '" . $type . "'");
        }

        return $this->getSingleSelect($this->table, $where, $column);
    }


    public function productList($page)
    {
        $orderBy = [
            "column" => "sort",
            "sort" => "desc"
        ];
        $column = ["*"];
        $where = [
            "is_active = 'Y' ",
        ];

        return $this->getMultiSelect("product", $where, $column, $orderBy, $page, 10);
    }

    public function productCount(): mixed
    {
        $where = [
            "is_active = 'Y' ",
        ];
        return $this->getDataCount("product", $where);
    }

    public function getNextPreSeqs($seq, $type)
    {
        $column = ["
            (SELECT seq FROM " . $this->table . " WHERE inquiry_type = '" . $type . "' AND seq < " . $seq . " ORDER BY seq DESC LIMIT 1) as preSeq,
            (SELECT seq FROM " . $this->table . " WHERE inquiry_type = '" . $type . "' AND seq > " . $seq . " ORDER BY seq LIMIT 1) as nextSeq
        "];
        $where = ["inquiry_type = '" . $type . "' "];
        return $this->getSingleSelect($this->table, $where, $column);
    }

    public function hitAddCount($seq, $hit)
    {
        $where = [" seq = " . $seq];
        $set = [
            "hit" => (int)$hit + 1
        ];
        $this->updateRows($this->table, $set, $where);
    }

    public function getMenus()
    {
        $orderBy = [
            "column" => "seq",
            "sort" => "desc"
        ];
        $column = ["*"];
        $where = [
            "is_active = 'Y' ",
        ];

        return $this->getMultiSelect("product", $where, $column, $orderBy, 1, 1000);
    }
}
