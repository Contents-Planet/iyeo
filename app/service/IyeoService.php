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

    public function inquiryList($type,$page)
    {
        $orderBy = [
            "column" => "created_at",
            "sort" => "desc"
        ];
        $column = ["*"];
        $where = [
            "inquiry_type = '".$type."'" , 
        ];

        return $this->getMultiSelect($this->table, $where, $column, $orderBy,$page,10);
    }
    
    public function inquiryCount($type =""): mixed
    {
        $where = [
            "inquiry_type = '".$type."'" , 
        ];
        return $this->getDataCount($this->table, $where);
    }

    public function inquiryCreate($data): void
    {
        $this->createRow($this->table, $data);
    }

    public function inquiryDetail($seq): array
    {
        $where = ["seq = " . $seq];
        $column = ["*"];

        return $this->getSingleSelect($this->table, $where, $column);
    }


}
