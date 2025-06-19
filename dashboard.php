<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_name']) || $_SESSION['user_type'] != 2) {
    header("Location: login.php"); 
    exit();
}

$userName = $_SESSION['user_name'];

try {
    $stmt1 = $pdo->query("SELECT COUNT(*) FROM benevole");
    $benevoleCount = $stmt1->fetchColumn();

    $stmt2 = $pdo->query("SELECT COUNT(*) FROM les_membres WHERE TYPE_MEMBERS = 3");
    $membersCount = $stmt2->fetchColumn();

    $stmt3 = $pdo->query("SELECT COUNT(*) FROM les_membres WHERE TYPE_MEMBERS = 2");
    $headsCount = $stmt3->fetchColumn();
} catch (PDOException $e) {
    echo "Erreur: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #F5F6FA;
            color: #333;
            direction: rtl;
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 230px;
            background-color: #153E6C;
            padding: 20px 0;
            color: white;
            box-shadow: 2px 0 8px rgba(0,0,0,0.1);
        }

        .logo {
            text-align: center;
            padding-bottom: 30px;
            border-bottom: 1px solid rgba(255,255,255,0.15);
        }

        .logo img {
            width: 70px;
        }

        .logo-text {
            font-weight: bold;
            margin-top: 10px;
            font-size: 18px;
        }

        .menu-item {
            display: block;
            padding: 15px 30px;
            color: #fff;
            text-decoration: none;
            transition: 0.3s;
            font-size: 15px;
        }

        .menu-item:hover, .menu-item.active {
            background-color: #0D2B50;
        }

        .main-content {
            flex: 1;
            padding: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .page-title {
            font-size: 26px;
            font-weight: bold;
        }

        .user-info {
            font-size: 16px;
            color: #555;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-number {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .stat-label {
            font-size: 14px;
            color: #777;
        }

        .stat-icon {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            color: white;
        }

        .blue {
            background: #2196F3;
        }

        .yellow {
            background: #FFC107;
        }

        .green {
            background: #4CAF50;
        }

        .section {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 25px;
            margin-bottom: 25px;
        }

        .section-title {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
            border-bottom: 2px solid #eee;
            padding-bottom: 10px;
        }

        .activity-item {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #f0f0f0;
            padding: 12px 0;
            font-size: 14px;
        }

        .activity-item:last-child {
            border: none;
        }

#projectForm {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    align-items: center;
    margin-bottom: 20px;
}

#projectForm input[type="text"],
#projectForm input[type="date"] {
    padding: 10px;
    font-size: 14px;
    border: 1px solid #ccc;
    border-radius: 8px;
    flex: 1;
    min-width: 200px;
}

#projectForm button {
    padding: 10px 20px;
    background-color: #153E6C;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.3s;
}

#projectForm button:hover {
    background-color: #0D2B50;
}

#projectsTable {
    width: 100%;
    border-collapse: collapse;
    font-size: 14px;
}

#projectsTable th,
#projectsTable td {
    padding: 12px 15px;
    text-align: center;
    border-bottom: 1px solid #f0f0f0;
}

#projectsTable th {
    background: #F2F2F2;
    font-weight: 600;
}

/* button of edit and delet*/
#projectsTable button {
    margin: 0 5px;
    padding: 6px 12px;
    border: none;
    border-radius: 6px;
    font-size: 13px;
    cursor: pointer;
    transition: 0.3s;
}

#projectsTable button:hover {
    opacity: 0.8;
}

#projectsTable button:first-child {
    background-color: #FFC107;
    color: #333;
}

#projectsTable button:last-child {
    background-color: #F44336;
    color: white;
}

    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div class="container">
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo">
            <img src="./6_image_of_efm-removebg-preview.png">
            <div class="logo-text">اتحاد الجمعيات</div>
        </div>
        <a href="main.php" class="menu-item "><i class="fas fa-house"></i> الرئيسية</a>
        <a href="main.php#about" class="menu-item"><i class="fas fa-info-circle"></i> عن الاتحاد</a>
        <a href="main.php#activities" class="menu-item"><i class="fas fa-tasks"></i> الأنشطة</a>
        <a href="main.php#gallery" class="menu-item"><i class="fas fa-images"></i> معرض الصور</a>
        <a href="chat.php" class="menu-item"><i class="fas fa-comments"></i> الدردشة المباشرة</a>
        <a href="dashboard.php" class="menu-item active"><i class="fas fa-user"></i> حسابي</a>
        <a href="logout.php" class="menu-item"><i class="fas fa-sign-out-alt"></i> تسجيل الخروج</a>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="header">
            <div class="page-title">حسابي</div>
<div class="user-info">مرحباً، <?php echo htmlspecialchars($userName); ?></div>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div>
                    <div class="stat-number"><?php echo $benevoleCount; ?></div>
                    <div class="stat-label">عدد المتطوعين</div>
                </div>
                <div class="stat-icon blue"><i class="fas fa-hands-helping"></i></div>
            </div>
            <div class="stat-card">
                <div>
                    <div class="stat-number"><?php echo $membersCount; ?></div>
                    <div class="stat-label">عدد الأعضاء</div>
                </div>
                <div class="stat-icon yellow"><i class="fas fa-user-friends"></i></div>
            </div>
            <div class="stat-card">
                <div>
                    <div class="stat-number"><?php echo $headsCount; ?></div>
                    <div class="stat-label">عدد الرؤساء</div>
                </div>
                <div class="stat-icon green"><i class="fas fa-user-tie"></i></div>
            </div>
        </div>
 
        <!-- Future Projects -->
<div class="section">
    <div class="section-title">مشاريعي المستقبلية</div>

    <form id="projectForm" onsubmit="addProject(); return false;" style="margin-bottom: 20px;">
        <input type="text" id="projectName" placeholder="اسم المشروع" required style="padding: 8px; width: 40%; margin-left: 10px;">
        <input type="date" id="projectDate" required style="padding: 8px; width: 30%;">
        <button type="submit" style="padding: 8px 15px; background-color: #153E6C; color: white; border: none; border-radius: 5px; margin-right: 10px;">إضافة</button>
    </form>

    <table id="projectsTable">
        <thead>
            <tr><th>اسم المشروع</th><th>تاريخ التنفيذ</th><th>الخيارات</th></tr>
        </thead>
        <tbody>
         
        </tbody>
    </table>
</div>
<script>
    let editIndex = -1;

    function loadProjects() {
        const table = document.getElementById("projectsTable").getElementsByTagName("tbody")[0];
        table.innerHTML = "";

        const projects = JSON.parse(localStorage.getItem("futureProjects") || "[]");

        projects.forEach((project, index) => {
            const newRow = table.insertRow();
            newRow.insertCell(0).innerText = project.name;
            newRow.insertCell(1).innerText = project.date;
            const optionsCell = newRow.insertCell(2);
            optionsCell.innerHTML = `
                <button onclick="editProject(${index})">تعديل</button>
                <button onclick="deleteProject(${index})">حذف</button>
            `;
        });
    }

    function saveProjects(projects) {
        localStorage.setItem("futureProjects", JSON.stringify(projects));
    }

    function addProject() {
        const name = document.getElementById("projectName").value;
        const date = document.getElementById("projectDate").value;

        let projects = JSON.parse(localStorage.getItem("futureProjects") || "[]");

        if (editIndex === -1) {
            projects.push({ name, date });
        } else {
            projects[editIndex] = { name, date };
            editIndex = -1;
        }

        saveProjects(projects);
        loadProjects();
        document.getElementById("projectForm").reset();
    }

    function editProject(index) {
        const projects = JSON.parse(localStorage.getItem("futureProjects") || "[]");
        document.getElementById("projectName").value = projects[index].name;
        document.getElementById("projectDate").value = projects[index].date;
        editIndex = index;
    }

    function deleteProject(index) {
        let projects = JSON.parse(localStorage.getItem("futureProjects") || "[]");
        projects.splice(index, 1);
        saveProjects(projects);
        loadProjects();
        editIndex = -1;
    }
    window.onload = loadProjects;
</script>

</body>
</html>
