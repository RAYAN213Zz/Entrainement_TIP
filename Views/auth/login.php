<section class="panel" style="max-width: 560px; margin: 0 auto;">
  <h1 style="font-family: 'Fraunces', serif; margin-top: 0;">Connexion</h1>
  <p style="color: var(--muted); margin-top: 4px;">Accède au tableau d’administration de ton projet.</p>

  <?php if (!empty($error)): ?>
    <p style="color: #b42318; background: rgba(180, 35, 24, 0.08); padding: 10px 14px; border-radius: 10px;">
      <?= htmlspecialchars($error) ?>
    </p>
  <?php endif; ?>

  <form method="POST" action="/login" class="form-grid" style="margin-top: 20px;">
    <div>
      <label for="login-email">Email</label>
      <input id="login-email" type="email" name="email" placeholder="nom@exemple.com">
    </div>

    <div>
      <label for="login-password">Mot de passe</label>
      <input id="login-password" type="password" name="password" placeholder="••••••••">
    </div>

    <div style="display: flex; gap: 12px; flex-wrap: wrap;">
      <button type="submit" class="btn btn-primary">Se connecter</button>
      <a class="btn btn-ghost" href="/users/create">Créer un compte</a>
    </div>
  </form>
</section>
