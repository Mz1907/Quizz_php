<div class="well">
    <form method="post" action="">
        <legend>Remplissez le formulaire pour vous inscrire</legend>
        <input type="hidden" name="form_register_sent" value="1">
        <div class="form-group">
            <label for="pseudo">Votre pseudo (min 4 char et max 18 char)</label>
            <input type="text" name="pseudo" id="pseudo"/>
        </div><br />
        <div class="form-group">
            <label for="password">Mot de passe (min 4 char et max 20 char)</label>
            <input type="text" name="password" id="password" />
        </div><br />
        <div class="form-group">
            Question subsidiaire: Nom de l'établissement ?
            <select name="q1">
                <option value="efcc">EFCC</option>
                <option value="eppf">EPPF</option>
                <option value="epfc">EPFC</option>
                <option value="ergf">ERGF</option>
            </select>
        </div><br />
        <input type="submit" name="submit" id="submit" class="btn btn-primary" />
    </form>
</div>