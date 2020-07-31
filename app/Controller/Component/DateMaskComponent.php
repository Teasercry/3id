<?php

App::uses('Component', 'Controller');

class DateMaskComponent extends Component {

    public function date_php_to_mysql($data) {
        $hora = explode(" ", $data);
        $cv = explode("/", $hora[0]);
        return "$cv[2]-$cv[1]-$cv[0] $hora[1]:00";
    }

    public function date_mysql_to_php($data) {
        $hora = explode(" ", $data);
        $cv = explode("-", $hora[0]);
        return "$cv[2]/$cv[1]/$cv[0] $hora[1]";
    }

    public function date_mysql_to_php_bonus($data) {
        $hora = explode(" ", $data);
        $cv = explode("-", $hora[0]);
        return "$cv[2]/$cv[1]";
    }

    public function date_php_to_mysql_sem_hora($data) {
        $cv = explode("/", $data);
        return "$cv[2]-$cv[1]-$cv[0]";
    }

    public function date_mysql_to_php_sem_hora($data) {
        $hora = explode(" ", $data);
        $cv = explode("-", $hora[0]);
        return "$cv[2]/$cv[1]/$cv[0]";
    }

    public function format($data, $format) {
        $date = new DateTime($data);
        return $date->format($format);


    }

    public function data_excel_importacao($data){
        //  m/d/Y
        $cv = explode("/", $data);
        return "$cv[2]-$cv[0]-$cv[1]";
    }

    public function date_week_txt($day_week) {
        switch ($day_week) {
            case 0: return 'Domingo';
                break;
            case 1: return 'Segunda-Feira';
                break;
            case 2: return 'Terça-Feira';
                break;
            case 3: return 'Quarta-Feira';
                break;
            case 4: return 'Quinta-Feira';
                break;
            case 5: return 'Sexta-Feira';
                break;
            case 6: return 'Sabado';
                break;
        }
    }
    public function month_txt($month = null) {
      ($month == null)?($month = date('m')):($month);
      switch ($month) {
        case '01':
          return 'Janeiro';
          break;
        case '02':
          return 'Fevereiro';
          break;
        case '03':
          return 'Março';
          break;
        case '04':
          return 'Abril';
          break;
        case '05':
          return 'Maio';
          break;
        case '06':
          return 'Junho';
          break;
        case '07':
          return 'Julho';
          break;
        case '08':
          return 'Agosto';
          break;
        case '09':
          return 'Setembro';
          break;
        case '10':
          return 'Outubro';
          break;
        case '11':
          return 'Novembro';
          break;
        case '12':
          return 'Dezembro';
          break;

        default:
          return '---';
          break;
      }
    }

}

?>
