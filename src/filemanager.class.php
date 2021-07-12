<?php

	class Filemanager {

		public function __construct(){

		}

		public function getUniqueCode(int $len, string $sep){
            $code = str_shuffle(md5(sha1(bin2hex(random_bytes(32)))));
            ( !empty($len) ) ? $code = substr($code, 0, $len).$sep : $code.$sep;
            return $code;
        }

        public function sanstr(string $str, string $blkrep){

            $str = trim($str);

            $str = str_replace(
                array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
                array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
                $str
            );

            $str = str_replace(
                array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
                array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
                $str
            );

            $str = str_replace(
                array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
                array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
                $str
            );

            $str = str_replace(
                array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
                array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
                $str
            );

            $str = str_replace(
                array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
                array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
                $str
            );

            $str = str_replace(
                array('ñ', 'Ñ', 'ç', 'Ç'),
                array('n', 'N', 'c', 'C',),
                $str
            );

            //Esta parte se encarga de eliminar cualquier caracter extraño
            $str = str_replace(
                array("\\", "¨", "º", "-", "~",
	                "#", "@", "|", "!", "\"",
	                "·", "$", "%", "&", "/",
	                "(", ")", "?", "'", "¡",
	                "¿", "[", "^", "`", "]",
	                "+", "}", "{", "¨", "´",
	                ">", "<", ";", ",", ":",
	                ".", " "),
                $blkrep,
                $str
            );		 

            return strtolower($str);

        }

        // Subir archivos encriptados
        public function upfiles(array $file, string $ofile){

            $ruta = 'dvault/';

            $str = self::sanstr($file['name'], '-');
            $sep = self::extGrab($str,'-');
            $rst = $sep['rst'];
            $ext = $sep['ext'];

            $unq = self::getUniqueCode(5,'_');
            $str = $unq.$rst.'.'.$ext;

            if( move_uploaded_file($file['tmp_name'], $ruta.$str) ){
            	$fcont = file_get_contents($ruta.$str);
            	$strcy = self::encryption($fcont,str_replace('_', '', $unq));
            	$fcryp = $ruta.$unq.$rst.'.crypto';
            	if(file_put_contents($fcryp,$strcy)){
            		chmod($fcryp, 0000);
            		unlink($ruta.$str);
            		if( !empty($ofile) ){
            			$se2 = self::extGrab($ofile,'.');
            			chmod($ruta.$se2['rst'].'.crypto', 0700);
            			unlink($ruta.$se2['rst'].'.crypto');
            		}
            	}
            } else {
            	$str = '';
            }

            return $str;

        }

        // Subir archivos sin encriptar
        public function uploadf(array $file, string $ofile, string $ruta){

            $str = self::sanstr($file['name'], '-');
            $sep = self::extGrab($str,'-');
            $rst = $sep['rst'];
            $ext = $sep['ext'];

            $unq = self::getUniqueCode(5,'_');
            $str = $unq.$rst.'.'.$ext;

            if( move_uploaded_file($file['tmp_name'], $ruta.$str) ){
                chmod($ruta.$str, 0644);
                if( !empty($ofile) ){
                    unlink($ruta.$ofile);
                }
            } else {
                $str = '';
            }

            return $str;

        }

        // Subir archivos múltiples sin encriptar
        public function upldmul(array $file, string $ofile, string $ruta){

            $outp = '';

            $count = count($file['name']);

            for ($i = 0; $i < $count; $i++) {

                $str = self::sanstr($file['name'][$i], '-');
                $sep = self::extGrab($str,'-');
                $rst = $sep['rst'];
                $ext = $sep['ext'];

                $unq = self::getUniqueCode(5,'_');
                $str = $unq.$rst.'.'.$ext;

                if( move_uploaded_file($file['tmp_name'][$i], $ruta.$str) ){
                    chmod($ruta.$str, 0644);
                    if( !empty($ofile) ){
                        unlink($ruta.$ofile);
                    }
                } else {
                    $str = '';
                }

                $outp .= $str.',';

            }
            
            return trim($outp,',');

        }

        // Subir archivo a S3 bucket
        public function updBucket($obj, array $file, string $ofile, string $datastr){

            if(isset($file)){
                $ext1 = self::typeExt($file['type']);
                $ext2 = empty($ofile) ? $ext1 : self::extGrab($ofile,'.');
                $ofile = $ext2 != $ext1 ? $ext2['rst'].'.'.$ext1 : $ofile;
                $ardata = array(
                    'Bucket'        =>  S3BUCKETN,
                    'Key'           =>  empty($ofile) ? self::getUniqueCode(5,'-').$datastr.'.'.$ext1 : $ofile,
                    'SourceFile'    =>  $file['tmp_name']
                );
                $uploadObject = $obj->putObject($ardata);
                return $uploadObject['@metadata']['statusCode'] == 200 ? $ardata['Key'] : 'no-file';
            }

        }

        // Extraer archivo de S3 Bucket
        public function extBucket($obj, string $kfile){

            if($kfile){
                $getFile = $obj->getObject(array('Key'=>$kfile,'Bucket'=>S3BUCKETN));        
                $getFile = $getFile->toArray();        
                return $getFile['Body'];
            }

        }

        // Extraer extensión de archivo. Parámetros Cadena a dividir y divisor
        public function extGrab(string $str, string $div){
        	$pos = strrpos($str, $div);
            $rst = substr($str, 0, $pos);
            $ext = substr($str, $pos+1, strlen($str));
            return array('rst'=>$rst,'ext'=>$ext);
        }

        // Encriptar archivos
        private function encryption(string $str, string $pass){
			$output = FALSE;
			$key = hash('sha256', SALT_FIL.$pass);
			$iv = substr(hash('sha256', SECRET_IV), 0, 16);
			$output = openssl_encrypt($str, METH_CYH, $key, 0, $iv);
			$output = base64_encode($output);
			return $output;
		}

		// Desencriptar archivos
		public function decrypto(string $str, string $pass){
			$key = hash('sha256', $pass);
			$iv = substr(hash('sha256', SECRET_IV), 0, 16);
			$output = openssl_decrypt(base64_decode($str), METH_CYH, $key, 0, $iv);
			return $output;
        }
        
        // Analizar tipo de archivo y devolver extensión
        private function typeExt(string $type){

            $ext = '';

            switch ($type) {

                case 'image/jpeg': $ext = 'jpg'; break;

                case 'image/png': $ext = 'png'; break;

                case 'application/pdf': $ext = 'pdf'; break;

            }

            return $ext;

        }

		// No se puede clonar el objeto 
        public function __clone(){
            trigger_error('La clonación no es permitida!.', E_USER_ERROR);
        }

        public function __destruct(){

        }

	}

?>