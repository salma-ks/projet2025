<?php
session_start();

if (!isset($_SESSION['user_name'])) {

    header("Location: login.php");
    exit();
}

$userName = $_SESSION['user_name'];
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>حسابي</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <style>
    * {
      box-sizing: border-box;
      padding: 0;
      margin: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background: linear-gradient(to bottom left, #003366, #005fa3);
      color: white;
      min-height: 150vh;
      display: flex;
      flex-direction: column;
    }

    header {
      background-color: #002d5a;
      padding: 20px;
      text-align: right;
      font-size: 24px;
      font-weight: bold;
    }

    nav {
      background-color: #001f3f;
      padding: 10px 20px;
      display: flex;
      justify-content: space-between;
    }

    nav a {
      color: white;
      text-decoration: none;
      font-weight: bold;
      margin: 0 10px;
    }

    .welcome-box {
      background-color: #003366;
      margin: 20px auto;
      padding: 20px;
      width: 90%;
      border-radius: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 4px 10px rgba(0,0,0,0.3);
    }

    .welcome-box i {
      font-size: 30px;
      background-color: white;
      color: #003366;
      border-radius: 50%;
      padding: 10px;
    }

    .account-status {
      background-color: white;
      color: #003366;
      margin: 10px auto;
      width: 90%;
      padding: 20px;
      border-radius: 15px;
    }

    .account-status h3 {
      margin-bottom: 10px;
    }

    .account-status button {
      padding: 10px 20px;
      background-color: #003366;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .confirmation-box {
      display: none; 
      margin: 20px auto;
      background-color: #e0e0e0;
      color: #003366;
      width: 90%;
      padding: 15px;
      border-radius: 10px;
      text-align: center;
    }

    @media (max-width: 768px) {
      .welcome-box, .account-status, .confirmation-box {
        flex-direction: column;
        text-align: center;
      }
    }
  </style>
</head>
<body>
  <header>حسابي</header>
  <nav>
    <a href="home.php">العودة</a>
    <a href="logout.php">تسجيل الخروج</a>
  </nav>

  <div class="welcome-box">
    <h2>مرحباً <?php echo htmlspecialchars($userName); ?>! <br> لقد تم تسجيلك بنجاح</h2>
    <i class="fas fa-user"></i>
  </div>

  <div class="account-status">
    <h3>حالة الحساب</h3>
    <p>الحساب نشط. لديك صلاحيات كاملة.</p>
    <br>
    <button id="show-details">عرض التفاصيل</button>
  </div>

  <div class="confirmation-box" id="confirmation-box">
    تم التحقق من رقم الهاتف والبريد الإلكتروني، ولا توجد مشاكل حالياً.
  </div>


  <script>
    const button = document.getElementById("show-details");
    const confirmationBox = document.getElementById("confirmation-box");

    button.addEventListener("click", () => {
      confirmationBox.style.display = "block";
    });
  </script>
</body>
</html>
