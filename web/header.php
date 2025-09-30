<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>PHP CRUD using OOP & MySQLi</title>


  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="web/css/style.css" rel="stylesheet" />
</head>
<body class="bg-dark text-white">

<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand fw-bold" href="index.php">PHP CRUD</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav"
            aria-controls="nav" aria-expanded="false" aria-label="Toggle">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div id="nav" class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a class="nav-link" href="index.php">Students</a></li>
        <li class="nav-item"><a class="nav-link" href="index.php?action=attendance">Attendance</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container my-4">
  <?php require_once __DIR__ . '/footer.php'; ?>