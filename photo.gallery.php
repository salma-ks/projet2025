<?php
session_start();
include 'config.php';

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>اتحاد الجمعيات</title>
    <style>
        * {
            box-sizing: border-box;
            padding: 0;
            margin: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #FBFBFB;
            color: #333;
            line-height: 1.6;
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

        .img-logo {
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

        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            background: white;
            min-height: 600px;
        }

        .page-title {
            text-align: center;
            margin-bottom: 30px;
        }

        .page-title h2 {
            font-size: 28px;
            color: #1e4a72;
            margin-bottom: 10px;
        }

        .breadcrumb {
            display: flex;
            justify-content: center;
            gap: 10px;
            color: #666;
            margin-bottom: 40px;
        }

        .breadcrumb span {
            padding: 8px 20px;
            background-color: #f0f0f0;
            border-radius: 20px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
            user-select: none;
        }

        .breadcrumb span:hover {
            background-color: #e0e0e0;
        }

        .breadcrumb .active {
            background-color: #1e4a72;
            color: white;
        }

        .content-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 20px;
            margin-bottom: 40px;
        }

        .content-card {
            background-color: #e0e0e0;
            border-radius: 8px;
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            transition: transform 0.3s ease;
            overflow: hidden;
        }

        .content-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
        }

        .content-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
        }

        .card-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.7));
            color: white;
            padding: 15px;
            transform: translateY(100%);
            transition: transform 0.3s ease;
        }

        .content-card:hover .card-overlay {
            transform: translateY(0);
        }

        .card-title {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .card-date {
            font-size: 12px;
            opacity: 0.8;
        }

        .hidden {
            display: none;
        }
         .addpic{
          background-color:rgb(9, 124, 34);
         padding: 20px 25px;
          text-decoration:none;
          border-radius:10px;
          text-align:center;
          color:white;
          font-weight:bold;
        }

        footer {
            background-color: #034E88;
            color: white;
            text-align: center;
            padding: 30px 0;
            width: 100%;
        }

        .footer-content {
            max-width: 1100px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 0 20px;
        }

        .footer-section {
            flex: 1;
            min-width: 250px;
            margin-bottom: 20px;
        }

        .footer-section h3 {
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-section p {
            margin-bottom: 15px;
        }

        .social-links a {
            display: inline-block;
            color: white;
            margin-left: 10px;
            font-size: 20px;
            transition: transform 0.3s ease;
        }

        .social-links a:hover {
            transform: translateY(-5px);
        }

        .footer-bottom {
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid rgba(255,255,255,0.1);
        }

        @media (max-width: 768px) {
            .header-content {
                flex-direction: column;
                gap: 20px;
            }

            .nav-menu {
                flex-wrap: wrap;
                justify-content: center;
                gap: 15px;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 30px;
            }

            .content-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="header-content">
            <div class="logo">
                <img src="./6_image_of_efm-removebg-preview.png" class="img-logo">
            </div>
            <div class="header-text">
                <h1>اتحاد الجمعيات</h1>
                <p>نحو تنمية مستدامة وارتقاء بالعمل الجمعوي</p><br>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-content">
        <div class="page-title">
            <h2>معرض الصور</h2>
        </div>

        <div class="breadcrumb">
            <span onclick="showCategory('all')" id="tab-all" class="active">الكل</span>
            <span onclick="showCategory('events')" id="tab-events">الفعاليات</span>
            <span onclick="showCategory('projects')" id="tab-projects">المشاريع</span>
        </div>

        <div class="content-grid" id="content-grid">
            <div class="content-card" data-category="all projects">
                <img src="./image1gallery.png">
                <div class="card-overlay">
                    <div class="card-title">تكوينات في التنمية الذاتية والمهارات الحياتية.</div>
                    <div class="card-date">15 مايو 2024</div>
                </div>
            </div>
            <div class="content-card" data-category="all projects">
                <img src="./image2gallery.png">
                <div class="card-overlay">
                    <div class="card-title"> الترويج للتراث الثقافي المحلي.</div>
                    <div class="card-date">10 أبريل 2024</div>
                </div>
            </div>
            <div class="content-card" data-category="all projects">
                <img src="./image3gallery.png">
                <div class="card-overlay">
                    <div class="card-title"> إقامة معارض كتب وفنون تشكيلية.</div>
                    <div class="card-date">25 مارس 2024</div>
                </div>
            </div>
            <div class="content-card" data-category="all events">
                <img src="./image4gallery.png">
                <div class="card-overlay">
                    <div class="card-title">فعالية رياضية حماسية في مباراة كرة قدم.</div>
                    <div class="card-date">5 مارس 2024</div>
                </div>
            </div>
            <div class="content-card" data-category="all events">
                <img src="./image5gallery.jpg">
                <div class="card-overlay">
                    <div class="card-title">فعالية رياضية ممتعة للأطفال باستخدام الأطواق الملونة</div>
                    <div class="card-date">20 فبراير 2024</div>
                </div>
            </div>
            <div class="content-card" data-category="all events">
                <img src="./image6gallery.jpg">
                <div class="card-overlay">
                    <div class="card-title">فعالية استكشافية للأطفال وسط الطبيعة الخلابة.</div>
                    <div class="card-date">1 فبراير 2024</div>
                </div>
            </div>
            <?php
             if (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 2): ?>
            <a href="add.image.html" class="addpic">اضف صورة</a>
            <?php endif; ?>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>عن الاتحاد</h3>
                <p>اتحاد الجمعيات هو مظلة تعاونية تهدف إلى تنسيق الجهود ورفع كفاءتها لخدمة المجتمع.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h3>روابط سريعة</h3>
                <p><a href="#about" style="color: white; text-decoration: none;">عن الاتحاد</a></p>
                <p><a href="#activities" style="color: white; text-decoration: none;">الأنشطة</a></p>
                <p><a href="#gallery" style="color: white; text-decoration: none;">معرض الصور</a></p>
            </div>
            <div class="footer-section">
                <h3>معلومات الاتصال</h3>
                <p>SOLICOD-TANGIER <i class="fas fa-map-marker-alt"></i></p>
                <p>+212 604 1267 02 <i class="fas fa-phone"></i></p>
                <p>susalma881@gmail.com <i class="fas fa-envelope"></i></p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>© 2025 اتحاد الجمعيات . جميع الحقوق محفوظة.</p>
        </div>
    </footer>

    <script>
        function showCategory(category) {
            document.querySelectorAll('.breadcrumb span').forEach(tab => tab.classList.remove('active'));
            document.getElementById('tab-' + category).classList.add('active');
            document.querySelectorAll('.content-card').forEach(card => card.style.display = 'none');
            if (category === 'all') {
                document.querySelectorAll('.content-card').forEach(card => card.style.display = 'flex');
            } else {
                document.querySelectorAll(`.content-card[data-category*="${category}"]`).forEach(card => card.style.display = 'flex');
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            showCategory('all');
        });
    </script>
</body>
</html>
