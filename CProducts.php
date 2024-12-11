<?php
class CProducts {
    private $db;

    public function __construct($host, $username, $password, $dbname) {
        $this->db = new mysqli($host, $username, $password, $dbname);

        if ($this->db->connect_error) {
            die("Ошибка подключения к базе данных: " . $this->db->connect_error);
        }
    }

    public function getProducts($limit = 10) {
        $stmt = $this->db->prepare("SELECT * FROM Products WHERE IS_HIDDEN = FALSE ORDER BY DATE_CREATE DESC LIMIT ?");
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function hideProduct($id) {
        $stmt = $this->db->prepare("UPDATE Products SET IS_HIDDEN = TRUE WHERE ID = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
    }

    public function updateQuantity($id, $quantity) {
        $stmt = $this->db->prepare("UPDATE Products SET PRODUCT_QUANTITY = ? WHERE ID = ?");
        $stmt->bind_param("ii", $quantity, $id);
        $stmt->execute();
    }
}
?>
