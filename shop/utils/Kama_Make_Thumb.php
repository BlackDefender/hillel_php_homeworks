<?php
/**
 * Код заимствован (и слегка модифицирован) из Wordpress плагина Kama Thumbnail
 * https://github.com/wp-plugins/kama-thumbnail
 *
 * Аргументы: src, w/width, h/height, q, alt, class, title, notcrop
 */

class Kama_Make_Thumb{
    public $src;
    public $width;
    public $height;
    public $notcrop;
    public $quality;

    private $args;
    private $opt;

    function __construct( $args = array() ){
        $this->opt = (object) [
            // Путь до папки кэша.
            'cache_folder'     => realpath( Config::getSiteDir().Config::$imagesUploadDir.'cache/'),
            // УРЛ папки кэша.
            'cache_folder_url' => Config::getSiteUrl() .Config::$imagesUploadDir.'cache/',
            // УРЛ картинки заглушки. По умолчанию - картинка placeholder.jpg
            'no_photo_url'     => Config::getSiteUrl() .Config::$imagesUploadDir.'/placeholder.jpg',
            // качество сжатия jpg
            'quality'          => 80,
        ];
        $this->set_args( $args );
    }

    ## добавляет в конец назыания файла строку stub
    function add_stub_to_path( $path_url ){
        $bname = basename( $path_url );
        return str_replace( $bname, 'stub_'. $bname, $path_url );
    }

    ## Функция создает миниатюру. Возвращает УРЛ ссылку на миниатюру
    function do_thumbnail(){

        // проверяем нужна ли картинка заглушка
        if( $this->src == 'no_photo'){
            $this->src = $this->opt->no_photo_url;
        }



        $path = parse_url( $this->src, PHP_URL_PATH );

        // картинка не определена
        if( ! $path ) return false;

        preg_match('~(?<=\.)[a-z]+$~i', $path, $m );
        $ext       = $m[0] ? $m[0] : 'png';


        $notcrop   = $this->notcrop ? '_notcrop' : '';
        $file_name = pathinfo($path)['filename'] ."_{$this->width}x{$this->height}{$notcrop}.{$ext}";
        $dest      = $this->opt->cache_folder . "/$file_name"; //файл миниатюры от корня сайта
        $img_url   = rtrim( $this->opt->cache_folder_url, '/') ."/$file_name"; //ссылка на изображение;

        // если миниатюра уже есть, то возвращаем её
        if( file_exists( $dest ) )
            return $img_url;
        // если есть заглушка возвращаем её
        elseif( file_exists( $this->add_stub_to_path($dest) ) ){
            return $this->add_stub_to_path( $img_url );
        }


        // если релевантная ссылка
        if( $this->src{0} == '/' )
            $this->src = Config::getSiteUrl() . $this->src;


        // Если не удалось получить картинку: недоступный хост, файл пропал после переезда или еще чего.
        // То для указаного УРЛ будет создана миниатюра из заглушки no_photo.png
        // Чтобы после появления файла, миниатюра создалась правильно, нужно очистить кэш плагина.
        $img_str = $this->get_img_string( $this->src );

        $size = $this->__getimagesizefromstring( $img_str );

        if( ! $size || false === strpos($size['mime'], 'image') ){
            $this->src   = $this->opt->no_photo_url;
            $img_str     = $this->get_img_string( $this->src );
            $is_no_photo = true;
        }

        // Изменим название файла если это картинка заглушка
        if( isset($is_no_photo) && $is_no_photo ){
            $dest    = $this->add_stub_to_path( $dest );
            $img_url = $this->add_stub_to_path( $img_url );
        }

        # создаем миниатюру
        # проверим наличие библиотеки Imagick
        if( extension_loaded('imagick') ){
            $this->make_thumbnail_Imagick( $img_str, $this->width, $this->height, $dest, $this->notcrop );

            return $img_url;
        }

        # проверим наличие библиотеки GD
        if( extension_loaded('gd') ){
            $this->make_thumbnail_GD( $img_str, $this->width, $this->height, $dest, $this->notcrop );

            return $img_url;
        }

        // выборосить заметку - библиотеки не установленны для обрботки
        trigger_error('ERROR: There is no one of the Image libraries (GD or Imagick) installed on your server.', E_USER_NOTICE );

        return false;
    }

    function __getimagesizefromstring( $data ){
        if( function_exists('getimagesizefromstring') )
            return getimagesizefromstring( $data );

        return getimagesize('data://application/octet-stream;base64,'. base64_encode($data) );
    }


    private function get_img_string( $img_url ){
        $img_string = '';

        if( false !== strpos( $img_url, 'http' ) ){
            // curl
            if(0){}
            elseif( ini_get('allow_url_fopen') ){
                $headers = get_headers( $img_url );
                $status  = substr($headers[0], 9, 3);

                if( $status == 200 )
                    $img_string = @ file_get_contents( $img_url );
            }
            elseif( is_callable('curl_init') ){
                $ch = curl_init( $img_url );
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
                $img_string = curl_exec($ch);

                if( curl_getinfo($handle, CURLINFO_HTTP_CODE) != 200 ){
                    $img_string = '';
                }

                curl_close($ch);
            }
            // пробуем получить по абсолютному пути
            else{
                // получим корень сайта $_SERVER['DOCUMENT_ROOT'] может быть неверный
                $root = ABSPATH;
                $root_parent = dirname( ABSPATH ).'/';
                if( file_exists( $root_parent . 'wp-config.php') && ! file_exists( $root_parent . 'wp-settings.php' ) ){
                    $root = $root_parent;
                }

                $img_path = preg_replace('~^https?://[^/]+(/.*)$~', $root .'$1', $img_url );
                if( file_exists( $img_path ) )
                    $img_string = @ file_get_contents( $img_path );
            }
        }
        //var_dump($img_string);
        return $img_string;
    }

    ## ядро: создание и запись файла-картинки на основе библиотеки Imagick
    private function make_thumbnail_Imagick( $img_string, $width, $height, $dest, $notcrop ){
        $image = new Imagick();
        $image->readImageBlob( $img_string );

        # Select the first frame to handle animated images properly
        if( is_callable( array( $image, 'setIteratorIndex') ) )
            $image->setIteratorIndex(0);

        // устанавливаем качество
        $format = $image->getImageFormat();
        if( $format == 'JPEG' || $format == 'JPG')
            $image->setImageCompression( Imagick::COMPRESSION_JPEG );

        $image->setImageCompressionQuality( $this->quality );

        $origin_h = $image->getImageHeight();
        $origin_w = $image->getImageWidth();

        // получим координаты для считывания с оригинала и размер новой картинки
        list( $dx, $dy, $wsrc, $hsrc, $width, $height ) = $this->__resize_coordinates( $height, $origin_h, $width, $origin_w, $notcrop );

        // обрезаем оригинал
        $image->cropImage( $wsrc, $hsrc, $dx, $dy );
        $image->setImagePage( $wsrc, $hsrc, 0, 0);

        // Strip out unneeded meta data
        $image->stripImage();

        // уменьшаем под размер
        $image->scaleImage( $width, $height );

        $image->writeImage( $dest );
        chmod( $dest, 0755 );
        $image->clear();
        $image->destroy();
    }

    ## ядро: создание и запись файла-картинки на основе библиотеки GD
    private function make_thumbnail_GD( $img_string, $width, $height, $dest, $notcrop ){
        $size = $this->__getimagesizefromstring( $img_string );
        //die( print_r($size) );

        if( $size === false )
            return false; // не удалось получить параметры файла;

        list( $origin_w, $origin_h ) = $size;

        $format = strtolower( substr( $size['mime'], strpos($size['mime'], '/')+1 ) );

        // Создаем ресурс картинки
        $image = @ imagecreatefromstring( $img_string );
        if ( ! is_resource( $image ) )
            return false; // не получилось получить картинку

        // получим координаты для считывания с оригинала и размер новой картинки
        list( $dx, $dy, $wsrc, $hsrc, $width, $height ) = $this->__resize_coordinates( $height, $origin_h, $width, $origin_w, $notcrop );

        // Создаем холст полноцветного изображения
        $thumb = imagecreatetruecolor( $width, $height );

        if( function_exists('imagealphablending') && function_exists('imagesavealpha') ) {
            imagealphablending( $thumb, false ); // режим сопряжения цвета и альфа цвета
            imagesavealpha( $thumb, true ); // флаг сохраняющий прозрачный канал
        }
        if( function_exists('imageantialias') )
            imageantialias( $thumb, true ); // включим функцию сглаживания

        if( ! imagecopyresampled( $thumb, $image, 0, 0, $dx, $dy, $width, $height, $wsrc, $hsrc ) )
            return false; // не удалось изменить размер
        //die( var_dump( $thumb ) );
        //
        // Сохраняем картинку
        if( $format == 'png'){
            // convert from full colors to index colors, like original PNG.
            if ( function_exists('imageistruecolor') && ! imageistruecolor( $thumb ) ){
                imagetruecolortopalette( $thumb, false, imagecolorstotal( $thumb ) );
            }
            imagepng( $thumb, $dest );
        }
        elseif( $format == 'gif'){
            imagegif( $thumb, $dest );
        }
        else {
            imagejpeg( $thumb, $dest, $this->quality );
        }
        @ chmod( $dest, 0755 );
        imagedestroy($image);
        imagedestroy($thumb);

        return true;
    }

    # координаты кадрирования
    # $height (необходимая высота), $origin_h (оригинальная высота), $width, $origin_w
    # @return array - отступ по Х и Y и сколько пикселей считывать по высоте и ширине у источника: $dx, $dy, $wsrc, $hsrc
    private function __resize_coordinates( $height, $origin_h, $width, $origin_w, $notcrop ){
        if( $notcrop ){
            // находим меньшую подходящую сторону у картинки и обнуляем её
            if( $width/$origin_w < $height/$origin_h ) $height = 0;
            else $width = 0;
        }

        // если не указана одна из сторон задаем ей пропорциональное значение
        if( ! $width ) 	$width = round( $origin_w * ($height/$origin_h) );
        if( ! $height ) $height = round( $origin_h * ($width/$origin_w) );

        // Определяем необходимость преобразования размера так чтоб вписывалась наименьшая сторона
        // if( $width < $origin_w || $height < $origin_h )
        $ratio = max( $width/$origin_w, $height/$origin_h );

        //срезать справа и слева
        $dx = $dy = 0;
        if( $height/$origin_h > $width/$origin_w )
            $dx = round( ($origin_w - $width*$origin_h/$height)/2 ); //отступ слева у источника
        // срезать верх и низ
        else
            $dy = round( ($origin_h - $height*$origin_w/$width)/2 ); // $height*$origin_w/$width)/2*6/10 - отступ сверху у источника *6/10 - чтобы для вертикальных фоток отступ сверху был не половина а процентов 30

        // сколько пикселей считывать c источника
        $wsrc = round( $width/$ratio );
        $hsrc = round( $height/$ratio );

        return array( $dx, $dy, $wsrc, $hsrc, $width, $height );
    }


    ## Обработка параметров для создания миниатюр ----
    function set_args( $args = ''){
        if( is_array( $args ) ) $this->args = $args;
        else{
            $args = preg_replace('~\s+&~', '&', $args ); // удалим лишние пробелы для parse_str
            parse_str( $args, $this->args );
        }
        //die(print_r($this->args));
        $rgs = & $this->args;
        $rgs = array_map('trim', $rgs);

        $this->width   = (int)    ( isset($rgs['w'])       ? $rgs['w']       : ( isset($rgs['width'])  ? $rgs['width'] : false ) );
        $this->height  = (int)    ( isset($rgs['h'])       ? $rgs['h']       : ( isset($rgs['height']) ? $rgs['height'] : false ) );
        $this->notcrop = (bool)   ( isset($rgs['notcrop']) ? true            : false );
        $this->src     = (string) ( isset($rgs['src'])     ? $rgs['src']     : '');
        $this->quality = (int)    ( isset($rgs['q'])       ? $rgs['q']       : $this->opt->quality );

        if( ! $this->width && ! $this->height )
            $this->width = $this->height = 100;

    }
}
