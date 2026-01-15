<section class="panel">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
        <div>
            <h1 style="font-family: 'Fraunces', serif; margin: 0;">Liste des utilisateurs</h1>
            <p style="color: var(--muted); margin: 6px 0 0;">Vue globale des comptes et des rôles actifs.</p>
        </div>
        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a class="btn btn-ghost" href="/users/create">Créer un compte</a>
            <a class="btn btn-ghost" href="/logout">Se déconnecter</a>
        </div>
    </div>

    <div class="table-wrap" style="margin-top: 24px;">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Mot de passe hashé</th>
                    <th>Date de création</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($data['users'] as $user): ?>
                <tr>
                    <td><?= (string) $user['id'] ?></td>
                    <td><?= $user['nom'] ?></td>
                    <td><?= $user['email'] ?></td>
                    <td><?= $user['nom_role'] ?></td>
                    <td><?= $user['password'] ?></td>
                    <td><?= $user['date_creation'] ?></td>
                    <td>
                        <div style="display: flex; gap: 8px; flex-wrap: wrap;">
                            <a class="btn btn-ghost" href="/users/<?= (string) $user['id'] ?>/edit">Modifier</a>
                            <a class="btn btn-ghost" href="/users/delete">Supprimer</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>
