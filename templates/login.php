<form action="" method="post">
    <input type="hidden" name="login" value="true" />

    <?php if ( isset( $login_error ) ) { ?>
        <div class="errorMessage"><?php echo $login_error ?></div>
    <?php } ?>

    <ul>

        <li>
            <label for="username">Username</label>
            <input type="text" name="username" id="username" placeholder="Your admin username" required autofocus maxlength="20" />
        </li>

        <li>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Your admin password" required maxlength="20" />
        </li>

    </ul>

    <div class="buttons">
        <input type="submit" name="login" value="Login" />
    </div>

</form>