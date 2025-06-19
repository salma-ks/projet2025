<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accordion Cards</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: #f0f0f0;
      font-family: Arial, sans-serif;
    }
    .container {
      height: 400px;
      display: flex;
      flex-wrap: nowrap;
      justify-content: start;
    }
    input {
      display: none;
    }
    .card {
      width: 80px;
      border-radius: 2rem;
      background-size: cover;
      background-position: center;
      cursor: pointer;
      overflow: hidden;
      margin: 0 10px;
      display: flex;
      align-items: flex-end;
      transition: 0.6s cubic-bezier(.28,-0.03,0,.99);
      box-shadow: 0px 10px 30px -5px rgba(0,0,0,0.8);
    }
    .card .row {
      color: white;
      display: flex;
      flex-wrap: nowrap;
    }
    .card .icon {
      background: #223;
      color: white;
      border-radius: 50%;
      width: 50px;
      height: 50px;
      display: flex;
      justify-content: center;
      align-items: center;
      margin: 15px;
    }
    .card .description {
      display: flex;
      justify-content: center;
      flex-direction: column;
      overflow: hidden;
      height: 80px;
      width: 520px;
      opacity: 0;
      transform: translateY(30px);
      transition: all 0.3s ease;
    }
    .description p {
      color: #b0b0ba;
      padding-top: 5px;
    }
    .description h4 {
      text-transform: uppercase;
    }
    /* When checked, open */
    #c1:checked ~ .container label[for="c1"],
    #c2:checked ~ .container label[for="c2"],
    #c3:checked ~ .container label[for="c3"],
    #c4:checked ~ .container label[for="c4"] {
      width: 600px;
    }
    #c1:checked ~ .container label[for="c1"] .description,
    #c2:checked ~ .container label[for="c2"] .description,
    #c3:checked ~ .container label[for="c3"] .description,
    #c4:checked ~ .container label[for="c4"] .description {
      opacity: 1;
      transform: translateY(0);
      transition-delay: .3s;
    }
    /* Image backgrounds */
    label[for="c1"] {
      background-image: url('./first act.png');
    }
    label[for="c2"] {
      background-image: url('./2.png');
    }
    label[for="c3"] {
      background-image: url('./third act.png');
    }
    label[for="c4"] {
      background-image: url('./four act.png');
    }
  </style>
</head>
<body>
  <!-- Radio inputs -->
  <input type="radio" name="slider" id="c1">
  <input type="radio" name="slider" id="c2">
  <input type="radio" name="slider" id="c3">
  <input type="radio" name="slider" id="c4">

  <div class="container">
    <label for="c1" class="card">
      <div class="row">
        <div class="icon">1</div>
        <div class="description">
          <h4>First</h4>
          <p>Some description here.</p>
        </div>
      </div>
    </label>

    <label for="c2" class="card">
      <div class="row">
        <div class="icon">2</div>
        <div class="description">
          <h4>Second</h4>
          <p>Some description here.</p>
        </div>
      </div>
    </label>

    <label for="c3" class="card">
      <div class="row">
        <div class="icon">3</div>
        <div class="description">
          <h4>Third</h4>
          <p>Some description here.</p>
        </div>
      </div>
    </label>

    <label for="c4" class="card">
      <div class="row">
        <div class="icon">4</div>
        <div class="description">
          <h4>Fourth</h4>
          <p>Some description here.</p>
        </div>
      </div>
    </label>
  </div>
</body>
</html>
