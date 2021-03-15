<?php include 'View/includes/header.php'; ?>


<p>Welcome to the blog's forum ! </p>

<a href="connexion.php">Me deconnecter</a>

<h5> Add new message on the forum</h5>
<form action="" method="post">
        <p>
        <label for="pseudo">Our Pseudo</label> : <input type="text" name="pseudo" id="pseudo" /><br />
        <label for="message"> Our Message</label> :  <input type="text" name="message" id="message" /><br />

        <input type="submit" value="Envoyer" />
	</p>
    </form>

<?php
//tableau qui contient message
foreach (($dal->getAllMessage()) as $message) { ?>
   <?php echo $message->getId(); ?> <br> 
   <?php echo $message->getPseudo(); ?> <br> 
   <?php echo $message->getMessage(); }?> <br> 





<?php include 'View/includes/footer.php'; ?>