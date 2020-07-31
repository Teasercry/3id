<?php

App::uses('Component', 'Controller');

class UploadComponent extends Component {

    function makeThumbnails($updir, $img, $id, $MaxWe = 100, $MaxHe = 150) {

        $arr_image_details = getimagesize($img);
        $width = $arr_image_details[0];
        $height = $arr_image_details[1];
        $percent = 100;
        if ($width > $MaxWe)
            $percent = floor(($MaxWe * 100) / $width);

        if (floor(($height * $percent) / 100) > $MaxHe)
            $percent = (($MaxHe * 100) / $height);

        if ($width > $height) {
            $newWidth = $MaxWe;
            $newHeight = round(($height * $percent) / 100);
        } else {
            $newWidth = round(($width * $percent) / 100);
            $newHeight = $MaxHe;
        }

        if ($arr_image_details[2] == 1) {
            $imgt = "ImageGIF";
            $imgcreatefrom = "ImageCreateFromGIF";
        }
        if ($arr_image_details[2] == 2) {
            $imgt = "ImageJPEG";
            $imgcreatefrom = "ImageCreateFromJPEG";
        }
        if ($arr_image_details[2] == 3) {
            $imgt = "ImagePNG";
            $imgcreatefrom = "ImageCreateFromPNG";
        }


        if ($imgt) {


            $old_image = $imgcreatefrom($img);
            $new_image = imagecreatetruecolor($newWidth, $newHeight);
            imagecopyresized($new_image, $old_image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

            $imgt($new_image, $updir . "" . $MaxWe . "x" . $MaxHe . "_" . $id);
            return;
        }
    }

    public function file($data, $path, $prefixo) {
        // Pasta onde o arquivo vai ser salvo
        $_UP['pasta'] = $path;
        // Tamanho máximo do arquivo (em Bytes)
        //$_UP['tamanho'] = 1024 * 1024 * 8; // 2Mb
        $_UP['tamanho'] = 10000000; // 10Mb
        // Array com as extensões permitidas
        $_UP['extensoes'] = array('jpg', 'png', 'gif', 'jpeg','pdf','docx','xml');
        $_UP['renomeia'] = true;

        $name = $data['name'];
        $tmp_name = $data['tmp_name'];
        $tipo = $data['type'];
        $tamanho = $data['size'];
        $error = $data['error'];
        if ($error == 1) {
            return 103;
            die();
        }

        // Faz a verificação da extensão do arquivo
        //$extensao = strtolower(end(explode('.', $name)));
        $extensao = explode(".", $name);
        $extensao = $extensao[1];

        if (array_search(strtolower($extensao), $_UP['extensoes']) === false) {
            return 101;
            die();
        }
        // Faz a verificação do tamanho do arquivo
        else if ($_UP['tamanho'] < $tamanho) {
            return 102;
            die();
        } else {
            $nome_final = "$prefixo-" . time() . '-' . rand(1, 500) . '.' . $extensao;
            //debug($nome_final);
            if (move_uploaded_file($tmp_name, $_UP['pasta'] . $nome_final)) {
                return $nome_final;
                die();
            } else {
                return 103;
                die();
            }
        }
    }

    public function copy($file_origem, $file_destino) {
        //chmod($file_destino, 0777);
        copy($file_origem, $file_destino);
    }

    public function translate_error($error) {
        if ($error == 101) {
            return 'Extenssão Inválida. Somente é aceito as extenssões: jpg, png e gif.';
        } elseif ($error == 102) {
            return 'Tamanho ultrapassado: 2mb.';
        } elseif ($error == 104) {
            return 'Nenhum arquivo selecionado.';
        } else {
            return 'Erro na transferencia do arquivo!';
        }
    }

    public function delete_file($data, $path) {
        unlink($path . $data);
    }

    public function cria_nome_pasta($string, $slug = false) {
        $string = strtolower($string);

        // Código ASCII das vogais
        $ascii['a'] = range(224, 230);
        $ascii['e'] = range(232, 235);
        $ascii['i'] = range(236, 239);
        $ascii['o'] = array_merge(range(242, 246), array(240, 248));
        $ascii['u'] = range(249, 252);

        // Código ASCII dos outros caracteres
        $ascii['b'] = array(223);
        $ascii['c'] = array(231);
        $ascii['d'] = array(208);
        $ascii['n'] = array(241);
        $ascii['y'] = array(253, 255);

        foreach ($ascii as $key => $item) {
            $acentos = '';
            foreach ($item AS $codigo)
                $acentos .= chr($codigo);
            $troca[$key] = '/[' . $acentos . ']/i';
        }

        $string = preg_replace(array_values($troca), array_keys($troca), $string);

        // Slug?
        if ($slug) {
            // Troca tudo que não for letra ou número por um caractere ($slug)
            $string = preg_replace('/[^a-z0-9]/i', $slug, $string);
            // Tira os caracteres ($slug) repetidos
            $string = preg_replace('/' . $slug . '{2,}/i', $slug, $string);
            $string = trim($string, $slug);
        }

        return $string;
    }

}

?>