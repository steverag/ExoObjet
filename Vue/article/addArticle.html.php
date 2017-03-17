<article>
    <h1 class="alert alert-info">Ajouter un nouvel article</h1>
    <?php if ($this->hasFlash()): ?>
        <div class="alert alert-warning"><?php echo $this->getFlash(); ?></div>
    <?php endif; ?>
    <form method='post' enctype="multipart/form-data">
        <div class="form-group">
            <h2><input type="text" name='titre' placeholder="Ajouter un titre" ></h2>
        </div>

        <div class="form-group"><textarea name='contents' rows="10" cols="100" placeholder="Saisir votre texte"></textarea>
        </div>
        <div class="form-group"><label>Image</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="40000000">
            <input type="file" name="image" > 
            <input type="text" class="form-control" name="image" placeholder="NB: un slug sera généré automatiquement">
        </div>
        <button type="submit" class="btn btn-info" value ="ok">Ajouter</button>
    </form>
</article>




