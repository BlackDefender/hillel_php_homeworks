<?php

class ImagesRepo
{

    private static function convertFileName($fileName)
    {
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
            'ь' => '',    'ы' => 'y',   'ъ' => '',
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
            'Ь' => '',    'Ы' => 'Y',   'Ъ' => '',
            'Э' => 'E',   'Ю' => 'Yu',  'Я' => 'Ya',

            ' ' => '-',   '\''=> '',
        );
        return strtr($fileName, $converter);
    }

    public static function upload($fieldName)
    {
        if(isset($_FILES[$fieldName])){
            $uploudedFileBaseName = self::convertFileName(basename($_FILES[$fieldName]['name']));
            $uploadFile = Config::getSiteDir().Config::$imagesUploadDir.'originals/'.$uploudedFileBaseName;
            if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $uploadFile)) {
                return $uploudedFileBaseName;
            } else {
                return '';
            }
        }else{
            return '';
        }
    }

    public static function getImageUrl($imageName, $size = null)
    {
        if(!empty($size)){
            return self::resize($imageName, $size);
        }else{
            if(!empty($imageName)){
                $relativePath = Config::$imagesUploadDir.'originals/'.$imageName;
                $fullPath = Config::getSiteDir().$relativePath;
                if(file_exists($fullPath)){
                    return Config::getSiteUrl().$relativePath;
                }else{
                    return '';
                }
            }else{
                return '';
            }
        }
    }

    public static function getPlaceholder()
    {
        return Config::getSiteUrl().Config::$imagesUploadDir.'placeholder.jpg';
    }

    public static function remove($imageName)
    {
        $path = Config::getSiteDir().Config::$imagesUploadDir.'originals/'.$imageName;
        if(file_exists($path) && is_file($path)){
            unlink($path);
        }
    }

    private static function resize($imageName, $args)
    {
        if(!empty($imageName)){
            $src = Config::getSiteUrl().Config::$imagesUploadDir.'originals/'.$imageName;
        }else{
            $src = 'no_photo';
        }
        $args['src'] = $src;
        $kt = new Kama_Make_Thumb($args);
        return $kt->do_thumbnail();
    }

    public static function clearCache()
    {
        $pattern = Config::getSiteDir().Config::$imagesUploadDir.'cache/*';
        $files = glob($pattern);
        foreach($files as $file){
            if(is_file($file))
                unlink($file);
        }
    }

    public static function cacheInfo()
    {
        $info = (object)[
            'filesCount' => 0,
            'size' => 0,
        ];
        $pattern = Config::getSiteDir().Config::$imagesUploadDir.'cache/*';
        $files = glob($pattern);
        foreach($files as $file){
            if(is_file($file)){
                ++$info->filesCount;
                $info->size += filesize($file);
            }
        }
        $info->size = round($info->size / (1024*1024), 2);

        return $info;
    }

}