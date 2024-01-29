<!DOCTYPE html>
<?php session_start(); ?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TeleMancs</title>
  <link rel="stylesheet" href="../components/header/header.css">
  <link rel="stylesheet" href="../components/footer/footer.css">
  <link rel="stylesheet" href="../css/index.css">


  <style>
    .content {
      flex: 1;
    }

    #indexContainer {
      display: flex;
      height: 80vh;
    }

    #indexTextContainer {
      width: 50%;
      padding: 7rem;
      color: #1d1d1d;
    }

    #indexImageContainer {
      width: 50%;
      padding: 4rem;
      display: flex;
      align-items: center;
    }

    #indexTextContainer h1 {
      font-size: 7rem;
    }
    
    #indexTextContainer h2 {
      font-size: 3rem;
      margin-bottom: 2rem;
    }

    #indexTextContainer p {
      font-size: 1.5rem;
    }

    #indexButton {
      margin-top: 2rem;
      padding: 1rem;
      background-color: #1B80F1;
      border-radius: 10px;
      cursor: pointer;
      transition: 0.2s ease;
      border: none;
    }

    #indexButton:hover {
      background-color: #0059B2;
    }

    #indexButton {
      font-size: 1.5rem;
      color: white;
      text-decoration: none;
    }

    #indexPic {
      width: 100%;
    }
  </style>
</head>

<body>
  <?php include_once "../components/header/header.php"; ?>

  <div class="content">
    <div id="indexContainer">
      <div id="indexTextContainer">

          <h1>TeleMancs</h1>
          <h2>Együtt az állatokért!</h2>

          <p>Te is szeretnél örökbefogadni egy állatot?</p>

          
            <a href="http://localhost/szakdolgozat/TeleMancs/pages/kereses">
            <button id="indexButton">Itt megteheted!</button>
          </a>
          
 
      </div>
      <div id="indexImageContainer">
        <img id="indexPic" src="http://localhost/szakdolgozat/TeleMancs/images/Index_Pic.png" alt="">
      </div>
    </div>
  </div>

  


    <?php include_once "../components/footer/footer.php"; ?>
</body>

</html>