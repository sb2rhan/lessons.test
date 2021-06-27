<?php


namespace App;

/*
 * HW Doctype
 * Создать класс Doctype. Реализовать КОМПАКТНУЮ герерацию тега <!DOCTYPE ...>
 * https://en.wikipedia.org/wiki/Document_type_declaration
 */

class Doctype
{
    public const PUBLIC = 1;
    public const SYSTEM = 2;

    public const STRICT = 3;
    public const TRANSITIONAL = 4;
    public const FRAMESET = 5;

    public const BASIC = 6;

    /**
     * Generates Doctype from given arguments
     * @param int $DTDKind
     * <p> PUBLIC = 1, SYSTEM = 2 </p>
     * @param string $rootElement
     * <p> Parent element of your document </p>
     * @param string $URI_FPI
     * <p> URI if SYSTEM, FPI if PUBLIC </p>
     * @return string
     */
    static public function customDoctype(int $DTDKind, string $rootElement,
                                         string $URI_FPI): string
    {
        $kind = $DTDKind == self::PUBLIC ? "PUBLIC" : "SYSTEM";
        return "<!DOCTYPE {$rootElement} {$kind} \"{$URI_FPI}\">";
    }

    /**
     * Generates Doctype for XHTML 1.0
     * @param int $DTDType [optional]
     * <p> STRICT = 3, TRANSITIONAL = 4, FRAMESET = 5, BASIC = 6 </p>
     * @return string
     */
    static public function xhtml1(int $DTDType = self::BASIC): string {
        $declaration = '<?xml version="1.0" encoding="UTF-8"?>'
            . "<!DOCTYPE HTML PUBLIC ";

        $declaration .= match($DTDType) {
            self::STRICT => '"-//W3C//DTD XHTML 1.0 Strict//EN" '
                . '"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">',
            self::TRANSITIONAL => '"-//W3C//DTD XHTML 1.0 Transitional//EN" '
                . '"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
            self::FRAMESET => '"-//W3C//DTD XHTML 1.0 Frameset//EN" '
                . '"http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">',
            self::BASIC => '"-//W3C//DTD XHTML Basic 1.0//EN" '
                . '"http://www.w3.org/TR/xhtml-basic/xhtml-basic10.dtd">'
        };
        return $declaration;
    }

    /**
     * Generates Doctype for XHTML 1.1
     * @param bool $isBasic [optional]
     * <p> Basic or default DTD </p>
     * @return string
     */
    static public function xhtml11(bool $isBasic = false): string {
        if (!$isBasic) {
            return '<!DOCTYPE html PUBLIC '
                . '"-//W3C//DTD XHTML 1.1//EN" '
                . '"http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">';
        }
        return '<!DOCTYPE html PUBLIC '
            . '"-//W3C//DTD XHTML Basic 1.1//EN" '
            . '"http://www.w3.org/TR/xhtml-basic/xhtml-basic11.dtd">';
    }

    /**
     * Generates Doctype for HTML 4.01
     * @param int $DTDType [optional]
     * <p> STRICT = 3, TRANSITIONAL = 4, FRAMESET = 5 </p>
     * @return string
     */
    static public function html4(int $DTDType = self::STRICT): string {
        $declaration = "<!DOCTYPE HTML PUBLIC ";
        $declaration .= match ($DTDType) {
            self::STRICT => "\"-//W3C//DTD HTML 4.01//EN\" \"http://www.w3.org/TR/html4/strict.dtd\">",
            self::TRANSITIONAL => "\"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\">",
            self::FRAMESET => "\"-//W3C//DTD HTML 4.01 Frameset//EN\" \"http://www.w3.org/TR/html4/frameset.dtd\">",
        };
        return $declaration;
    }

    /**
     * Generates Doctype for HTML 5
     * @return string
     */
    static public function html5(): string {
        return "<!DOCTYPE html>";
    }
}