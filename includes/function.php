<?php //error_reporting(0);

#Admin Login
function adminUser($username, $password){
    global $mysqli;
    $sql = "SELECT id,username FROM tbl_admin where username = '".$username."' and password = '".md5($password)."'";       
    $result = mysqli_query($mysqli,$sql);
    $num_rows = mysqli_num_rows($result);
    if ($num_rows > 0){
        while ($row = mysqli_fetch_array($result)){
            echo $_SESSION['ADMIN_ID'] = $row['id'];
                        echo $_SESSION['ADMIN_USERNAME'] = $row['username'];
        return true; 
        }
    }
}

# Insert Data 
function Insert($table, $data){
    global $mysqli;
    $fields = array_keys( $data );  
    $values = array_map( array($mysqli, 'real_escape_string'), array_values( $data ) );
    mysqli_query($mysqli, "INSERT INTO $table(".implode(",",$fields).") VALUES ('".implode("','", $values )."');") or die( mysqli_error($mysqli) );
}

// Update Data, Where clause is left optional
function Update($table_name, $form_data, $where_clause=''){   
    global $mysqli;
    $whereSQL = '';
    if(!empty($where_clause)){
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE'){
            // not found, add key word
            $whereSQL = " WHERE ".$where_clause;
        } else{
            $whereSQL = " ".trim($where_clause);
        }
    }
    // start the actual SQL statement
    $sql = "UPDATE ".$table_name." SET ";

    // loop and build the column /
    $sets = array();
    foreach($form_data as $column => $value){
        $sets[] = "`".$column."` = '".$value."'";
    }
    $sql .= implode(', ', $sets);

    // append the where statement
    $sql .= $whereSQL;
         
    // run and return the query result
    return mysqli_query($mysqli,$sql);
}

 
//Delete Data, the where clause is left optional incase the user wants to delete every row!
function Delete($table_name, $where_clause=''){   
    global $mysqli;
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause)){
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE'){
            // not found, add keyword
            $whereSQL = " WHERE ".$where_clause;
        } else{
            $whereSQL = " ".trim($where_clause);
        }
    }
    // build the query
    $sql = "DELETE FROM ".$table_name.$whereSQL;
     
    // run and return the query result resource
    return mysqli_query($mysqli,$sql);
}  
 

//Image compress
function compress_image($source_url, $destination_url, $quality) {
    $info = getimagesize($source_url);
        if ($info['mime'] == 'image/jpeg')
              $image = imagecreatefromjpeg($source_url);
        elseif ($info['mime'] == 'image/gif')
              $image = imagecreatefromgif($source_url);
      elseif ($info['mime'] == 'image/png')
              $image = imagecreatefrompng($source_url);
        imagejpeg($image, $destination_url, $quality);
    return $destination_url;
}

//Create Thumb Image
function create_thumb_image($target_folder ='',$thumb_folder = '', $thumb_width = '',$thumb_height = ''){  
         $target_path = $target_folder;
         $thumb_path = $thumb_folder;  
          
         $thumbnail = $thumb_path;
         $upload_image = $target_path;

            list($width,$height) = getimagesize($upload_image);
            $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
            switch($file_ext){
                case 'jpg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;
                case 'jpeg':
                    $source = imagecreatefromjpeg($upload_image);
                    break;
                case 'png':
                    $source = imagecreatefrompng($upload_image);
                    break;
                case 'gif':
                    $source = imagecreatefromgif($upload_image);
                     break;
                default:
                    $source = imagecreatefromjpeg($upload_image);
            }
       imagecopyresized($thumb_create, $source, 0, 0, 0, 0, $thumb_width, $thumb_height, $width,$height);
            switch($file_ext){
                case 'jpg' || 'jpeg':
                    imagejpeg($thumb_create,$thumbnail,80);
                    break;
                case 'png':
                    imagepng($thumb_create,$thumbnail,80);
                    break;
                case 'gif':
                    imagegif($thumb_create,$thumbnail,80);
                     break;
                default:
                    imagejpeg($thumb_create,$thumbnail,80);
            }
 }


 function checkSignSalt($data_info){
        $key="nemosofts";
        $data_json = $data_info;
        $data_arr = json_decode(urldecode(base64_decode($data_json)),true);
    
        if($data_arr['package_name']==PACKAGE_NAME){

        }else{
            $set['nemosofts'][] = array("success" => -1, "msg" => "Invalid package name");   
            header( 'Content-Type: application/json; charset=utf-8' );
            echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            exit();  
        }
        return $data_arr;
    }
    
    // Get base url
    function getBaseUrl($array=false) {
        $protocol = "http";
        $host = "";
        $port = "";
        $dir = "";  

        // Get protocol
        if(array_key_exists("HTTPS", $_SERVER) && $_SERVER["HTTPS"] != "") {
            if($_SERVER["HTTPS"] == "on") { $protocol = "https"; }
            else { $protocol = "http"; }
        } elseif(array_key_exists("REQUEST_SCHEME", $_SERVER) && $_SERVER["REQUEST_SCHEME"] != "") { $protocol = $_SERVER["REQUEST_SCHEME"]; }

        // Get host
        if(array_key_exists("HTTP_X_FORWARDED_HOST", $_SERVER) && $_SERVER["HTTP_X_FORWARDED_HOST"] != "") { $host = trim(end(explode(',', $_SERVER["HTTP_X_FORWARDED_HOST"]))); }
        elseif(array_key_exists("SERVER_NAME", $_SERVER) && $_SERVER["SERVER_NAME"] != "") { $host = $_SERVER["SERVER_NAME"]; }
        elseif(array_key_exists("HTTP_HOST", $_SERVER) && $_SERVER["HTTP_HOST"] != "") { $host = $_SERVER["HTTP_HOST"]; }
        elseif(array_key_exists("SERVER_ADDR", $_SERVER) && $_SERVER["SERVER_ADDR"] != "") { $host = $_SERVER["SERVER_ADDR"]; }
        //elseif(array_key_exists("SSL_TLS_SNI", $_SERVER) && $_SERVER["SSL_TLS_SNI"] != "") { $host = $_SERVER["SSL_TLS_SNI"]; }

        // Get port
        if(array_key_exists("SERVER_PORT", $_SERVER) && $_SERVER["SERVER_PORT"] != "") { $port = $_SERVER["SERVER_PORT"]; }
        elseif(stripos($host, ":") !== false) { $port = substr($host, (stripos($host, ":")+1)); }
        // Remove port from host
        $host = preg_replace("/:\d+$/", "", $host);

        // Get dir
        if(array_key_exists("SCRIPT_NAME", $_SERVER) && $_SERVER["SCRIPT_NAME"] != "") { $dir = $_SERVER["SCRIPT_NAME"]; }
        elseif(array_key_exists("PHP_SELF", $_SERVER) && $_SERVER["PHP_SELF"] != "") { $dir = $_SERVER["PHP_SELF"]; }
        elseif(array_key_exists("REQUEST_URI", $_SERVER) && $_SERVER["REQUEST_URI"] != "") { $dir = $_SERVER["REQUEST_URI"]; }
        // Shorten to main dir
        if(stripos($dir, "/") !== false) { $dir = substr($dir, 0, (strripos($dir, "/")+1)); }

        // Create return value
        if(!$array) {
            if($port == "80" || $port == "443" || $port == "") { $port = ""; }
            else { $port = ":".$port; } 
            return htmlspecialchars($protocol."://".$host.$port.$dir, ENT_QUOTES); 
        } else { return ["protocol" => $protocol, "host" => $host, "port" => $port, "dir" => $dir]; }
    }

?>