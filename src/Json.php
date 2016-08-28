<?php
/**
 *
 */
namespace KKo;

/**
 * JSON wrapper
 *
 * @author Knut Kohl <github@knutkohl.de>
 */
class Json
{
    /**
     * Allow PHP comments in JSON in not strict mode
     */
    public static $Strict = true;

    /**
     * Encode given data to JSON
     *
     * @param $value   string JSON
     * @param $options integer
     * @param $depth   integer
     */
    public static function encode($value, $options=0, $depth=512)
    {
        return json_encode($value, $options, $depth);
    }

    /**
     * Encode given data to JSON file
     *
     * @param $file    string
     * @param $value   string JSON
     * @param $options integer
     * @param $depth   integer
     * @return integer Bytes written
     */
    public static function encodeToFile($file, $value, $options=0, $depth=512)
    {
        return file_put_contents($file, self::encode($value, $options, $depth));
    }

    /**
     * Decode given JSON
     *
     * @param $json    string JSON
     * @param $assoc   boolean
     * @param $depth   integer
     * @param $options integer
     * @throws \RunTimeException
     */
    public static function decode($json, $assoc=false, $depth=512, $options=0)
    {
        if (!self::$Strict) {
            $striped = '';
            // Tokenize JSON and remove all comments and whitespaces

            foreach (@token_get_all('<?php '.$json) as $token) {
                if (!is_array($token)) {
                    $striped .= $token;
                } elseif ($token[0] == T_CONSTANT_ENCAPSED_STRING || $token[0] == T_LNUMBER) {
                    $striped .= $token[1];
                }
            }
            $json = $striped;
        }

        $decoded = json_decode($json, $assoc, $depth, $options);

        if (json_last_error() != JSON_ERROR_NONE) {
            throw new \RunTimeException(json_last_error_msg(), json_last_error());
        }

        return $decoded;
    }

    /**
     * Decode JSON file
     *
     * @param $file    string
     * @param $assoc   boolean
     * @param $depth   integer
     * @param $options integer
     * @throws \InvalidArgumentException
     */
    public static function decodeFile($file, $assoc=false, $depth=512, $options=0)
    {
        if (!is_file($file)) {
            throw new \InvalidArgumentException('Missing file: '.$file);
        }

        return self::decode(file_get_contents($file), $assoc, $depth, $options);
    }

}
