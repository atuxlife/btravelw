<?php

    class inicio {
        
        public function __construct(array $res) {
            $this->clstr = $res['cleanstr'];
            $this->crud = $res['crud'];
            $this->rndr = $res['render'];
            $this->fima = $res['fileman'];
            $this->seda = $_SESSION['u'];
        }

        public function index(){

            $d = array(
                'data' => array(
                    'title' => SITE_NAM,
                    'empre' => EMP_NAME
                ),
                'file' => 'html/index.html'
            );

            $this->rndr->setData($d);
            echo $this->rndr->rendertpl();

        }

        public function getWeatherInfo(){

            $cities = array('New York','Miami','Orlando');
            $datart = array();

            foreach ($cities as $k => $v) {
                
                $url = "http://api.openweathermap.org/data/2.5/weather?q=".$v."&appid=49c0bad2c7458f1c76bec9654081a661";
                $ch = curl_init();
                curl_setopt($ch,CURLOPT_URL,$url);
                curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
                $result = curl_exec($ch);
                curl_close($ch);
                $result = json_decode($result,true);
                if( $result['cod'] == 200 ){
                    array_push($datart, array(
                        'city'          =>  $result['name'],
                        'lat'           =>  $result['coord']['lat'],
                        'lon'           =>  $result['coord']['lon'],
                        'tempe'         =>  round($result['main']['temp']-273.15),
                        'humed'         =>  $result['main']['humidity']
                    ));  
                    unset($result);                  
                }

            }

            echo json_encode($datart, true);
            self::insertLog(json_encode($datart, true));

        }

        // Listar datos históricos de clima
        public function lstWeatherInfo(array $data){
            
            $dtIni = date('Y-m-d H:i:s',strtotime($data['dfini']));
            $dtFin = date('Y-m-d H:i:s',strtotime($data['dffin']));
            
            $sql = "SELECT d.id, d.datetimerep
                    FROM ".BD_PREFI."datareports d
                    WHERE d.id > 0 ";

            $dp = array();
            $im = 1;

            foreach ($data as $k => $v) {

                if( !empty($v) || strlen($v) > 0 ){

                    switch($k) {

                        case 'dfini':
                            $sql .= " AND d.datetimerep >= ? ";
                            array_push($dp, ['kpa'=>$im,'val'=>$dtIni,'typ'=>'string']);                            
                        break;

                        case 'dffin':
                            $sql .= " AND d.datetimerep <= ? ";
                            array_push($dp, ['kpa'=>$im,'val'=>$dtFin,'typ'=>'string']);                            
                        break;

                    }

                    $im++;

                }

            }

            $aw = $this->crud->select_group($sql, count($dp), $dp, 'arra');
            echo json_encode($aw,true);
            
        }

        // Mostrar resultados individuales de la lista de histórico
        public function shwDataHist(int $id){

            $sql = "SELECT d.rawdata
                    FROM ".BD_PREFI."datareports d
                    WHERE d.id = ?
                    LIMIT 1;";

            $re = $this->crud->select_id($sql, $id, 'arra');
            $ar = $re['res'];

            echo json_encode($ar,true);

        }

        // Imsertar datos para registro histórico
        private function insertLog(string $data){

            $info = array('rawdata'=>$data,'datetimerep'=>date('Y-m-d H:i:s'));
            $resp = $this->crud->insert($info,BD_PREFI.'datareports');
        
        }

    }

?>