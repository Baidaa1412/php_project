<?php 

echo "<form>
<input type='hidden' name='userid' value='anonymos'>
<input type='hidden' name='date' value=' .date(Y-m-d H:i:s)'>
<textarea name='comment'></textarea>
<button type='submit'> comment<button>
</form>";

require("conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $conn = new PDO("mysql:host=localhost:4306;dbname=presento", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $userId = "anonymos";
        $date = date("Y-m-d H:i:s");
        $comment = $_POST["comment"];

        $sql = "INSERT INTO comments (userId, date, comment) VALUES (:userId, :date, :comment)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":userId", $userId);
        $stmt->bindParam(":date", $date);
        $stmt->bindParam(":comment", $comment);
        $stmt->execute();
        
        echo "Comment inserted successfully!";
    } catch (PDOException $e) {
        echo "Insertion failed: " . $e->getMessage();
    }

    $conn = null; // Close the database connection
}
?>