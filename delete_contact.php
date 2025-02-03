<?php
// تضمين الاتصال بقاعدة البيانات
include "include/db.php";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    try {
        // استعلام حذف السجل
        $sql = "DELETE FROM contact WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            header("Location: liste_contact.php?message=" . urlencode("Contact deleted successfully!"));
            exit();
        } else {
            echo "Error deleting contact.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
