<?php 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
class Database
{
    private static $instance = null;
    private $conn;

    private function __construct()
    {
        try {
            $this->conn = new PDO(
                "mysql:host=localhost;dbname=employee",
                "root",
                "NewStrongPass123!"
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public static function getinstance()
    {
        if(self::$instance===null)
            {
                self::$instance= new Database();
            }
            return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }



    // delete 
    public function deleteUser($id)
    {
        $stmt = $this->conn->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->rowCount();
    }

    // update
  public function updateUser($id, $data)
    {
        $stmt = $this->conn->prepare("UPDATE users 
            SET first_name=?, last_name=?, address=?, country=?, gender=?, 
                skills=?, password=?, department=?, email=?, image=? 
            WHERE id=?");

        return $stmt->execute([
            $data['first_name'],
            $data['last_name'],
            $data['address'],
            $data['country'],
            $data['gender'],
            $data['skills'],
            $data['password'],
            $data['department'],
            $data['email'],
            $data['image'],
            $id
        ]);
    }

    // add
    public function insertUser($data)
{
    $stmt = $this->conn->prepare("INSERT INTO users
        (first_name, last_name, address, country, gender, skills, password, department, email, image)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    return $stmt->execute([
        $data['first_name'],
        $data['last_name'],
        $data['address'],
        $data['country'],
        $data['gender'],
        $data['skills'],
        $data['password'],
        $data['department'],
        $data['email'],
        $data['image']
    ]);
}

//get user
public function getUser($id)
{
$stmt = $this->conn->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$id]);
return $stmt->fetch(PDO::FETCH_ASSOC);
}

// get all user
public function getAllUsers()
{
    $stmt = $this->conn->prepare("SELECT id,first_name,last_name,address,country,gender,skills,department,email,image FROM users");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//login 
public function loginUser($email, $password)
{
    $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ? AND password = ? LIMIT 1");
    $stmt->execute([$email, $password]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
}
?>