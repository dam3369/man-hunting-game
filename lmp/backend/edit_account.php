<?php require './../lock.php'; ?>
<h2>Changer de mot de passe :</h2>
<form action="method/edit.php" method="post">
	<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
	<label for="password">mot de passe : </label><input type="password" name="password" value="" />
	<label for="confirm_password">confirmer le mot de passe : </label><input type="password" name="confirm_password" value="" />
	<button type="submit" name="submit">valider</button>
</form>