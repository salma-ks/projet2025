<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $email = $_POST['email'];

    if (empty($nom) || empty($email)) {
        echo "<script>alert('يرجى إدخال جميع المعلومات');</script>";
    } else {
        try {
            
            $stmt = $pdo->prepare("SELECT ID_MEMBERS, NOM, EMAIL, TYPE_MEMBERS FROM les_membres WHERE NOM = ? AND EMAIL = ?");
            $stmt->execute([$nom, $email]);
            $user = $stmt->fetch();

            if ($user) {
                
                $_SESSION['user_id'] = $user['ID_MEMBRE'];
                $_SESSION['user_name'] = $user['NOM'];
                $_SESSION['user_type'] = $user['TYPE_MEMBERS'];

                
                if ($user['TYPE_MEMBERS'] == 2) {
                    header("Location: dashboard.php"); 
                } else {
                    header("Location: useraccount.php"); 
                }
                exit();
            } else {
                echo "<script>alert('المستخدم غير موجود أو البيانات غير صحيحة');</script>";
            }
        } catch (PDOException $e) {
            echo "error" . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>تسجيل الدخول</title>
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
    .login-container {
      background: white;
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 500px;
      animation: slideUp 0.6s ease-out;
    }
    @keyframes slideUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    .form-header { text-align: center; margin-bottom: 30px; }
    .form-title { font-size: 28px; color: #1e4a72; font-weight: bold; margin-bottom: 10px; }
    .form-group { margin-bottom: 20px; position: relative; }
    .form-input {
      width: 100%;
      padding: 15px 20px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 18px;
      background-color: #f8f9fa;
      transition: all 0.3s ease;
      outline: none;
      text-align: right;
      height: 55px;
    }
    .form-input:focus {
      border-color: #1e4a72;
      background-color: white;
      box-shadow: 0 0 0 3px rgba(30, 74, 114, 0.1);
    }
    .form-input::placeholder { color: #999; font-size: 16px; }
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
    .signup-link {
      text-align: center;
      color: #666;
      font-size: 14px;
    }
    .signup-link a {
      color: #1e4a72;
      text-decoration: none;
      font-weight: bold;
    }
    .signup-link a:hover { text-decoration: underline; }
    @media (max-width: 600px) {
      .login-container { padding: 20px 15px; max-width: 95%; }
    }
  </style>
</head>
<body>
  <div class="login-container">
    <div class="form-header">
      <h1 class="form-title">تسجيل الدخول</h1>
    </div>
    <form id="loginForm" method="POST">
      <div class="form-group">
        <input type="text" class="form-input" placeholder="اسم المستخدم" name="nom" required>
      </div>
      <div class="form-group">
        <input type="text" class="form-input" placeholder="البريد الإلكتروني" name="email" required>
      </div>
      <button type="submit" class="submit-btn">تسجيل الدخول</button>
      <div class="signup-link">
        ليس لدي حساب؟ <a href="sign.up.php">إنشاء حساب</a>
      </div>
    </form>
  </div>
</body>
</html>
