<?php
// تضمين الاتصال بقاعدة البيانات
include "include/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // الحصول على البيانات من النموذج ومعالجتها
    $name = htmlspecialchars($_POST["name"]);
    $email = htmlspecialchars($_POST["email"]);
    $phone = htmlspecialchars($_POST["phone"]);
    $issue = htmlspecialchars($_POST["issue"]);

    // استعلام إدراج البيانات في جدول contact
    $sql = "INSERT INTO contact (name, email, phone, issue) VALUES (:name, :email, :phone, :issue)";

    try {
        $stmt = $pdo->prepare($sql);

        // ربط القيم مع المتغيرات
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':issue', $issue);

        // تنفيذ الاستعلام
        if ($stmt->execute()) {
            // رسالة تنبيه باستخدام JavaScript
            echo "<script>
                alert('Thank you, $name. We have received your message!');
                window.location.href = 'index.php'; // إعادة توجيه إلى index.php
            </script>";
            exit();
        } else {
            echo "<script>alert('There was an error submitting your message. Please try again.');</script>";
        }
    } catch (PDOException $e) {
        echo "<script>alert('Error: " . $e->getMessage() . "');</script>";
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="contact.css">
</head>
<body>
    <header>
        <h1>Contact Us</h1>
    </header>
    <main>
        <section class="form-container">
            <h2>We're here to help</h2>
            <form action="contact.php" method="post">
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="issue">Your Issue</label>
                    <textarea id="issue" name="issue" rows="5" required></textarea>
                </div>
                <button type="submit">Submit</button>
            </form>
        </section>
    </main>
    <style>
        /* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

/* Body Styling */
body {
    font-family: 'Arial', sans-serif;
    background: #f5f5f5;
    color: #333;
    padding: 20px;
}

/* Header */
header {
    background: linear-gradient(135deg, #007aff, #0056cc);
    color: #fff;
    text-align: center;
    padding: 20px 0;
}

header h1 {
    font-size: 2.5rem;
}

/* Form Container */
.form-container {
    max-width: 600px;
    background: #fff;
    margin: 50px auto;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
    text-align: center;
}

.form-container h2 {
    font-size: 1.8rem;
    margin-bottom: 20px;
    color: #222;
}

.form-group {
    margin-bottom: 20px;
    text-align: left;
}

.form-group label {
    display: block;
    font-size: 1rem;
    margin-bottom: 5px;
    color: #555;
}

.form-group input,
.form-group textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 5px;
    font-size: 1rem;
    transition: border-color 0.3s ease;
}

.form-group input:focus,
.form-group textarea:focus {
    border-color: #007aff;
    outline: none;
}

button {
    background: #007aff;
    color: #fff;
    border: none;
    padding: 10px 20px;
    font-size: 1rem;
    border-radius: 5px;
    cursor: pointer;
    transition: background 0.3s ease;
}

button:hover {
    background: #0056cc;
}

    </style>

    
</body>

</html>
