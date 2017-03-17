<!-- ------------- Block FERMER SESSION ------------ -->
<div class="container col-sm-2 col-sm-offset-10">
    <p><a class="btn" href="<?php echo Lib\Application::ROOT ?>?module=connection&action=logout"><span class="glyphicon glyphicon-remove-circle"></span> Fermer</a></p>
</div>
<!-- ----------------------------------------------- -->



<h2 class="sub-header">Section title</h2>
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Titre</th>
                <th>Actions</th>

            </tr>
        </thead>

        <?php foreach ($articles as $article) : ?>
            <tbody>
                <tr> 
                    <td><?php echo $article->getId(); ?></td>
                    <td><?php echo $article->getDate()->format('d-m-Y'); ?></td>
                    <td><?php echo $article->getTitre(); ?></td>     
                    <td><a class="btn btn-info" href="<?php echo Lib\Application::ROOT; ?>admin?module=article&action=edit&id=<?php echo $article->getId(); ?>">Editer</a></td>   
                    <td><a class="btn btn-warning" href="<?php echo Lib\Application::ROOT; ?>admin?module=article&action=delete&id=<?php echo $article->getId(); ?>">Supprimer</a></td>     


                </tr>
            </tbody>   
        <?php endforeach; ?> 


    </table>
    <!--pagination-->
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <!--First and previous pages-->
            <?php if ($page == 1): ?>
                <li class="disabled">
                <?php else : ?>
                <li>
                <?php endif; ?>
                <a href="<?php echo Lib\Application::ROOT; ?>admin?module=article&page=<?php echo 1; ?>" aria-label="First">
                    <span aria-hidden="true">&larrb;</span>
                </a>
            </li>

            <?php if ($page == 1): ?>
                <li class="disabled"><a href="#" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a></li>
            <?php else: ?>
                <li><a href="<?php echo Lib\Application::ROOT; ?>admin?module=article&page=<?php echo ($page - 1); ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li> <?php endif; ?>

            <!--boucle boutons-->
            <?php
            $i = 0;
            while ($i <= 4 && $p <= $nbPage):
                $i++;
                ?>
                <li <?php if ($p == $page): ?>class="active" <?php endif; ?>><a href="<?php echo Lib\Application::ROOT; ?>admin?module=article&page=<?php echo $p; ?>"><?php echo $p; ?></a></li>
                <?php
                $p++;
            endwhile;
            ?>


            <!--next and last pages-->  
            <?php if ($page == $nbPage): ?><li class="disabled"><a href="#" aria-label="Next"><span aria-hidden="true">&raquo;</span></a></li>
            <?php else: ?>
                <li><a href="<?php echo Lib\Application::ROOT; ?>admin?module=article&page=<?php echo ($page + 1); ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li> <?php endif; ?>

            <?php if ($page == $nbPage): ?>
                <li class="disabled">
                <?php else : ?>
                <li>
                <?php endif; ?>
                <a href="<?php echo Lib\Application::ROOT; ?>admin?module=article&page=<?php echo $nbPage; ?>" aria-label="Last">
                    <span aria-hidden="true">&rarrb;</span>
                </a>
            </li>


        </ul>
    </nav>
</div>