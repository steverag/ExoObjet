<?php
foreach ($data as $article) :
    ?>

    <article class="block">
        <h2><a href="<?php echo \Lib\Application::ROOT; ?>blog/detail/<?php echo $article->getSlug() . '-' . $article->getId() ?>"><?php echo $article->getTitre(); ?></a></h2>
        <span class="date"><?php echo $article->getDate()->format('d-m-Y') ?></span> <span class="auteur">- <?php echo $article->getAuteur(); ?></span>
        <p style="text-align: justify;"><?php echo $article->extractText($article->getContents()); ?></p>
        <p><?php if ($article->getImage()) : ?>
                <img src="<?php echo \Lib\Application::REP_IMAGE . $article->getImage(); ?>" alt="<?php echo htmlentities($article->getTitre()); ?>" height="200px">
            <?php endif; ?>

        </p>
    </article>
    <?php
endforeach;
