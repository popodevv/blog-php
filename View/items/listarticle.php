<?php include 'View/includes/header.php'; ?>

<p>Here all the article of blog !  </p>

<a href="connexion.php">Me deconnecter</a>

<h5> Add an article to your blog</h5>
<form action="" method="post">
        <p>
        <label for="pseudo"> Our Pseudo</label> : <input type="text" name="pseudo" id="pseudo" /><br />
        <label for="title">Our Title</label> :  <input type="text" name="title" id="title" /><br />
        <label for="content">Our Item</label> :  <input type="text" name="content" id="content" /><br />
        <input type="submit" value="Envoyer" />
	</p>
    </form>

<?php
//tableau qui contient message
foreach (($dal->getAllItems()) as $item) { ?>
   <?php echo $item->getId(); ?> <br> 
   <?php echo $item->getTitle(); ?> <br> 
   <?php echo $item->getContent(); }?> <br> 


<p><a href="<?= $item ?>">Supprimer</a></p>
<p><a href="<?= $item ?>">Modifier</a></p>


<?php include 'View/includes/footer.php'; ?>