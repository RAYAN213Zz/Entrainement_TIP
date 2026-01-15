<?php
$pageTitle = $pagetitle ?? $title ?? 'ProjetTPI';
$user = $_SESSION['user'] ?? null;
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@300;600;700&family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="orb one"></div>
  <div class="orb two"></div>

  <header class="site-nav">
    <div class="nav-inner">
      <a class="brand" href="/">ProjetTPI</a>
      <nav class="nav-links">
        <a href="/">Accueil</a>
        <a href="/users">Utilisateurs</a>
        <a href="/users/create">Creer un compte</a>
      </nav>
      <div class="nav-actions">
        <?php if ($user): ?>
          <span class="pill"><?= $user['nom'] ?> · <?=$user['role'] ?></span>
          <a class="btn btn-ghost" href="/logout">Se deconnecter</a>
        <?php else: ?>
          <a class="btn btn-ghost" href="/login">Se connecter</a>
        <?php endif; ?>
      </div>
    </div>
  </header>

  <main class="page">
    <?= $content ?>
  </main>

  <footer class="footer">
    © 2026 ProjetTPI · Rayan Argoubi
  </footer>
</body>

</html>
