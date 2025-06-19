<?php
session_start();
require 'config.php';

// نفترض أن لديك جدول للجمعيات
try {
    $stmt = $pdo->prepare("SELECT ID_ASSOCIATION, NOM FROM les_associations");
    $stmt->execute();
    $associations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "خطأ في جلب الجمعيات: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>اختيار الجمعية</title>
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body {
      font-family: 'Tahoma', 'Arial', sans-serif;
      direction: rtl;
      background: linear-gradient(135deg, rgb(2, 18, 32), rgb(12, 54, 122));
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }
    .container {
      background: white;
      border-radius: 15px;
      padding: 40px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 600px;
      text-align: center;
    }
    h1 {
      color: #1e4a72;
      margin-bottom: 30px;
    }
    select, input[type="text"] {
      width: 100%;
      padding: 15px;
      margin-bottom: 20px;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      font-size: 16px;
      background-color: #f8f9fa;
    }
    .submit-btn {
      width: 100%;
      padding: 15px;
      background: linear-gradient(135deg, #1e4a72, #2d5aa0);
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 18px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    .submit-btn:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(30, 74, 114, 0.3);
    }
    #newAssociationDiv { display: none; }
  </style>
</head>
<body>

<div class="container">
  <h1>اختر الجمعية التي تنتمي إليها</h1>
  
  <form method="POST" action="save_association.php">
    <select id="associationSelect" name="association">
      <option value="">-- اختر الجمعية --</option>
      <?php foreach ($associations as $assoc): ?>
        <option value="<?= $assoc['ID_ASSOCIATION'] ?>"><?= htmlspecialchars($assoc['NOM']) ?></option>
      <?php endforeach; ?>
      <option value="not_found">الجمعية غير موجودة</option>
    </select>

    <div id="newAssociationDiv">
      <input type="text" name="new_association" placeholder="أدخل اسم الجمعية الجديدة">
    </div>

    <button type="submit" class="submit-btn">متابعة</button>
  </form>
</div>

<script>
  const associationSelect = document.getElementById('associationSelect');
  const newAssociationDiv = document.getElementById('newAssociationDiv');

  associationSelect.addEventListener('change', function() {
    if (this.value === 'not_found') {
      newAssociationDiv.style.display = 'block';
    } else {
      newAssociationDiv.style.display = 'none';
    }
  });
</script>

</body>
</html>
