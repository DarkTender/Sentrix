<?php
declare(strict_types=1);

session_start();
?>
<!DOCTYPE html>
<html lang="sk">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SENTRIX™ | Cyber Learning Hub</title>
  <meta name="description"
    content="SENTRIX™ – cyber learning hub: writeups, laby, tools a komunita. Linux, Raspberry Pi, wireless, CTF a etické testovanie." />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
  <link href="css/style.css" rel="stylesheet" />
  <link href="css/index.css" rel="stylesheet" />
</head>

<body>
  <canvas id="bg"></canvas>

  <nav class="navbar navbar-expand-lg navbar-futuristic sticky-top mb-2">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php"><i class="fa-solid fa-shield-halved"></i>SENTRIX</a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarFuturistic"
        aria-controls="navbarFuturistic" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarFuturistic">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
          <li class="nav-item"><a class="nav-link active" href="index.php">Domov</a></li>
          <li class="nav-item"><a class="nav-link" href="writeups.php">Writeups</a></li>
          <li class="nav-item"><a class="nav-link" href="roadmap.php">Roadmap</a></li>
          <li class="nav-item"><a class="nav-link" href="tools.php">Tools</a></li>
          <li class="nav-item"><a class="nav-link" href="community.php">Komunita</a></li>
        </ul>

        <div class="d-flex ms-lg-3 mt-3 mt-lg-0 gap-2">
          <a href="login.php" class="btn">Login</a>
        </div>
      </div>
    </div>
  </nav>
