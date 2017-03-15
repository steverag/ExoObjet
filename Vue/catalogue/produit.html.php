<article>
    <h2><?php echo $product->getTitle(); ?></h2>
    <div class="container">
        <div class="row">

            <?php if ($product->getImage()) : ?>
                <div class="col-sm-4">
                    <aside class="col-lg-12">
                        <p><img src="<?php echo Lib\Application::REP_IMAGE . $product->getImage()->getUrl(); ?>" alt="<?php echo $product->getImage()->getAlt(); ?>" height="200px"></p>
                    </aside>
                <?php endif; ?>
                <aside class="col-sm-4 col-md-4 col-lg-12" style="text-align:right">
                    <p>€<?php echo $product->getPrix(); ?></p>
                </aside>
            </div>

            <div class="col-sm-8">
                <p><?php echo $product->getContents(); ?></p>
            </div>
        </div>
    </div>
</article>
<article>
    <!-- afficher des notes, s'il y en a-->
    <?php if ($notes): ?>
        <div>
            <h3>Notes des visiteurs</h3>
            <ul><?php foreach ($notes as $note): ?>
                    <li>
                        <?php echo $note->getvaleur() ?>/5 - <?php echo $note->getUser() ?> le <em><?php echo $note->getDate()->format('d-m-Y'); ?></em> 
                    </li>
                <?php endforeach; ?></ul>
        </div>
    <?php endif; ?>
    <!--Afficher le message d'erreur s'il y est-->
    <?php if ($product->getError() != []) : ?>
        <div class="btn-alert">
            <?php echo implode('<br>', $product->getError());
            ?>
        </div> 
    <?php endif; ?>
    <!--Formulaire pour ajouter des notes-->
    <form method="post" action="<?php echo Lib\Application::ROOT ?>catalogue/note" class="form-inline">
        <input type="hidden" name="produit" value="<?php echo $product->getId() ?>">
        <label>Nom   <input type="text" name="user"></label>

        <select name="valeur" id="note">
            <option>1</option>
            <option>2</option>
            <option>3</option>
            <option>4</option>
            <option>5</option>
        </select>
        <button type="submit" name="ok" class="btn btn-info">ok</button>
    </form>
</article>




