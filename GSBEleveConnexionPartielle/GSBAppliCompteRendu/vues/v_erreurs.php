<div class ="erreur">
<ul>
<?php
/**
 * ERROR DISPLAY VIEW
 * Shows validation errors and system messages to user
 * Automatically includes appropriate summary based on user role
 * Used by: All controllers when validation fails
 */
?>
<?php 
foreach($_REQUEST['erreurs'] as $erreur)
	{
      echo $erreur;
	}
?>
</ul></div>
