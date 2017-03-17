<article>
    <form method='POST'>
        <h2><input name='titre' value='<?php echo $article->getTitre(); ?>'></h2>
        <p><span class="date"><?php echo $article->getDate()->format('d-m-Y') ?></span> - <span class="auteur"><?php echo $article->getAuteur(); ?></span></p>
        <p><textarea name='contents' rows="20" cols="100" ><?php echo $article->getContents(); ?></textarea></p>
        <?php if ($article->getImage()) : ?>
            <img src="<?php echo \Lib\Application::REP_IMAGE . $article->getImage(); ?>" alt="<?php echo htmlentities($article->getTitre()); ?>" height="200px">
        <?php endif; ?>
    </form>
</article>




