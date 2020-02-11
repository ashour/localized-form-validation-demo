<?php

class I18n
{
    public const DEFAULT_LANG = 'en';

    private static $allMessages;

    private static $supportedLangs;

    /**
     * @return string code for current locale
     */
    public static function lang()
    {
        return $_REQUEST['lang'] ?? static::DEFAULT_LANG;
    }

    /**
     * @return 'rtl'|'ltr' layout direction of current locale
     */
    public static function dir()
    {
        return static::lang() == 'ar' ? 'rtl' : 'ltr';
    }

    /**
     * @return array all supported locales in the format `['en' => 'English', ...]`
     */
    public static function supportedLangs()
    {
        if (static::$supportedLangs == null) {
            require_once 'languages.php';
            static::$supportedLangs = $languages;
        }

        return static::$supportedLangs;
    }

    /**
     * Retrieve message translated for current locale
     *
     * @param string $key of message in translation messages file
     * @param array $replacements key-value pairs for interpolation
     * @return string
     */
    public static function __($key, $replacements = [])
    {
        $message = static::messages()[$key] ?? $key;

        if (count($replacements) > 0) {
            foreach ($replacements as $key => $value) {
                $message = str_replace('{' . $key . '}', $value, $message);
            }
        }

        return $message;
    }

    /**
     * @return bool whether a messages exists in the current locale with the
     * given key
     */
    public static function hasKey($key)
    {
        return isset(static::messages()[$key]);
    }

    /**
     * @return string a JSON representation of the current locale's messages
     */
    public static function json_messages()
    {
        return json_encode(static::messages());
    }

    /**
     * @return array all messages for all locales
     */
    private static function allMessages()
    {
        if (static::$allMessages == null) {
            require_once 'messages.php';
            static::$allMessages = $messages;
        }

        return static::$allMessages;
    }

    /**
     * @return array messages for current locale
     */
    private static function messages()
    {
        return static::allMessages()[static::lang()];
    }
}
