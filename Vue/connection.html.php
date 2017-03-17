<div class="container col-sm-7 col-sm-offset-3 col-md8 col-md-offset-2 main">


    <form method="POST" class="form-signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <input type="hidden" name="token" value="<?php echo $token; ?>">
        <label for="inputEmail" class="sr-only">Login</label>
        <input type="text" name="login" id="inputEmail" class="form-control" placeholder="Login" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
            <?php if ($this->hasFlash()): ?>
                <p class="alert alert-danger"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> <?php echo $this->getFlash() ?></p>
            <?php endif; ?>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    </form>

</div> <!-- /container -->