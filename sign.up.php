<?php
session_start();
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_DEFAULT);
    $adress = $_POST['adress'];
    $userType = $_POST['userType'];

    // Convert user type to numeric value for database
    $type_members = 0;

    if ($userType === 'volunteer') {
        $type_members = 1;
    } elseif ($userType === 'association_head') {
        $type_members = 2;
    } elseif ($userType === 'association_member') {
        $type_members = 3;
    }

    if (empty($nom) || empty($number) || empty($email) || empty($mot_de_passe) || empty($adress)) {
        echo "يرجى إدخال جميع المعلومات";
    } else {
        try {
            // Insert into les_membres
            $stmt = $pdo->prepare("INSERT INTO les_membres (NOM, PHONE_NUMBER, EMAIL, MOT_DE_PASSE, ADRESS, DATE, TYPE_MEMBERS) VALUES (?, ?, ?, ?, ?, NOW(), ?)");
            $stmt->execute([$nom, $number, $email, $mot_de_passe, $adress, $type_members]);

            // Get last inserted ID
            $membre_id = $pdo->lastInsertId();
            $_SESSION['user_id'] = $membre_id;
            $_SESSION['user_name'] = $nom;

            // Insert into role-specific table
            if ($userType === 'volunteer') {
                $stmt2 = $pdo->prepare("INSERT INTO benevole (ID_BENEVOL, NOM, PHONE_NUMBER, EMAIL, ADRESS) VALUES (?, ?, ?, ?, ?)");
                $stmt2->execute([$membre_id, $nom, $number, $email, $adress]);
            } elseif ($userType === 'association_head') {
                $stmt3 = $pdo->prepare("INSERT INTO les_associations (ID_ASSOCIATION, NOM, PHONE_NUMBER, EMAIL, ADRESS) VALUES (?, ?, ?, ?, ?)");
                $stmt3->execute([$membre_id, $nom, $number, $email, $adress]);
            }

            // Redirect based on user type
            if ($userType === 'association_head') {
                header("Location: dashboard.php");
            } else {
                header("Location: useraccount.php");
            }
            exit();

        } catch (PDOException $e) {
            echo "error " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>إنشاء حساب</title>
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
    .signup-container {
      background: white;
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 700px;
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
      width: 100%; padding: 15px 20px; border: 2px solid #e0e0e0; border-radius: 8px;
      font-size: 16px; background-color: #f8f9fa; transition: all 0.3s ease; outline: none; text-align: right;
    }
    .form-input:focus { border-color: #1e4a72; background-color: white; box-shadow: 0 0 0 3px rgba(30, 74, 114, 0.1); }
    .form-input::placeholder { color: #999; font-size: 14px; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; margin-bottom: 20px; }
    .radio-group { background-color: #f8f9fa; border: 2px solid #e0e0e0; border-radius: 8px; padding: 20px; margin-bottom: 20px; }
    .radio-item { display: flex; align-items: center; margin-bottom: 12px; cursor: pointer; }
    .radio-item:last-child { margin-bottom: 0; }
    .radio-input { margin-left: 10px; margin-right: 0; width: 18px; height: 18px; accent-color: #1e4a72; }
    .radio-label { font-size: 14px; color: #333; cursor: pointer; }
    .submit-btn {
      width: 100%; padding: 15px; background: linear-gradient(135deg, #1e4a72, #2d5aa0);
      color: white; border: none; border-radius: 8px; font-size: 18px; font-weight: bold; cursor: pointer;
      transition: all 0.3s ease; margin-bottom: 20px;
    }
    .submit-btn:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(30, 74, 114, 0.3); }
    .submit-btn:active { transform: translateY(0); }
    .login-link { text-align: center; color: #666; font-size: 14px; }
    .login-link a { color: #1e4a72; text-decoration: none; font-weight: bold; }
    .login-link a:hover { text-decoration: underline; }
    @media (max-width: 768px) {
      .signup-container { padding: 30px 20px; }
      .form-row { grid-template-columns: 1fr; gap: 15px; }
      .form-title { font-size: 24px; }
    }
    @media (max-width: 600px) {
      .signup-container { padding: 20px 15px; max-width: 95%; }
    }
  </style>
</head>
<body>
  <div class="signup-container">
    <div class="form-header">
      <h1 class="form-title">إنشاء حساب</h1>
    </div>
    <form id="signupForm" method="POST">
      <div class="form-row">
        <div class="form-group">
          <input type="text" class="form-input" placeholder="اسم المستخدم" name="nom" required>
        </div>
        <div class="form-group">
          <input type="text" class="form-input" placeholder="رقم الهاتف" name="number" required>
        </div>
        <div class="form-group">
          <input type="email" class="form-input" placeholder="البريد الإلكتروني" name="email" required>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group">
          <input type="password" class="form-input" placeholder="كلمة المرور" name="mot_de_passe" required>
        </div>
        <div class="form-group">
          <input type="text" class="form-input" placeholder="العنوان" name="adress" required>
        </div>
        <div class="form-group"></div>
      </div>
      <div class="radio-group">
        <div class="radio-item">
          <input type="radio" id="volunteer" name="userType" value="volunteer" class="radio-input" checked>
          <label for="volunteer" class="radio-label">متطوع</label>
        </div>
        <div class="radio-item">
          <input type="radio" id="association_head" name="userType" value="association_head" class="radio-input">
          <label for="association_head" class="radio-label">رئيس جمعية</label>
        </div>
        <div class="radio-item">
          <input type="radio" id="association_member" name="userType" value="association_member" class="radio-input">
          <label for="association_member" class="radio-label">عضو جمعية</label>
        </div>
      </div>
      <button type="submit" class="submit-btn">إنشاء حساب</button>
      <div class="login-link">
        هل لديك حساب بالفعل؟ <a href="login.php">تسجيل الدخول</a>
      </div>
    </form>
  </div>
</body>
</html>
