<?php

/**
 * Description of Language
 *
 * @author  : Songpon Kamsa_at
 * @company : Tak Provincial Health Office
 * @create  : 29 ก.ค. 2555 9:27:20
 * 
 */
class Language {

    public function SetLanguage() {
        $language = Language::getLangValue();
        if ($language == 'EN') {
            return "en";
        } else {
            return "th";
        }
    }

    public static function GetLanguageDefault() {
        $language = Language::getLangValue();
        if ($language == 'EN') {
            return "_en";
        } else {
            return "";
        }
    }

    public static function TextFilterYear() {
        $language = Language::getLangValue();
        if ($language == 'EN') {
            return "Year";
        } else {
            return "ปี พ.ศ.";
        }
    }

    public static function TextFilterPeriod() {
        $language = Language::getLangValue();
        if ($language == 'EN') {
            return "Period";
        } else {
            return "ปีงบประมาณ";
        }
    }

    public static function TextFilterAmphur() {
        $language = Language::getLangValue();
        if ($language == 'EN') {
            return "Amphur";
        } else {
            return "อำเภอ";
        }
    }

    public static function TextFilterTambon() {
        $language = Language::getLangValue();
        if ($language == 'EN') {
            return "Tambon";
        } else {
            return "ตำบล";
        }
    }

    public static function TextFilterOffice() {
        $language = Language::getLangValue();
        if ($language == 'EN') {
            return "Office";
        } else {
            return "สถานบริการ";
        }
    }

    public static function TextFilterDefaultSelect() {
        $language = Language::getLangValue();
        if ($language == 'EN') {
            return "... Select value ...";
        } else {
            return "== กรุณาเลือก ==";
        }
    }

    public static function TextFilterSelectAll() {
        $language = Language::getLangValue();
        if ($language == 'EN') {
            return "... Select All ...";
        } else {
            return "== เลือกทั้งหมด ==";
        }
    }

    public static function TextFilterSubmitl() {
        $language =Language::getLangValue();
        if ($language == 'EN') {
            return "OK";
        } else {
            return "ตกลง";
        }
    }

    public static function TextFilterNote() {
        $language = Language::getLangValue();
        if ($language == 'EN') {
            return "Note";
        } else {
            return "หมายเหตุ";
        }
    }

    public static function TextFilterReport() {
        $language = Language::getLangValue();
        if ($language == 'EN') {
            return "Report";
        } else {
            return "รายงาน";
        }
    }

    public static function setLang($lang = 'TH') {
        $language = array('Language' => $lang, 'LangVal' => $lang == 'TH' ? "" : "_en");
        Yii::app()->session['language'] = $language;
    }

    /**
     * Get Language ex.TH,EN...
     * @return string
     */
    public static function getLangValue() {
        return Yii::app()->session['language']['Language'];
    }
    
    /**
     * for postfix fieldname
     * @return string
     */
    public static function getLangField(){
        return Yii::app()->session['language']['LangVal'];
    }

    public static function Source() {
        $language = Language::getLangValue();
        if ($language == 'EN') {
            return "Source : ";
        } else {
            return "ที่มา : ";
        }
    }

    function date_th($dateformat = "") {
        $year = substr($dateformat, 0, 4);
        $month = substr($dateformat, 5, 2);
        $day = substr($dateformat, 8, 2);
        $thai = Array("", "ม.ค.", "ก.พ.", "มี.ค.", "เม.ย.", "พ.ค.", "มิ.ย.", "ก.ค.", "ส.ค.", "ก.ย.", "ต.ค.", "พ.ย.", "ธ.ค.");

        if (strlen($dateformat) <= 10) {
            return $thaidate = (int) $day . " " . $thai[(int) $month] . " " . ($year + 543);
        } else {
            return $thaidate = (int) $day . " " . $thai[(int) $month] . " " . ($year + 543) . " " . substr($dateformat, 10);
        }
    }

    function date_en($dateformat = "") {
        $year = substr($dateformat, 0, 4);
        $month = substr($dateformat, 5, 2);
        $day = substr($dateformat, 8, 2);
        $thai = Array("", "JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC");

        if (strlen($dateformat) <= 10) {
            return $thaidate = (int) $day . " " . $thai[(int) $month] . " " . ($year);
        } else {
            return $thaidate = (int) $day . " " . $thai[(int) $month] . " " . ($year) . " " . substr($dateformat, 10);
        }
    }

    function month_full() {
        $thai_month = array("มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฏาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม");
        return $thai_month;
    }

}
?>

