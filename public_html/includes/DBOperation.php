<?php include_once('./../database/db.php');
$db = new Database();
?>

<?php
class DBOperation{
    private $conn;
    function __construct()
    {
        global $db;
        $this->conn = $db->connect();
        if ($this->conn) {
            "Database connected to the DBOperation";
        }
    }

    /* Catagory Query Here */

    public function Category($parent_cat,$cat_name)
    {
        $status = 1;
        $sql = "INSERT INTO `categories`(`parent_cat`, `category_name`, `status`) VALUES (?,?,?)";
        $query = $this->conn->prepare($sql);
        $query->bind_param('isi',$parent_cat,$cat_name,$status);
        $result = $query->execute();
        if ($result) {
           return "Category added";
           
        } else {
           return "Category Not added";
        }
        
    }

    

    public function allRecords($table)
    {
        $sql = "SELECT * FROM $table";
        $selectQuery = $this->conn->prepare($sql);
        $selectQuery->execute();
        $result = $selectQuery->get_result();
        $rows = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array()) {
                print_r(array_push($rows,$row));

            }
            return $rows;
        }else{
           return "No data found";
        }
        
    }

}
/* Check whether this DBOperation is working or not */
// $obj = new DBOperation();
// echo $obj->Category(1,"Electronics");
//  echo $obj->allRecords("categories");
?>