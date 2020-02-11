<?php
require_once 'functions.php';
require_once 'form/Input.php';
require_once 'form/Button.php';
require_once 'form/Checkbox.php';
require_once 'partials/html-header.php';
require_once 'partials/lang-switcher.php';

$errors = $errors ?? [];

html_header('form_validation');
?>

<body>
    <section class="section">
        <div class="container">
            <?php lang_switcher() ?>

            <hr>

            <h1 class="title"><?php echo __('title'); ?></h1>

            <p class="subtitle"><?php echo __('subtitle'); ?></p>

            <form action="/process-signup.php" method="POST" id="signupForm" novalidate>
                <input type="hidden" name="lang" value="<?php echo lang() ?>">

                <?php echo Input::make('name', $errors)->render() ?>

                <?php echo Input::make('email', $errors, 'email')->render() ?>

                <?php echo Input::make('password', $errors, 'password')->render() ?>

                <?php echo Checkbox::make('agree_to_terms', $errors)->render() ?>

                <?php echo Button::make('sign_up')->render() ?>
            </form>
        </div>
    </section>
</body>

</html>