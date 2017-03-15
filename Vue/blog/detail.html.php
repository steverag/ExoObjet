<article>
    <h2><?php echo $article->getTitre(); ?></h2>
    <p><span class="date"><?php echo $article->getDate()->format('d-m-Y') ?></span> - <span class="auteur"><?php echo $article->getAuteur(); ?></span></p>
    <p><?php echo $article->getContents(); ?></p>
    <?php if ($article->getImage()) : ?>
        <img src="<?php echo \Lib\Application::REP_IMAGE . $article->getImage(); ?>" alt="<?php echo htmlentities($article->getTitre()); ?>" height="200px">
    <?php endif; ?>
</article>


