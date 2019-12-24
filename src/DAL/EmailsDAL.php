<?php
namespace DAL;
include 'DbConnection.php';

class Emails {
    private $db;

    public function __construct(){
        $this->db = DbConnection::getInstance();
    }
	
	function sendEmail($sender, $receiver, $subject, $emailsText, $isReceived, $notSent){
        try {
            $sql = "EXEC insert_email ?, ?, ?, ?, ?, ?";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam($sender, $receiver, $subject, $emailsText, $isReceived, $notSent);
            $stmt->execute();
        } catch(PDOException $e){
            return $e->getMessage();
        }
    }

    function deleteEmail($intId, $isDeleted){
        try {
            $sql = "EXEC delete_email ?, ?"; // must do update proc set isDeleted to 1 (true) or delete procedure
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam($intId, $isDeleted);
            $stmt->execute();
        } catch (PDOException $e){
            return $e->getMessage();
        }

    }

    function getEmail(){
        try {
            $sql = "select * from sent_emails";
            $stmt = $this->db->prepare($sql);
            $stmt->execute();

            $result = $stmt->get_result();

            if ($result->num_rows === 1) {
                return $result->fetch_assoc();
            } else {
                return null;
            }
        } catch(PDOException $e){
            return $e->getMessage();
        }
    }
}
    ?>