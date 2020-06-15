<?php if(isset($_SESSION['type'])): ?>
    <div class="msg <?php echo $_SESSION['type']; ?>">

        <?php if(count($errors) > 0): ?>
            <?php foreach($errors as $error): ?>
                <li><?php echo $error ?></li>
            <?php endforeach; ?>
            <?php 
                unset($_SESSION['type']);
            ?>
        <?php else: ?>
            <li><?php echo $_SESSION['message']; ?></li>
            <?php 
                unset($_SESSION['type'], $_SESSION['message']);
            ?>
        <?php endif; ?>

    </div>
<?php endif;?>