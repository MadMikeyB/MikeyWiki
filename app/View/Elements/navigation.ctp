<ul class="right">
    <?php if ($user): ?>
    <li><a href="/users/edit"><?php echo $user['User']['username'] ?></a></li>
    <li><a href="/users/logout">Log Out</a></li>
    <?php else: ?>
    <li><a href="/users/login">Log In</a></li>
    <li><a href="/users/add">Register</a></li>
    <?php endif; ?>
</ul>