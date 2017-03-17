<?php foreach ($data as $category) : ?>
    <article class="block">
        <h2><a href="<?php echo \Lib\Application::ROOT; ?>catalogue/category/<?php echo $category->getSlug() . '-' . $category->getId() ?>"><?php echo $category->getTitle(); ?> <small>(<?php echo $category->getNbProd() ?>)</small></a></h2>

        <p class="button"><a href="<?php echo \Lib\Application::ROOT; ?>catalogue/category/<?php echo $category->getSlug() . '-' . $category->getId() ?>" class="btn btn-info" role="button">voir: <?php echo $category->getTitle(); ?></a>
        </p>
    </p>
    </article>
    <?php
endforeach;




