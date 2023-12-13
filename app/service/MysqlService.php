<?

namespace app\service;

class MysqlService
{
    private $database = '';
    private $host = 'planworks.cvjejucpf1xq.ap-northeast-2.rds.amazonaws.com';
    private $userid = 'root';
    private $password = 'plan!db6200**';
    protected $db;

    public function __construct($db="iyeo")
    {
        $this->database = $db;
        $this->db = $this->connectDB();      
    }

    function __destruct()
    {
        mysqli_close($this->connectDB());
    }

    private function connectDB()
    {
        $dbconn = mysqli_connect($this->host, $this->userid, $this->password, $this->database);
        mysqli_set_charset($dbconn, "utf8");
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        } else {
            return $dbconn;
        }
    }

    function getUidData($table, $uid): mixed
    {
        return $this->getDbData($table, 'uid=' . (int)$uid, '*');
    }

    // DB Query Cutom 함수
    /** 
     * param $table string
     * param $where string
     * param $column array
     */
    function getDbData($table, $where, $column): array
    {
        $result = mysqli_query($this->db, 'select ' . $this->getColumnFilter($column) . ' from ' . $table . $this->getSqlFilter($where));
        $row = mysqli_fetch_array($result);
        return $row;
    }

    function createRow($table,$data){
        $keyArray = [];
        $valueArray = [];
        
        foreach($data as $key => $val){
            $keyArray[] = $key;
            $valueArray[] = "'".$val."'";
        }


        $query = "  INSERT INTO " . $table . " 
                    (" . $this->getColumnFilter($keyArray) . ") 
                    VALUES 
                    (" . $this->getColumnFilter($valueArray) . ")";

        mysqli_query($this->db, $query);
    }

    function getSingleSelect($table, $where, $column): mixed
    {

        $result = mysqli_query(
            $this->db,
            'SELECT ' . $this->getColumnFilter($column) . ' FROM ' . $table
                . $this->getSqlFilter($where)
        );

        $row = mysqli_fetch_array($result);
        return $row;
    }

    function getMultiSelect($table, $where, $column, $orderBy, $page=1, $listNum=100): mixed
    {
        
        $result = mysqli_query(
            $this->db,
            'SELECT ' . $this->getColumnFilter($column) . ' FROM ' . $table
                . $this->getSqlFilter($where)
                . $this->getOrderFilter($orderBy)
                . $this->getLimitFilter($page, $listNum)
        );
        return $result;
       
    }

    // DB Query result 함수
    function getDbresult($table, $where, $column): mixed
    {
        $result = mysqli_query($this->db, 'select ' . $this->getColumnFilter($column) . ' from ' . $table . $this->getSqlFilter($where));
        return $result;
    }

    //DB데이터 ARRAY -> 테이블에 출력할 데이터 배열
    function getDbArray($table, $where, $column, $orderby, $rowsPage, $curPage): mixed
    {
        $sql = 'select ' . $this->getColumnFilter($column) . ' from ' . $table . $this->getSqlFilter($where) . ($orderby ? ' order by ' . $orderby : '') . ($rowsPage ? ' limit ' . (($curPage - 1) * $rowsPage) . ', ' . $rowsPage : '');
        if ($result = mysqli_query($this->db, $sql)) {
            return $result;
        }
    }

    //DB데이터 레코드 총 개수
    function getDataCount($table, $where): int
    {
        $sql = 'select count(*) from ' . $table . $this->getSqlFilter($where);
        if ($result = mysqli_query($this->db, $sql)) {
            $rows = mysqli_fetch_row($result);
            return $rows[0] ? $rows[0] : 0;
        }
    }

    //DB업데이트
    function getDbUpdate($table, $set, $where): void
    {
        mysqli_query($this->db, "update " . $table . " set " . $this->getColumnFilter($set) . $this->getSqlFilter($where));
    }

    //DB업데이트
    function updateRows($table, $set, $where): void
    {
        mysqli_query($this->db, "update " . $table . " set " . $this->getSetFilter($set) . $this->getSqlFilter($where));
    }

    //DB삭제
    function getDbDelete($table, $where): void
    {
        mysqli_query($this->db, "delete from " . $table . $this->getSqlFilter($where));
    }

    //Where필터링
    function getSqlFilter($sql): string
    {
        $returnSql = " where ";
        $returnSql .= implode(' AND ', $sql);
        return (!empty($sql)) ? $returnSql : "";
    }

    //column 필터링
    function getColumnFilter($column): string
    {
        $afterColumn = implode(',', $column);
        return $afterColumn;
    }

    //update SET 필터링
    function getSetFilter($set): string
    {
        $afterArray = [];
        foreach($set as $key => $val){
            $afterArray[] = $key." = '".$val."'";
        }
        $afterSet = implode(',', $afterArray);
        return $afterSet;
    }

    function getLimitFilter($page, $listNum): string
    {
        $startNum = ($page - 1) * $listNum;
        $endNum = $listNum;
        $limit = " limit " . $startNum . ", " . $endNum;
        return (!empty($page) || !empty($page)) ? $limit : "";
    }

    function getOrderFilter($orderBy): string
    {
        return (!empty($orderBy['column']) || !empty($orderBy['sort'])) ? " order by " . $orderBy['column'] . " " . $orderBy['sort'] : "";
    }
}
