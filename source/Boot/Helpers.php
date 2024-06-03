<?php

/** String **/

/**
 * @param string $string
 * @return string
 */
function str_slug(string $string): string
{
    $string = filter_var(mb_strtolower($string), FILTER_SANITIZE_STRIPPED);
    $formats = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜüÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿRr"!@#$%&*()_-+={[}]/?;:.,\\\'<>°ºª';
    $replace = 'aaaaaaaceeeeiiiidnoooooouuuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr                                 ';

    $slug = str_replace(["-----", "----", "---", "--"], "-",
        str_replace(" ", "-",
            trim(strtr(utf8_decode($string), utf8_decode($formats), $replace))
        )
    );
    return $slug;
}

/**
 * @param string $string
 * @return string
 */
function str_studly_case(string $string): string
{
    $string = str_slug($string);
    $studlyCase = str_replace(" ", "",
        mb_convert_case(str_replace("-", " ", $string), MB_CASE_TITLE)
    );

    return $studlyCase;
}

/**
 * @param string $string
 * @return string
 */
function str_camel_case(string $string): string
{
    return lcfirst(str_studly_case($string));
}

/**
 * @param string $string
 * @return string
 */
function str_title(string $string): string
{
    return mb_convert_case(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS), MB_CASE_TITLE);
}

/**
 * @param string $text
 * @return string
 */
function str_textarea(string $text): string
{
    $text = filter_var($text, FILTER_SANITIZE_STRIPPED);
    $arrayReplace = ["&#10;", "&#10;&#10;", "&#10;&#10;&#10;", "&#10;&#10;&#10;&#10;", "&#10;&#10;&#10;&#10;&#10;"];
    return "<p>" . str_replace($arrayReplace, "</p><p>", $text) . "</p>";
}

/**
 * @param string $string
 * @param int $limit
 * @param string $pointer
 * @return string
 */
function str_limit_words(string $string, int $limit, string $pointer = "..."): string
{
    $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
    $arrWords = explode(" ", $string);
    $numWords = count($arrWords);

    if ($numWords < $limit) {
        return $string;
    }

    $words = implode(" ", array_slice($arrWords, 0, $limit));
    return "{$words}{$pointer}";
}

/**
 * @param string $string
 * @param int $limit
 * @param string $pointer
 * @return string
 */
function str_limit_chars(string $string, int $limit, string $pointer = "..."): string
{
    $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
    if (mb_strlen($string) <= $limit) {
        return $string;
    }

    $chars = mb_substr($string, 0, mb_strrpos(mb_substr($string, 0, $limit), " "));
    return "{$chars}{$pointer}";
}

/**
 * @param string $price
 * @return string
 */
function str_price(?string $price): string
{
    return number_format((!empty($price) ? $price : 0), 2, ",", ".");
}

/**
 * @param string|null $search
 * @return string
 */
function str_search(?string $search): string
{
    if (!$search) {
        return "all";
    }

    $search = preg_replace("/[^a-z0-9A-Z\@\ ]/", "", $search);
    return (!empty($search) ? $search : "all");
}

/** APP DATA **/

/**
 * @param string $param
 * @return string
 */
function app(string $param): string
{
    return APP_DATA[$param];
}

/** Url **/

/**
 * @param string|null $path
 * @return string
 */
function url(string $path = null): string
{
    if ($_SERVER["HTTP_HOST"] == "localhost") {
        if ($path) {
            return app("test") . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        }

        return app("test");
    }

    if ($path) {
        return app("domain") . "/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    }

    return app("domain");
}

/**
 * @return string
 */
function url_back(): string
{
    return ($_SERVER['HTTP_REFERER'] ?? url());
}

/**
 * @param string $url
 */
function redirect(string $url): void
{
    header("HTTP/1.1 302 Redirect");
    if (filter_var($url, FILTER_VALIDATE_URL)) {
        header("Location: {$url}");
        exit;
    }

    if (filter_input(INPUT_GET, "route", FILTER_DEFAULT) != $url) {
        $location = url($url);
        header("Location: {$location}");
        exit;
    }
}

/**
 * @return \Source\Support\Session
 */
function session(): \Source\Support\Session
{
    return (new \Source\Support\Session());
}

/**
 * @param string $theme
 * @param string|null $path
 * @param bool $time
 * @return string
 */
function theme(string $theme, string $path = null, bool $time = false): string
{
    $url = url();

    if ($path) {
        $file = $url . "/themes/{$theme}/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
        if ($time && file_exists($file)) {
            return $file . "?time=" . fileatime($file);
        }

        return $file;
    }

    return $url . "/themes/{$theme}";
}


/**
 * @param string $path
 * @param bool $time
 * @return string
 */
function shared(string $path, bool $time = false): string
{
    $url = url();

    $file = $url . "/shared/" . ($path[0] == "/" ? mb_substr($path, 1) : $path);
    if ($time && file_exists($file)) {
        return $file . "?time=" . fileatime($file);
    }

    return $file;
}

/**
 * Date
 */

/**
 * @param string $date
 * @param string $format
 * @return string
 * @throws Exception
 */
function date_fmt(?string $date, string $format = "d/m/Y H\hi"): string
{
    $date = (empty($date) ? "now" : $date);
    return (new DateTime($date))->format($format);
}

/**
 * @param string $date
 * @return string
 * @throws Exception
 */
function date_fmt_br(?string $date): string
{
    $date = (empty($date) ? "now" : $date);
    return (new DateTime($date))->format(DATE["br"]);
}

/**
 * @param string $date
 * @return string
 * @throws Exception
 */
function date_fmt_app(?string $date): string
{
    $date = (empty($date) ? "now" : $date);
    return (new DateTime($date))->format(DATE["app"]);
}

/**
 * @param string|null $date
 * @return string|null
 */
function date_fmt_back(?string $date): ?string
{
    if (!$date) {
        return null;
    }

    if (strpos($date, " ")) {
        $date = explode(" ", $date);
        return implode("-", array_reverse(explode("/", $date[0]))) . " " . $date[1];
    }

    return implode("-", array_reverse(explode("/", $date)));
}


/**
 * @param string|null $message
 * @return string|null
 */
function flash(string $message = null): ?string
{
    $session = new \Source\Support\Session();

    if ($message) {
        $session->set("flash", $message);
        return null;
    }

    if ($flash = $session->flash()) {
        return $flash;
    }

    return null;
}

/*
 * Notify message
 */
/**
 * @param string $message
 * @param string $type
 * @param bool $flash
 * @return string|null
 */
function message(string $message, string $type, bool $flash = false): ?string
{
    switch ($type) {
        case 'success':
            $icon = "<i class='mr-2 fas fa-check'></i>";
            break;

        case 'info':
            $icon = "<i class='mr-2 fas fa-info-circle'></i>";
            break;

        case 'warning':
            $icon = "<i class='mr-2 fas fa-exclamation-triangle'></i>";
            break;

        case 'error':
            $icon = "<i class='mr-2 fas fa-times'></i>";
            break;

        default:
            $icon = "";
    }

    $notify = "<div class='message {$type}'>{$icon} {$message}</div></div>";

    if ($flash) {
        flash($notify);
        return null;
    }

    return $notify;
}