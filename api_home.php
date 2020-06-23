<?php include("includes/connection.php");
 	include("includes/function.php"); 	
 	include("language/app_language.php");
	
	$file_path = getBaseUrl();
	
    if(isset($_GET['search_text'])){
     
        $jsonObj= array();	
        
        $query="SELECT * FROM tbl_mp3
        LEFT JOIN tbl_category ON tbl_mp3.cat_id= tbl_category.cid
        WHERE tbl_mp3.status='1' AND tbl_mp3.mp3_title like '%".addslashes($_GET['search_text'])."%' 
        ORDER BY tbl_mp3.mp3_title";
        
        $sql = mysqli_query($mysqli,$query)or die(mysqli_error());
        
        while($data = mysqli_fetch_assoc($sql)){
        	$row['id'] = $data['id'];
        	$row['cat_id'] = $data['cat_id'];
        	$row['mp3_type'] = $data['mp3_type'];
        	$row['mp3_title'] = $data['mp3_title'];
        	$row['mp3_url'] = $data['mp3_url'];
        	$row['mp3_thumbnail_b'] = $file_path.'images/'.$data['mp3_thumbnail'];
        	$row['mp3_thumbnail_s'] = $file_path.'images/thumbs/'.$data['mp3_thumbnail'];
        	$row['mp3_duration'] = $data['mp3_duration'];
        	$row['mp3_artist'] = $data['mp3_artist'];
        	$row['mp3_description'] = $data['mp3_description'];
        	$row['total_rate'] = $data['total_rate'];
        	$row['rate_avg'] = $data['rate_avg'];
        	$row['total_views'] = $data['total_views'];
        	$row['total_download'] = $data['total_download'];
        	$row['cid'] = $data['cid'];
        	$row['category_name'] = $data['category_name'];
        	$row['category_image'] = $file_path.'images/'.$data['category_image'];
        	$row['category_image_thumb'] = $file_path.'images/thumbs/'.$data['category_image'];
        
        	array_push($jsonObj,$row);
        }
        
        $set['nemosofts'] = $jsonObj;
        header( 'Content-Type: application/json; charset=utf-8' );
        echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        die();
    }
?>