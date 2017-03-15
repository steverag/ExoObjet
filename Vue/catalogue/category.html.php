<!--<h1><?php echo $categorie->title; ?> <small>(<?php echo $categorie->NbProds; ?>)</small></h1>
<p><?php echo $categorie->contenu; ?></p>
<hr>-->

<?php foreach ($data as $product) : ?>
    <article class="block">
        <h2><a href="../produit/<?php echo $product->getSlug() . '-' . $product->getId(); ?>" ><?php echo $product->getTitle(); ?></a></h2>
        <p><?php echo $product->extractText($product->getContents()); ?></p>

        <?php if ($product->getImage()) : ?>
            <p><img src="<?php echo Lib\Application::REP_IMAGE . $product->getImage()->getUrl(); ?>" alt="<?php echo $product->getImage()->getAlt(); ?>" height="200px"></p>
        <?php endif; ?>
        <p>€<?php echo $product->getPrix(); ?></p>


        <p class="button">
            <a href="../produit/<?php echo $product->getSlug() . '-' . $product->getId(); ?>" class="btn btn-info" role="button">voir: <?php echo $product->getTitle(); ?></a>
        </p>
    </p>
    </article>
    <?php
endforeach;
