<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
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

/* Slider Section */
.slider {
  position: relative;
  height: 400px;
  overflow: hidden;
  margin-bottom: 30px;
}

.slide {
  position: absolute;
  top: 0;
  right: 0;
  width: 100%;
  height: 100%;
  opacity: 0;
  transition: opacity 1.5s ease-in-out;
  background-size: cover;
  background-position: center;
  display: flex;
  align-items: center;
  justify-content: center;
}

.slide.active {
  opacity: 1;
}

.slide-content {
  background-color: rgba(0, 0, 0, 0.6);
  color: white;
  padding: 30px;
  border-radius: 10px;
  max-width: 600px;
  text-align: center;
  transform: translateY(50px);
  opacity: 0;
  transition: all 1s ease 0.5s;
}

.slide.active .slide-content {
  transform: translateY(0);
  opacity: 1;
}

.slide-btn {
  display: inline-block;
  margin-top: 20px;
  padding: 12px 30px;
  background-color: #034E88;
  color: white;
  text-decoration: none;
  border-radius: 5px;
  font-weight: bold;
  transition: all 0.3s ease;
  position: relative;
  overflow: hidden;
  border: none;
  cursor: pointer;
  box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

.slide-btn:hover {
  background-color: #034E88;
  transform: translateY(-3px);
  box-shadow: 0 8px 20px rgba(0,0,0,0.3);
}

.slide-btn:active {
  transform: translateY(1px);
}

.slide-btn::after {
  content: '';
  position: absolute;
  top: 50%;
  right: 50%;
  width: 5px;
  height: 5px;
  background: rgba(255, 255, 255, 0.5);
  opacity: 0;
  border-radius: 100%;
  transform: scale(1, 1) translate(-50%);
  transform-origin: 50% 50%;
}

.slide-btn:focus:not(:active)::after {
  animation: ripple 1s ease-out;
}

@keyframes ripple {
  0% {
    transform: scale(0, 0);
    opacity: 0.5;
  }
  100% {
    transform: scale(20, 20);
    opacity: 0;
  }
}

.container {
  max-width: 1100px;
  margin: 30px auto;
  padding: 0 20px;
}

.box {
  background-color: #ffffff;
  border-radius: 10px;
  padding: 25px;
  margin-bottom: 25px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.box:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
}

.section-title {
  font-size: 24px;
  color: #034E88;
  margin-bottom: 15px;
  position: relative;
  padding-right: 15px;
}

.section-title::after {
  content: "";
  position: absolute;
  right: 0;
  bottom: -5px;
  width: 50px;
  height: 3px;
  background-color: #4EA54E;
  transition: width 0.3s ease;
}

.box:hover .section-title::after {
  width: 80px;
}

.activity {
  display: flex;
  gap: 15px;
  align-items: center;
  padding: 15px 0;
  border-bottom: 1px solid #ddd;
  transition: background-color 0.3s ease;
}

.activity:hover {
  background-color: rgba(95, 153, 174, 0.05);
}

.activity:last-child {
  border-bottom: none;
}

.image-placeholder {
  width: 100px;
  height: 100px;
  background-color: #e0e0e0;
  border-radius: 8px;
  flex-shrink: 0;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #757575;
  font-size: 14px;
  overflow: hidden;
  transition: transform 0.3s ease;
}

.activity:hover .image-placeholder {
  transform: scale(1.05);
}

    /* Gallery Section */
    .gallery {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 20px;
      margin-top: 30px;
    }

    .gallery-item {
      position: relative;
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
      transition: all 0.3s ease;
      height: 250px;
    }

    .gallery-item:hover {
      transform: translateY(-5px);
      box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }

    .gallery-img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      transition: transform 0.5s ease;
    }

    .gallery-item:hover .gallery-img {
      transform: scale(1.05);
    }

    .gallery-caption {
      position: absolute;
      bottom: 0;
      right: 0;
      left: 0;
      background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
      color: white;
      padding: 20px;
      text-align: right;
      opacity: 0;
      transition: opacity 0.3s ease;
    }

    .gallery-item:hover .gallery-caption {
      opacity: 1;
    }

    .gallery-caption h3 {
      margin-bottom: 5px;
      font-size: 18px;
    }

    .gallery-caption p {
      margin: 0;
      font-size: 14px;
      color: rgba(255,255,255,0.8);
    }

/* 3D Button Style */
.btn-3d {
  position: relative;
  display: inline-block;
  padding: 12px 30px;
  color: white;
  margin: 20px 10px;
  border-radius: 6px;
  text-align: center;
  transition: top .01s linear;
  text-shadow: 0 1px 0 rgba(0,0,0,0.15);
  background-color: #034E88;
  box-shadow: 0 0 0 1px #034E88 inset,
              0 0 0 2px rgba(255,255,255,0.15) inset,
              0 5px 0 0 #023053,
              0 5px 0 1px rgba(0,0,0,0.4),
              0 5px 8px 1px rgba(0,0,0,0.5);
}

.btn-3d:active {
  top: 5px;
  box-shadow: 0 0 0 1px #034E88 inset,
              0 0 0 2px rgba(255,255,255,0.15) inset,
              0 0 0 1px rgba(0,0,0,0.4);
}

/* Stats Section */
.stat-1{
  width: 210px;
  height: 210px;
  background-color: #034E88;
  border-radius: 100%;
  position: relative;
}
.stats-container{
  display: flex;
  gap: 100px; 
  position: relative;
  top: -15px;
}
.stat-number{
  color: white;
  font-weight: bold;
  font-size: 48px;
  position: absolute;
  left: 40px;
  top: 50px;
  cursor:default;
  
}
.stat-number:hover{
  color: white;
  font-weight: bold;
  font-size: 55px;
  position: absolute;
  left: 30px;
  top: 50px;
  color:rgb(255, 224, 19);
  cursor:default;
  
}
.stat-label{
  color: white;
  font-weight: bold;
  position: absolute;
  left: 70px;
  top: 130px;
  cursor:default;
}
/*Gallery*/
.gallery{
  display: flex;
  justify-content: center;
  gap: 1rem;
  width: 53rem;
}
.card{
  position: relative;
  left: 0;
  width: 3rem;
  border-radius: 5rem;
  height: 20rem;
  overflow: hidden;
  transition: .4s ease-in-out;
  box-shadow: 0 5 12px black(0, 0, 0, .3);
  flex: .15;
}
.card img{
  position: relative;
  height: 20rem;
  object-fit: cover;
}
.card:hover{
  flex: 1 1 0;
  font-weight: bold;
  border-radius: 1rem;
}

/* Testimonials Section */
.testimonials {
  background-color: #f4f7fa;
  padding: 40px 0;
  margin: 40px 0;
}

.testimonial-container {
  max-width: 1400px;
  margin: 0 auto;
}

.testimonial {
  background-color: white;
  padding: 30px;
  border-radius: 10px;
  box-shadow: 0 5px 15px rgba(0,0,0,0.05);
  margin-bottom: 30px;
  position: relative;
}

.testimonial::before {
  content: '\201C';
  font-size: 80px;
  color: rgba(95, 153, 174, 0.2);
  position: absolute;
  top: 10px;
  right: 20px;
  line-height: 1;
}

.testimonial-content {
  margin-bottom: 20px;
  font-style: italic;
  position: relative;
  z-index: 1;
}

.testimonial-author {
  display: flex;
  align-items: center;
}

.testimonial-author img {
  width: 50px;
  height: 50px;
  border-radius: 50%;
  margin-left: 15px;
  object-fit: cover;
}

.author-info h4 {
  margin: 0;
  color: #034E88;
}

.author-info p {
  margin: 5px 0 0;
  font-size: 14px;
  color: #666;
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

@media screen and (max-width: 768px) {
  .gallery {
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
  }
  
  nav {
    flex-wrap: wrap;
    gap: 10px;
  }
  
  .header-content {
    flex-direction: column;
    text-align: center;
  }
  
  .header-text {
    text-align: center;
  }
  .hero-slider {
    height: 300px;
  }
  
  .slide-content {
    padding: 15px;
    margin: 0 15px;
  }
  .stats-container {
    flex-direction: column;
  }
}


.people-container {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 140px;
}

.person-container {
  display: flex;
  align-items: center;
  position: relative;
  background-color: white;
  border-radius: 15px;
  padding: 15px;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  transition: all 0.3s ease;
  max-width: 400px;
  overflow: visible;
}

.person-container:hover {
  transform: translateY(-5px);
  box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.person-image-container {
  position: relative;
  margin-left: 15px;
}

.person-image {
  width: 80px;
  height: 80px;
  border-radius: 50%;
  object-fit: cover;
  border: 3px solid #4a6fa5;
  transition: all 0.3s ease;
}

.person-container:hover .person-image {
  transform: scale(1.1);
}

.person-info {
  flex-grow: 1;
}

.person-name {
  font-weight: 700;
  color: #2c3e50;
  margin-bottom: 5px;
  font-size: 18px;
}

.person-title {
  color: #7f8c8d;
  font-size: 14px;
  margin-bottom: 10px;
}

.person-comment {
  position: absolute;
  right: 100%;
  top: 50%;
  transform: translateY(-50%);
  background-color: #4a6fa5;
  color: white;
  padding: 12px 15px;
  border-radius: 10px;
  width: 220px;
  opacity: 0;
  visibility: hidden;
  margin-right: 15px;
  font-size: 14px;
  line-height: 1.6;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.2);
  transition: opacity 0.3s ease, visibility 0.3s ease;
  z-index: 1;
}

.person-container:hover .person-comment {
  animation: slideInRight 0.5s forwards;
  opacity: 1;
  visibility: visible;
}

.person-comment:after {
  content: "";
  position: absolute;
  top: 50%;
  left: 100%;
  transform: translateY(-50%);
  border-width: 8px;
  border-style: solid;
  border-color: transparent transparent transparent #4a6fa5;
}

@keyframes slideInRight {
  from {
    transform: translate(50%, -50%);
    opacity: 0;
  }
  to {
    transform: translateY(-50%);
    opacity: 1;
  }
}
  </style>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
  <!-- Header and navigation -->
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
      <a href="main.php" ><i class="fas fa-house"></i> الرئيسية</a>
      <a href="#about" ><i class="fas fa-info-circle"></i> عن الاتحاد</a>
      <a href="#activities" ><i class="fas fa-tasks"></i> الأنشطة</a>
      <a href="#gallery" ><i class="fas fa-images"></i> معرض الصور</a>
      <a href="chat.php" ><i class="fas fa-comments"></i> الدردشة المباشرة</a>
      <a href="dashboard.php" ><i class="fas fa-user"></i>   حسابي   </a>
    </nav>
  </header>
  <!-- Slider -->
  <div class="slider">
    <div class="slide active" style="background-image: url('./first\ image\ of\ efm\ edit.png');">
      <div class="slide-content">
        <h2>تعاوننا يصنع الفرق</h2>
        <p>نعمل معًا لتحقيق أهداف إنسانية نبيلة وخدمة المجتمع</p>
        <a href="#activities" class="slide-btn">اكتشف أنشطتنا</a>
      </div>
    </div>
    <div class="slide" style="background-image: url('./second image edit.jpg');">
      <div class="slide-content">
        <h2>تضامن يبني المستقبل</h2>
        <p>شراكات استراتيجية بين الجمعيات لتحقيق التنمية المستدامة</p>
        <a href="#contact" class="slide-btn">انضم إلينا</a>
      </div>
    </div>
    <div class="slide" style="background-image: url('./third image edit.jpg');">
      <div class="slide-content">
        <h2>إنجازات تستحق الفخر</h2>
        <p>أكثر من 100 مشروع  تم تنفيذه بالتعاون بين أعضاء الاتحاد</p>
        <a href="#gallery" class="slide-btn btn-3d btn-3d-green">شاهد إنجازاتنا</a>
      </div>
    </div>
  </div>
  <div class="container">
    <!-- About Section -->
    <div class="box" id="about">
      <h2 class="section-title">عن الاتحاد</h2>
      <p>"اتحاد الجمعيات" هو منصة إلكترونية تهدف إلى تنظيم وتنسيق عمل مجموعة من الجمعيات المدنية غير الخيرية، التي تشتغل في مجالات تنموية واجتماعية متنوعة.
</p>
      <p>يوفر الموقع فضاءً موحدًا لعرض أنشطة ومشاريع الجمعيات، مع فتح المجال أمام المتبرعين – سواء كانوا أفرادًا أو مؤسسات – لدعم هذه المشاريع والمبادرات بما يعزز التنمية المجتمعية المستدامة.

</p>
      <div style="text-align: center; margin-top: 20px;">
        <a href="about.html" class="btn-3d">المزيد عنا</a>
      </div>
    </div>
    <!-- Stats Section -->
    <div class="stats-section">
        <div class="stats-container">
          <div class="stat-1">
            <div class="stat-number" data-target="5000">0</div>
            <div class="stat-label"> عضو جمعية</div>
          </div>
          <div class="stat-1">
            <div class="stat-number" data-target="1500">0</div>
            <div class="stat-label">مشروع</div>
          </div>
          <div class="stat-1">
            <div class="stat-number" data-target="2700">0</div>
            <div class="stat-label">متطوع</div>
          </div>
          <div class="stat-1">
            <div class="stat-number" data-target="5000">0</div>
            <div class="stat-label">مستفيد</div>
          </div>
        </div>
      </div>      
      
      <!-- Activities Section -->
      <div class="box" id="activities">
        <h2 class="section-title">الأنشطة</h2>
        <div class="gallery">
          <figure class="card">
            <img src="./first act.png" alt="img1">
          </figure>
          <figure class="card">
            <img src="./2.png" alt="img2">
          </figure>
          <figure class="card">
            <img src="./third act.png" alt="img3">
          </figure>
          <figure class="card">
            <img src="./four act.png" alt="img4">
          </figure>
        </div>
      </div>
      <!-- Gallery Section -->
      <div class="box" id="gallery">
      <h2 class="section-title">معرض الصور</h2>
      <p>بعض اللحظات المميزة من مشاريع وفعاليات اتحاد الجمعيات</p>
      
      <div class="gallery">
        <div class="gallery-item">
          <img src="./image1gallery.png" class="gallery-img">
          <div class="gallery-caption">
            <h3>تنمية ذاتية</h3>
            <p>تكوينات في التنمية الذاتية والمهارات الحياتية.</p>
          </div>
        </div>
        
        <div class="gallery-item">
          <img src="./image2gallery.png"  class="gallery-img">
          <div class="gallery-caption">
            <h3>تبادل ثقافي</h3>
            <p>فعاليات تروّج للتراث الثقافي المحلي.</p>
          </div>
        </div>
        
        <div class="gallery-item">
          <img src="./image3gallery.png" class="gallery-img">
          <div class="gallery-caption">
           <h3>معرض فني</h3>
           <p> إقامة معارض كتب وفنون تشكيلية.</p>
          </div>
        </div>
        
        <div class="gallery-item">
          <img src="./image4gallery.png"  class="gallery-img">
          <div class="gallery-caption">
            <h3>دوري رياضي</h3>
            <p>تنظيم دوريات كرة قدم أو ألعاب رياضية أخرى.</p>
          </div>
        </div>
      </div>
      <div style="text-align: center; margin-top: 20px;">
        <a href="photo.gallery.php" class="btn-3d">المزيد </a>
      </div>
    </div>
  </div>
    <!-- Testimonials Section -->

    <div class="testimonials">

  <div class="people-container">

    <div class="person-container">
      <div class="person-image-container">
        <img src="./profil3.png" class="person-image">
        <div class="person-comment">
        كلماتكم تعكس رؤيةً ملهمةً وقوة العمل الجماعي! بالفعل، الاتحاد والتنسيق هما سرّ تحويل الأحلام إلى إنجازات ملموسة. جمعية الأمل تحت قيادتكم أصبحت نموذجاً للعطاء والتأثير الإيجابي.        </div>
      </div>
      <div class="person-info">
        <div class="person-name">أحمد محمد</div>
        <div class="person-title">جمعية الغد المشرق</div>
      </div>
    </div>

    <div class="person-container">
      <div class="person-image-container">
        <img src="./profil2.png" class="person-image">
        <div class="person-comment">
        من خلال الاتحاد، استطعنا تبادل الخبرات وتجنب تكرار الجهود. هذا التعاون وفر وقتنا ومواردنا
 ومكننا من خدمة المجتمع بشكل أكثر فعالية.                                                                   
        </div>
      </div>
      <div class="person-info">
        <div class="person-name">سارة عبدالله</div>
        <div class="person-title">رئيسة جمعية النور </div>
      </div>
    </div>

    <div class="person-container">
      <div class="person-image-container">
        <img src="./profile1.png"  class="person-image">
        <div class="person-comment">
        التعاون من خلال اتحاد الجمعيات  مكننا من تنفيذ مشاريع كنا نحلم بها منذ سنوات.
 القوة في الاتحاد والتنسيق جعل أحلامنا واقعاً ملموساً.                                                  
        </div>
      </div>
      <div class="person-info">
        <div class="person-name">خالد سعيد</div>
        <div class="person-title">رئيس جمعية الأمل  </div>
      </div>
    </div>

  </div>

</body>
</html>

              </div>
                        <!-- Footer -->

                        <footer>
                            <div class="footer-content">
                              <div class="footer-section">
                                <h3>عن الاتحاد</h3>
                                <p>اتحاد الجمعيات  هو مظلة تعاونية تهدف إلى تنسيق الجهود  ورفع كفاءتها لخدمة المجتمع.</p>
                                <div class="social-links">
                                  <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                                  <a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i></a>
                                  <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                                  <a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i></a>
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
                                <p> SOLICOD-TANGIER  <i class="fas fa-map-marker-alt"></i></p>
                                <p>02 1267 604 212+<i class="fas fa-phone"></i></p>
                                <p> susalma881@gmail.com <i class="fas fa-envelope"></i></p>
                              </div>
                            </div>
                            <div class="footer-bottom">
                              <p>© 2025 اتحاد الجمعيات . جميع الحقوق محفوظة.</p>
                            </div>
                          </footer>
                         <script>
                  // Hero Slider Animation

  let currentSlide = 0;
  const slides = document.querySelectorAll('.slide');
  
  function showSlide(n) {
    slides[currentSlide].classList.remove('active');
    currentSlide = (n + slides.length) % slides.length;
    slides[currentSlide].classList.add('active');
  }
  
  function nextSlide() {
    showSlide(currentSlide + 1);
  }
    // Auto slide change every 5 seconds

    setInterval(nextSlide, 5000);
    const counters = document.querySelectorAll('.stat-number');
    let counted = false;
  
    function isInView(el) {
      const rect = el.getBoundingClientRect();
      return rect.top <= window.innerHeight && rect.bottom >= 0;
    }
  
    function startCounting() {
      if (counted) return;
  
      const section = document.querySelector('.stats-section');
      if (isInView(section)) {
        counters.forEach(counter => {
          const target = parseInt(counter.getAttribute('data-target'));
          let count = 0;
          const step = Math.ceil(target / 100); 
  
          const update = setInterval(() => {
            count += step;
            if (count >= target) {
              counter.textContent = target.toLocaleString() + "";
              clearInterval(update);
            } else {
              counter.textContent = count.toLocaleString();
            }
          }, 20);
        });
  
        counted = true;
      }
    }
  
    window.addEventListener('scroll', startCounting);
  </script>
  
</body>
</html>