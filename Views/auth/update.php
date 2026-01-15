
<section class="panel">
    <h1 style="font-family: 'Fraunces', serif; margin-top: 0;">Modifier un utilisateur</h1>
    <p style="color: var(--muted); margin-top: 4px;">Mets a jour les informations du compte.</p>

    <?php $userId = (string) ($user['id'] ?? ''); ?>
    <form method="POST" action="/users/<?= htmlspecialchars($userId) ?>/update" enctype="application/x-www-form-urlencoded" class="form-grid" style="margin-top: 24px;">
        <div>
            <label for="nom">Nom</label>
            <input id="nom" type="text" name="nom" placeholder="Nom complet" value="<?= htmlspecialchars($user['nom'] ?? '') ?>">
        </div>

        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" placeholder="nom@exemple.com" value="<?= htmlspecialchars($user['email'] ?? '') ?>">
        </div>

        <div>
            <label for="password">Mot de passe</label>
            <input id="password" type="password" name="password" placeholder="Laisser vide pour ne pas changer">
        </div>

        <div>
            <label for="role_id">Role</label>
            <select id="role_id" name="role_id">
                <option value="1" <?= ((string) ($user['role_id'] ?? '') === '1') ? 'selected' : '' ?>>Admin</option>
                <option value="2" <?= ((string) ($user['role_id'] ?? '') === '2') ? 'selected' : '' ?>>Moderateur</option>
                <option value="3" <?= ((string) ($user['role_id'] ?? '') === '3') ? 'selected' : '' ?>>User</option>
            </select>
        </div>

        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
            <a class="btn btn-ghost" href="/users">Retour aux utilisateurs</a>
        </div>
    </form>
</section>
