<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Utilities{
    static function rus2translit($string) {

        $converter = array(

            'а' => 'a',   'б' => 'b',   'в' => 'v',

            'г' => 'g',   'д' => 'd',   'е' => 'e',

            'ё' => 'e',   'ж' => 'zh',  'з' => 'z',

            'и' => 'i',   'й' => 'y',   'к' => 'k',

            'л' => 'l',   'м' => 'm',   'н' => 'n',

            'о' => 'o',   'п' => 'p',   'р' => 'r',

            'с' => 's',   'т' => 't',   'у' => 'u',

            'ф' => 'f',   'х' => 'h',   'ц' => 'c',

            'ч' => 'ch',  'ш' => 'sh',  'щ' => 'sch',

            'ь' => '\'',  'ы' => 'y',   'ъ' => '\'',

            'э' => 'e',   'ю' => 'yu',  'я' => 'ya',



            'А' => 'A',   'Б' => 'B',   'В' => 'V',

            'Г' => 'G',   'Д' => 'D',   'Е' => 'E',

            'Ё' => 'E',   'Ж' => 'Zh',  'З' => 'Z',

            'И' => 'I',   'Й' => 'Y',   'К' => 'K',

            'Л' => 'L',   'М' => 'M',   'Н' => 'N',

            'О' => 'O',   'П' => 'P',   'Р' => 'R',

            'С' => 'S',   'Т' => 'T',   'У' => 'U',

            'Ф' => 'F',   'Х' => 'H',   'Ц' => 'C',

            'Ч' => 'Ch',  'Ш' => 'Sh',  'Щ' => 'Sch',

            'Ь' => '\'',  'Ы' => 'Y',   'Ъ' => '\'',

            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',
            
            
            'ü'=>'u',       'Ü'=>'U',   'ö'=>'o',
            'Ö'=>'O',       'ə'=>'e',   'Ə'=>'E',
            'ı'=>'i',       'İ'=>'I',   'ç'=>'ch',
            'Ç'=>'Ch',      'ş'=>'sh',  'Ş'=>'Sh',
            'Ğ'=>'Gh',      'ğ'=>'gh'
        );

    return strtr($string, $converter);

    }

    static function str2url($str) {

        // переводим в транслит

        $str = Utilities::rus2translit($str);

        // в нижний регистр

        $str = strtolower($str);

        // заменям все ненужное нам на "-"

        $str = preg_replace('~[^a-z0-9_]+~u', '-', $str);

        // удаляем начальные и конечные '-'

        $str = trim($str, "-");

        return $str;

    }

    static function mb_str_replace($needle, $replacement, $haystack){
        $needle_len = mb_strlen($needle);
        $replacement_len = mb_strlen($replacement);
        $pos = mb_strpos($haystack, $needle);
        while ($pos !== false)
        {
            $haystack = mb_substr($haystack, 0, $pos) . $replacement
                    . mb_substr($haystack, $pos + $needle_len);
            $pos = mb_strpos($haystack, $needle, $pos + $replacement_len);
        }
        return $haystack;
    }
    static function mb_ucasefirst($str){ 
        $str[0] = mb_strtoupper($str[0]); 
        return $str; 
    } 
    static function genRandomString($length=10, $chars='', $type=array()) {
        //initialize the characters
        $alphaSmall = 'abcdefghijklmnopqrstuvwxyz';
        $alphaBig = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $num = '0123456789';
        $othr = '`~!@#$%^&*()/*-+_=[{}]|;:",<>.\/?' . "'";

        $characters = "";
        $string = '';  
        //defaults the array values if not set
        isset($type['alphaSmall'])  ? $type['alphaSmall']: $type['alphaSmall'] = true;  //alphaSmall - default true  
        isset($type['alphaBig'])    ? $type['alphaBig']: $type['alphaBig'] = true;      //alphaBig - default true
        isset($type['num'])         ? $type['num']: $type['num'] = true;                //num - default true
        isset($type['othr'])        ? $type['othr']: $type['othr'] = false;             //othr - default false 
        isset($type['duplicate'])   ? $type['duplicate']: $type['duplicate'] = true;    //duplicate - default true     

        if (strlen(trim($chars)) == 0) { 
            $type['alphaSmall'] ? $characters .= $alphaSmall : $characters = $characters;
            $type['alphaBig'] ? $characters .= $alphaBig : $characters = $characters;
            $type['num'] ? $characters .= $num : $characters = $characters;
            $type['othr'] ? $characters .= $othr : $characters = $characters;        
        }
        else
            $characters = str_replace(' ', '', $chars);

        if($type['duplicate'])
            for (; $length > 0 && strlen($characters) > 0; $length--) {
                $ctr = mt_rand(0, (strlen($characters)) - 1);
                $string .= $characters[$ctr];
            }
        else
            $string = substr (str_shuffle($characters), 0, $length);

        return $string;
    }


}