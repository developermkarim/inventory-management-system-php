<?php include('./../database/db.php'); ?>

<?php
class User{
    private $conn;
    function __construct()
    {
        $db = new Database();
        $this->conn = $db->connect();
        if ($this->conn) {
            echo "Database connected";
        }else{
            echo "Database not connectedd";
        }
    }
/* Email Exixsts already function*/
public function EmailExists($email)
{
   $sql = "SELECT id from user WHERE email = ?";
   $email_query = $this->conn->prepare($sql);
   $email_query->bind_param('s',$email);
   $email_query->execute();
   $result = $email_query->get_result();
   if ($result->num_rows > 0) {
    return 1;
   }else{
    return 0;
   }
}
    /* Registraion function method here with prepare and bind_param for outside insecure injection while attacking */
    public function CreateUser($user,$email,$password,$usertype)
    {
        if ($this->EmailExists($email)) {
           echo "Email_Already_Exists";
        }else{
        $register_date = date('d/m/Y');
        $last_login = date('Y-m-d');

        // PASSWORD_DEFAULT & PASSWORD_BCRYPT are not major difference. And cost is used for iteration number of algorithm that are executed.

       $encrypted_password = password_hash($password,PASSWORD_BCRYPT,['cost'=>8]);
        $notes = "";
        $sql = "INSERT INTO `user`(`username`, `email`, `password`, `usertype`, `register_date`, `last_login`, `notes`) VALUES (?,?,?,?,?,?,?)";
        $query = $this->conn->prepare($sql);
        $query->bind_param("sssssss",$user,$email,$encrypted_password,$usertype,$register_date,$last_login,$notes);
        $result =  $query->execute() or die($this->conn->error);
        if ($result) {
          $this->conn->insert_id;
        }else{
            return "Email_not_found";
        }
    }
    }

    public function userLogin($email,$password)
    {
        $sql = "SELECT id, username,email,last_login,password FROM user where email=?";
        $query = $this->conn->prepare($sql);
        $query->bind_param('s',$email);
        $query->execute();
        $result = $query->get_result();
        if ($result->num_rows < 1) {
            return "Not Registered with this email";
        }else{

            $row = $result->fetch_assoc();
            if(password_verify($password, $row['password'])){
                
            $_SESSION['userid'] = $row['id'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['last_login'] = $row['last_login'];
            $update_last_login = date("Y-m-d h:m:s");
            // Here we are updating user last login time when he is performing login
                $update = "UPDATE user SET last_login= ? WHERE email=?";
                $query2 = $this->conn->prepare($update);
                $query2->bind_param('ss',$update_last_login,$email);
                $result = $query2->execute() or die($this->conn->error);
                if ($result) {
                   return 1;
                }else {
                    return 0;
                }

            }else {
                return "Password doesn't Matched";
            }
           
        }
    }
}

/* To Check the user and class is working or not.Database connection,insert,update and Select query perfectly work here */
//  $obj_user = new User();
// echo $obj_user->CreateUser("mkarim123","m.karimcu@gmail.com","mmk1234","Admin");echo "<br>";
// echo $obj_user->userLogin("m.karimcu@gmail.com","mmk1234");
// echo $obj_user->EmailExists('m.karimcu@gmail.com');
?>