<div class="well">
    <form method="post" action="index.php?page=login&action=login">
        <legend>Connection</legend>
        <input type="hidden" name="form_auth_sent" value="1">
        <div class="form-group">
            <label for="pseudo">Votre pseudo</label>
            <input type="text" name="pseudo" id="pseudo" />
        </div><br />
        <div class="form-group">
            <label for="password">Mot de passe</label>
            <input type="text" name="password" id="password" />
        </div><br />
        <input type="submit" name="submit" id="submit" class="btn btn-primary" />
        <?php if (!$userManager::isLogged()) echo '<span><a href="index.php?page=login&action=register"> (S\'inscrire)</a></spans>'; ?>
    </form>
</div>

