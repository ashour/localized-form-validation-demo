<?php
require_once dirname(__FILE__) . '/../i18n/I18n.php';

function lang_switcher()
{
?>
    <form action="/" method="GET">
        <div class="field is-horizontal">
            <div class="field-label is-normal">
                <label class="label" for="lang">
                    <?php echo I18n::__('language') ?>
                </label>
            </div>

            <div class="field-body">
                <div class="field has-addons">
                    <div class="control is-expanded">
                        <div class="select is-fullwidth">
                            <select id="lang" name="lang" autocomplete="off">
                                <?php foreach (I18n::supportedLangs() as $key => $name) : ?>
                                    <option value="<?php echo $key ?>" <?php echo $key == I18n::lang() ? 'selected' : '' ?>>
                                        <?php echo $name ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>

                    <div class="control">
                        <button class="button">
                            <?php echo I18n::__('go') ?>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
<?php
}
?>