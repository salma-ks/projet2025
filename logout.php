<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_destroy();
    header("Location: index.php"); 
    exit;
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تسجيل الخروج</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Tahoma', 'Arial', sans-serif;
      direction: rtl;
      text-align: right;
      background: linear-gradient(135deg, rgb(2, 18, 32), rgb(12, 54, 122));
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .logout-container {
      background: white;
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
      animation: slideUp 0.6s ease-out;
      text-align: center;
    }
    @keyframes slideUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .form-title {
      font-size: 28px;
      color: #1e4a72;
      font-weight: bold;
      margin-bottom: 30px;
    }
    .submit-btn {
      width: 100%;
      height: 55px;
      background: linear-gradient(135deg, #1e4a72, #2d5aa0);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 18px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
      margin-bottom: 20px;
    }
    .submit-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(30, 74, 114, 0.3);
    }
    .submit-btn:active { transform: translateY(0); }
  </style>
</head>
<body>
  <div class="logout-container">
    <h1 class="form-title">هل أنت متأكد أنك تريد تسجيل الخروج؟</h1>
    <form method="POST">
      <button type="submit" class="submit-btn">تسجيل الخروج</button>
    </form>
  </div>
</body>
</html>
