<section class="panel">
    <h1 style="font-family: 'Fraunces', serif; margin-top: 0;">Créer un utilisateur</h1>
    <p style="color: var(--muted); margin-top: 4px;">Ajoute un membre avec son rôle pour l’accès aux pages.</p>

    <form method="POST" action="/users/store" enctype="application/x-www-form-urlencoded" class="form-grid" style="margin-top: 24px;">
        <div>
            <label for="nom">Nom</label>
            <input id="nom" type="text" name="nom" placeholder="Nom complet">
        </div>

        <div>
            <label for="email">Email</label>
            <input id="email" type="email" name="email" placeholder="nom@exemple.com">
        </div>

        <div>
            <label for="password">Mot de passe</label>
            <input id="password" type="password" name="password" placeholder="••••••••">
        </div>

        <div>
            <label for="role_id">Rôle</label>
            <select id="role_id" name="role_id">
                <option value="1">Admin</option>
                <option value="2">Modérateur</option>
                <option value="3">User</option>
            </select>
        </div>

        <div style="display: flex; gap: 12px; flex-wrap: wrap;">
            <button type="submit" class="btn btn-primary">Créer l’utilisateur</button>
            <a class="btn btn-ghost" href="/users">Retour aux utilisateurs</a>
        </div>
    </form>
</section>
