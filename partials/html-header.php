<?php
require_once dirname(__FILE__) . '/../i18n/I18n.php';

function html_header($titleKey)
{
?>
    <!DOCTYPE html>
    <html lang="<?php echo I18n::lang(); ?>" dir="<?php echo I18n::dir() ?>">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title><?php echo I18n::__($titleKey); ?></title>

        <?php if (I18n::dir() == 'rtl') : ?>
            <link rel="stylesheet" href="/styles/bulma-rtl.min.css">

            <style>
                .field.has-addons {
                    flex-direction: row;
                }
            </style>
        <?php else : ?>
            <link rel="stylesheet" href="/styles/bulma.min.css">
        <?php endif; ?>
    </head>
<?php
}
?>