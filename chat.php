<?php
session_start();
require 'config.php';

// fetch the list of members
$stmt = $pdo->query("SELECT ID_MEMBERS, NOM, TYPE_MEMBERS FROM les_membres");
$membres = $stmt->fetchAll(PDO::FETCH_ASSOC);

//function of afficher type of member
function afficherType($type) {
    if ($type == 1) return "متطوع";
    if ($type == 2) return "رئيس جمعية";
    if ($type == 3) return "عضو جمعية";
    return "";
}

// send and have a message
$message_envoye = false;
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["message"])) {
    $message = htmlspecialchars($_POST["message"]);
    $message_envoye = true;
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <title>الدردشة</title>
  <style>
    body {
      font-family: 'Tahoma', sans-serif;
      background-color: #f4f6f9;
      margin: 0;
      padding: 0;
      direction: rtl;
    }
    header {
  background: linear-gradient(135deg, #034E88, #023053);
  color: white;
  padding: 15px 0;
  text-align: center;
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  position: relative;
  overflow: hidden;
}

header::before {
  content: "";
  position: absolute;
  top: 0;
  right: 0;
  width: 100%;
  height: 100%;
  background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none"><path fill="rgba(255,255,255,0.05)" d="M0,0 L100,0 L100,100 L0,100 Z" /></svg>');
  background-size: 50px 50px;
  opacity: 0.3;
}

.header-content {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 20px;
  max-width: 1100px;
  margin: 0 auto;
  padding: 0 20px;
  position: relative;
}
.img-logo{
  width: 70px;
  height: 70px;
}
.logo {
  width: 70px;
  height: 70px;
  background-color: white;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 3px 6px rgba(0,0,0,0.16);
  border: 3px solid #4EA54E;
}

.header-text {
  text-align: right;
}

.header-text h1 {
  margin-top: 15px;
  font-size: 28px;
  text-shadow: 1px 1px 3px rgba(0,0,0,0.3);
}

.header-text p {
  font-size: 16px;
  opacity: 0.9;
}

nav {
  background-color: rgba(0,0,0,0.2);
  padding: 12px;
  display: flex;
  justify-content: center;
  gap: 30px;
  backdrop-filter: blur(5px);
  position: relative;
}

nav a {
  color: #fff;
  text-decoration: none;
  font-weight: bold;
  font-size: 16px;
  transition: all 0.3s ease;
  padding: 5px 10px;
  border-radius: 4px;
  position: relative;
  overflow: hidden;
}

nav a::after {
  content: '';
  position: absolute;
  bottom: 0;
  right: 0;
  width: 0;
  height: 2px;
  background-color: #fff;
  transition: width 0.3s ease;
}

nav a:hover::after {
  width: 100%;
  right: auto;
  left: 0;
}

nav a:hover {
  color: #fff;
  background-color: rgba(255,255,255,0.1);
}
    .chat-container {
      display: flex;
      height: 100vh;
    }
    .members {
      width: 30%;
      background-color: #ffffff;
      padding: 20px;
      overflow-y: auto;
      border-left: 2px solid #ddd;
    }
    .chat-box {
      flex: 1;
      display: flex;
      flex-direction: column;
      padding: 20px;
      background-color: #eef1f5;
    }
    .chat-messages {
      flex: 1;
      overflow-y: auto;
      background-color: #fff;
      padding: 20px;
      margin-bottom: 20px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
    .message {
      background-color: #dff3ff;
      padding: 10px;
      margin-bottom: 10px;
      border-radius: 8px;
      max-width: 60%;
    }
    .chat-input {
      display: flex;
      gap: 10px;
    }
    .chat-input input {
      flex: 1;
      padding: 10px;
      border-radius: 6px;
      border: 1px solid #ccc;
      font-size: 14px;
    }
    .chat-input button {
      padding: 10px 20px;
      border: none;
      background-color: #1e4a72;
      color: white;
      border-radius: 6px;
      cursor: pointer;
    }
    .member {
      margin-bottom: 15px;
      padding: 10px;
      border: 1px solid #eee;
      border-radius: 6px;
      background-color: #fafafa;
    }
    .member strong { 
      color: #1e4a72; 
    }
    .member span { 
      display: block; 
      font-size: 13px; 
      color: #666; 
    }
  </style>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

</head>
<body>
    <header>
    <div class="header-content">
      <div class="logo">
        <img src=".//6_image_of_efm-removebg-preview.png" class="img-logo">
      </div>
      <div class="header-text">
        <h1>اتحاد الجمعيات</h1>
        <p>نحو تنمية مستدامة وارتقاء بالعمل الجمعوي</p><br>
      </div>
    </div>
    <nav>
      <a href="index.php" ><i class="fas fa-house"></i> الرئيسية</a>
      <a href="#about" ><i class="fas fa-info-circle"></i> عن الاتحاد</a>
      <a href="#activities" ><i class="fas fa-tasks"></i> الأنشطة</a>
      <a href="#gallery" ><i class="fas fa-images"></i> معرض الصور</a>
      <a href="sign.up.php" ><i class="fas fa-user"></i> إنشاء حساب</a>
    </nav>
  </header>
  <div class="chat-container">

    <!-- list of members-->
    <div class="members">
      <h3>الأعضاء</h3>
      <?php foreach ($membres as $m): ?>
        <div class="member">
          <strong><?= htmlspecialchars($m['NOM']) ?></strong>
          <span><?= afficherType($m['TYPE_MEMBERS']) ?></span>
        </div>
      <?php endforeach; ?>
    </div>

    <!-- chat box-->
    <div class="chat-box">
      <div class="chat-messages">
        <h3>المحادثة</h3>
        <?php if ($message_envoye): ?>
          <div class="message"><?= $message ?></div>
        <?php else: ?>
          <div>لا توجد رسائل بعد.</div>
        <?php endif; ?>
      </div>

      <form method="POST" class="chat-input">
        <input type="text" name="message" placeholder="اكتب رسالتك هنا..." required>
        <button type="submit">إرسال</button>
      </form>
    </div>

  </div>
</body>
</html>
