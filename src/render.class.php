<?php

	class Render {

		private $datamix = '', $filemix = '', $html = '';

		public function __construct(){
			$this->crud = new Crud();
		}

		// Tabla HTML
		public function table_html(array $data, array $ccols, string $id){

			if( $data['sts'] == 0 ){

				$t = '<table id="'.$id.'" align="center" class="table table-striped table-bordered table-hover newrone-table">';
				$t.= "<thead><tr>";
				
				$flds = explode(',',$data['fld']);
				$camp = count($flds);

				for ($i=0; $i < $camp; $i++) { 
					$t.= '<th class="text-center">'.$flds[$i]."</th>";
				}

				$t.= "</tr></thead><tbody>";

				foreach ($data['res'] as $key => $value) {

					$t.= "<tr>";

					for ($k = 0; $k < $camp; $k++){

						if (in_array($k, $ccols)) {
                            $t.= '<td align="center">'.$value[$flds[$k]]."</td>";
                        } else {
                            $t.= "<td>".$value[$flds[$k]]."</td>";
                        }
						
					}

					$t.= "</tr>";

				}

				$t.= '</tbody></table>';

			} else {
				$t = 'There are no records to list. '.$data['msg'].' - '.$data['err'];
			}

			return $t;

		}

		// Tabla Excel
		public function table_xls(array $data){

			if( $data['sts'] == 0 ){

				$t = '<table>';
				$t.= "<thead><tr>";
				
				$flds = explode(',',$data['fld']);
				$camp = count($flds);

				for ($i=0; $i < $camp; $i++) { 
					$t.= '<th>'.utf8_decode($flds[$i])."</th>";
				}

				$t.= "</tr></thead><tbody>";

				foreach ($data['res'] as $key => $value) {

					$t.= "<tr>";

					for ($k = 0; $k < $camp; $k++){

						$t.= "<td>".utf8_decode($value[$flds[$k]])."</td>";
						
					}

					$t.= "</tr>";

				}

				$t.= '</tbody></table>';

			} else {
				$t = 'There are no records to list. '.$data['msg'].' - '.$data['err'];
			}

			return $t;
		}

		// Métodos para renderizar plantillas (Páginas)
		public function setData(array $mix){
			$this->datamix = $mix['data'];
			$this->filemix = $mix['file'];
		}

		// Obtiene el HTML de un archivo
		private function getHtml($plantilla){
			$html = file_get_contents($plantilla);
			return $html;
		}

		// Reemplazar tags metidos entre llaves
		private function keys($datamix){
			foreach ($datamix as $key => $value) {
				$keys[] = '{'.$key.'}';
			}
			return $keys;
		}

		// Renderiza la plantilla
		public function rendertpl(){
			$html = self::getHtml($this->filemix);
			$keyname = self::keys($this->datamix);
			return str_replace($keyname, $this->datamix, $html);
		}

		// Renderizar el encabezado de página
		public function renderHeader(int $lnk){ // string $title

			$links = array(
				array('title'=>'Inicio','href'=>'inicio'),
				array('title'=>'CENPAC','href'=>'acercade'),
				array('title'=>'Publicaciones','href'=>'publicaciones'),
				array('title'=>'Contacto','href'=>'contacto')
			);

			foreach ($links as $k => $v) {
				$act = ($lnk == $k) ? 'class="active"' : '';
				$mnuo .= '<li '.$act.'><a href="'.URL_BASE.$v['href'].'/index" class="nav-link text-left">'.$v['title'].'</a></li>';
			}

			$sqlogo = "SELECT b.logo_head FROM cen_basicos b WHERE b.id = ? LIMIT 1;";
			$re = $this->crud->select_id($sqlogo, 1, 'arra');
			$ar = $re['res'];
			
			$sqlrso = "SELECT r.facebook, r.twitter, r.instagram, r.linkedin, r.youtube
					   FROM cen_redesoc r
					   WHERE r.id = ? 
					   LIMIT 1;";

			$reso = $this->crud->select_id($sqlrso, 1, 'arra');
			$arso = $reso['res'];

			foreach ($arso as $kr => $vr) {

				switch ($kr) {
				
					case 'facebook': $icon = 'icon-facebook'; break;

					case 'twitter': $icon = 'icon-twitter'; break;

					case 'instagram': $icon = 'icon-instagram'; break;

					case 'linkedin': $icon = 'icon-linkedin'; break;

					case 'youtube': $icon = 'icon-youtube'; break;

				}

				if( strlen(trim($vr)) > 0 && $vr != '#' ){
					$btnsoc .= '<a href="'.$vr.'" target="_blank"><span class="'.$icon.'"></span></a>&nbsp;&nbsp;&nbsp;';
				}
				
			}

			$data = array('urlbase'=>URL_BASE,'logo'=>URL_BASE.'images/'.$ar['logo_head'],'mnuo'=>$mnuo,'btnsoc'=>$btnsoc);

			$html = file_get_contents('html/header.html');
			$keyname = self::keys($data);
			return str_replace($keyname, $data, $html);

		}

		// Renderizar el encabezado de página del CMS
		public function renderHeaderCms(string $title){

			return  '<div class="content-header">
						<div class="container-fluid">
						<div class="row mb-2">
							<div class="col-sm-12">
							<h1 class="m-0 text-dark">'.$title.'</h1>
							</div><!-- /.col -->
						</div><!-- /.row -->
						</div><!-- /.container-fluid -->
					</div>';

		}

		// Renderizar el pie de página
		public function renderFooter(string $emp, string $year){
			$data = array('imagen'=>URL_BASE.'images/bg_1.jpg','empresa'=>$emp,'yrcopy'=>$year);
			$html = file_get_contents('html/footer.html');
			$keyname = self::keys($data);
			return str_replace($keyname, $data, $html);
		}

		// Renderizar Select box. Arreglo de los datos, label de seleccion (EJ Selecciones Ítem) y valor por defecto
		public function renderSelect(array $arr, string $selab, string $dfval){

			$slcData = '<option value="">'.$selab.'</option>';

			foreach ($arr as $key => $value) {
                
                if( ($dfval != '') && ($value['id'] == $dfval) ){
                    $slcData .= '<option value="'.$value['id'].'" selected="selected">'.$value['label'].'</option>';
                } else {
                    $slcData .= '<option value="'.$value['id'].'">'.$value['label'].'</option>';
                }
            }

            return $slcData;

		}

		// No se puede clonar el objeto 
        public function __clone(){
            trigger_error('La clonación no es permitida!.', E_USER_ERROR);
        }

        public function __destruct(){

        }

	}

?>