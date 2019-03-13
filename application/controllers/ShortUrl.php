<?php
defined('BASEPATH') OR exit('No direct script access allowed');

//все адресса идут на этот контроллер
/*
function shorten($id) {
    $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_-';
    $shortenedId = '';
    while($id>0) {
        $remainder = $id % 64;
        $id = ($id-$remainder) / 64;
        $shortenedId = $alphabet{$remainder} . $shortenedId;
    };
    return $shortenedId;
}*/

function shorten2() {
    return substr(md5(microtime()),rand(0,26),6);
}

class ShortUrl extends CI_Controller {
    public function index()
    {
        $short = false;
        $data['error_m'] = '';
        $data['short_url'] = '';

        //Если пользователь зашёл по короткой ссылке
        $req_u = substr($_SERVER['REQUEST_URI'], 1);
        if (ctype_alnum ($req_u ) && strlen($req_u) == 6) {
            //похоже на короткую ссылку
            $mysqli = new mysqli('localhost', 'root', '', 'turyev');
            if ($mysqli->connect_errno) { $data['error_m'] = 'DB error: ' . $mysqli->connect_errno . '|' . $mysqli->connect_error; }
            //проверяем её наличие
            $query = "SELECT `long` FROM  `url` WHERE  `short` =  '" . $req_u . "' LIMIT 1 ;";
            $res = $mysqli->query($query);
            $row = $res->fetch_assoc();
            if (isset($row['long'])) {
                header('Location: '.$row['long']);
            }
        }

         /*trash*/
        $this->load->library('form_validation');
        //$this->load->model('short_model');

        //Похоже на форму
        if(!empty($_POST)) {
            //Проверка формы
            $this->load->helper('form_helper'); //подключаем хелпер форм

            //пришла строка с формы
            if ( $long = $this->input->post( 'url')) {
                //проверить что это url
                if (!filter_var($long, FILTER_VALIDATE_URL)) {
                    $data['error_m'] = 'это не url';
                } else {
                    //проверить что он реально существует
                    $headers = @get_headers($long);
                    if (!(!$headers || $headers[0] == 'HTTP/1.1 404 Not Found')) {
                        $data['error_m'] = 'точки назначения не существует';
                    } else {
                        //похоже порядок
                        //подключаемся к базе
                        $mysqli = new mysqli('localhost', 'root', '', 'turyev');
                        if ($mysqli->connect_errno) {
                            $data['error_m'] = 'DB error: ' . $mysqli->connect_errno . '|' . $mysqli->connect_error;
                        }

                        //проверяем есть ли в базе $long
                        $query = "SELECT `short` FROM  `url` WHERE  `long` =  '" . $long . "' LIMIT 1 ;";
                        $res = $mysqli->query($query);
                        $row = $res->fetch_assoc();
                        if (isset($row['short'])) {     //если есть присваиваем имеющийся
                            $short = $row['short'];

                        } else {
                            //генерируем короткий url
                            $short = shorten2();
                            $query = "INSERT INTO url (`short`, `long`) VALUES ('" . $short . "','" . $long . "');";
                            $mysqli->query($query);
                        }
                    }
                }
            }
        }
        
        if($short!=''){
            $data['short_url'] = $_SERVER['HTTP_HOST']."/".$short;
        }
        $this->load->view('short_url',$data);     //выводим форму
    }
}
/* У данной работы есть множество недостатков:
    не использованы модели, так как при попытке подключиться к базе возникает ошибка, наводящая на мысль, что нужно пересобрать вебсервер, увы я этого уже не успеваю
    не использован в полной мере хелпер формы по той же причине
    функция создания короткой ссылки может попасть снова на те же знаки и не использует буквы верхнего регистра


 *
 * */