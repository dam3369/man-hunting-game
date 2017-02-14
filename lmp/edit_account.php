<?php require 'lock.php'; ?>

<a href="./method/logout.php">Deconnexion</a>
<h2>Changer de mot de passe de <?php echo $_SESSION['login']; ?></h2>
<form action="method/edit.php" method="post">
	<input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>" />
	<label for="password">mot de passe : </label><input type="password" name="password" value="" />
	<label for="confirm_password">confirmer le mot de passe : </label><input type="password" name="confirm_password" value="" />
	<button type="submit">valider</button>
</form>