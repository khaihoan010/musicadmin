<?php 
	include("includes/connection.php");
 	include("includes/function.php");
 	include("language/app_language.php");

 	define("APP_FROM_EMAIL",$settings_details['email_from']);	

 	define("PACKAGE_NAME",$settings_details['package_name']);
	
 	date_default_timezone_set("Asia/Kolkata");
	
	$protocol = strtolower( substr( $_SERVER[ 'SERVER_PROTOCOL' ], 0, 5 ) ) == 'https' ? 'https' : 'http'; 

	$file_path = getBaseUrl();
	$get_method = checkSignSalt($_POST['data']);
	
	function get_thumb($filename,$thumb_size){	
    	$file_path = getBaseUrl();
    	return $thumb_path=$file_path.'thumb.php?src='.$filename.'&size='.$thumb_size;
    }
	
 	
 	if($get_method['method_name']=="home"){	
		$limit=API_LATEST_LIMIT;
		 
		$jsonObj_1= array();	

		$query1="SELECT * FROM tbl_banner WHERE status='1' ORDER BY tbl_banner.bid DESC";
		$sql1 = mysqli_query($mysqli,$query1);

		while($data1 = mysqli_fetch_assoc($sql1)){
			 
			$row1['bid'] = $data1['bid'];
 			$row1['banner_title'] = $data1['banner_title'];
 			$row1['banner_sort_info'] = $data1['banner_sort_info'];
			$row1['banner_image'] = $file_path.'images/'.$data1['banner_image'];
			$row1['banner_image_thumb'] = $file_path.'images/thumbs/'.$data1['banner_image'];

			$songs_list=explode(",", $data1['banner_songs']);

			$row1['total_songs'] =count($songs_list);

			foreach($songs_list as $song_id){
            	$query01="SELECT * FROM tbl_mp3
					LEFT JOIN tbl_category ON tbl_mp3.`cat_id`= tbl_category.`cid` 
					WHERE tbl_mp3.`id`='$song_id' AND tbl_category.`status`='1' AND tbl_mp3.`status`='1'";

				$sql01 = mysqli_query($mysqli,$query01);

				while($data01 = mysqli_fetch_assoc($sql01)){
					$row01['id'] = $data01['id'];
					$row01['cat_id'] = $data01['cat_id'];
					$row01['album_id'] = $data01['album_id'];
					$row01['mp3_type'] = $data01['mp3_type'];
					$row01['mp3_title'] = $data01['mp3_title'];
					$row01['mp3_url'] = $data01['mp3_url'];
		 			
					 
					$row01['mp3_thumbnail_b'] = $file_path.'images/'.$data01['mp3_thumbnail'];
					$row01['mp3_thumbnail_s'] = get_thumb('images/'.$data01['mp3_thumbnail'],'300x300');
					 
					$row01['mp3_duration'] = $data01['mp3_duration'];
					$row01['mp3_artist'] = $data01['mp3_artist'];
					$row01['mp3_description'] = $data01['mp3_description'];
					$row01['total_rate'] = $data01['total_rate'];
					$row01['rate_avg'] = $data01['rate_avg'];
					$row01['total_views'] = $data01['total_views'];
					$row01['total_download'] = $data01['total_download'];

					$row01['cid'] = $data01['cid'];
					$row01['category_name'] = $data01['category_name'];
					$row01['category_image'] = $file_path.'images/'.$data01['category_image'];
					$row01['category_image_thumb'] = $file_path.'images/thumbs/'.$data01['category_image'];
			 
					 
					$row1['songs_list'][]=$row01;
				}
            }
 
			array_push($jsonObj_1,$row1);
			
			unset($row1['songs_list']);
		}

		$row['home_banner']=$jsonObj_1;


		$jsonObj4= array();		 

		$query4="SELECT * FROM tbl_album WHERE status='1' ORDER BY tbl_album.`aid` DESC LIMIT $limit";
		$sql4 = mysqli_query($mysqli,$query4);

		while($data4 = mysqli_fetch_assoc($sql4)){

			$row4['aid'] = $data4['aid'];
 			$row4['album_name'] = $data4['album_name'];
			$row4['album_image'] = $file_path.'images/'.$data4['album_image'];
			$row4['album_image_thumb'] = get_thumb('images/'.$data4['album_image'],'300x300');
 
			array_push($jsonObj4,$row4);
		
		}

		$row['latest_album']=$jsonObj4;


		$jsonObj3= array();	

		$query3="SELECT id,artist_name,artist_image FROM tbl_artist ORDER BY rand() DESC LIMIT $limit";
		$sql3 = mysqli_query($mysqli,$query3);

		while($data3 = mysqli_fetch_assoc($sql3)){ 
			$row3['id'] = $data3['id'];
			$row3['artist_name'] = $data3['artist_name'];
			$row3['artist_image'] = $file_path.'images/'.$data3['artist_image'];
			$row3['artist_image_thumb'] = get_thumb('images/'.$data3['artist_image'],'300x300');
 
			array_push($jsonObj3,$row3);
		}

		$row['latest_artist']=$jsonObj3;


		$jsonObj_2= array();
	
  		$start = date('Y-m-d',strtotime('today - 30 days'));
  		$finish = date('Y-m-d',strtotime('today'));

		$query2="SELECT DISTINCT tbl_mp3.id, tbl_mp3.*,tbl_category.* FROM tbl_mp3
			LEFT JOIN tbl_category ON tbl_mp3.`cat_id`= tbl_category.`cid` 
			LEFT JOIN tbl_mp3_views ON tbl_mp3.`id`= tbl_mp3_views.`mp3_id`
			WHERE tbl_mp3.`status`='1' AND tbl_category.`status`='1' AND tbl_mp3_views.`date` BETWEEN '$start' AND '$finish' ORDER BY tbl_mp3_views.`views` DESC LIMIT 50";

		$sql2 = mysqli_query($mysqli,$query2);

		while($data2 = mysqli_fetch_assoc($sql2)){
			$row2['id'] = $data2['id'];
			$row2['cat_id'] = $data2['cat_id'];
			$row2['album_id'] = $data2['album_id'];
			$row2['mp3_type'] = $data2['mp3_type'];
			$row2['mp3_title'] = $data2['mp3_title'];
			$row2['mp3_url'] = $data2['mp3_url'];
 			
			$row2['mp3_thumbnail_b'] = $file_path.'images/'.$data2['mp3_thumbnail'];
			$row2['mp3_thumbnail_s'] = get_thumb('images/'.$data2['mp3_thumbnail'],'300x300');
			 
			$row2['mp3_duration'] = $data2['mp3_duration'];
			$row2['mp3_artist'] = $data2['mp3_artist'];
			$row2['mp3_description'] = $data2['mp3_description'];
			$row2['total_rate'] = $data2['total_rate'];
			$row2['rate_avg'] = $data2['rate_avg'];
			$row2['total_views'] = $data2['total_views'];
			$row2['total_download'] = $data2['total_download'];

			$row2['cid'] = $data2['cid'];
			$row2['category_name'] = $data2['category_name'];
			$row2['category_image'] = $file_path.'images/'.$data2['category_image'];
			$row2['category_image_thumb'] = get_thumb('images/'.$data2['category_image'],'300x300');
			 

			array_push($jsonObj_2,$row2);
		}

		$row['trending_songs']=$jsonObj_2;

		$set['nemosofts'] = $row;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
	}	
	    
    
	else if($get_method['method_name']=="latest_home"){
		$home_post_order_by=API_HOME_CAT;
		$limit=API_LATEST_LIMIT;

		$jsonObj= array();	
	
	    $query="SELECT * FROM tbl_mp3
		LEFT JOIN tbl_category ON tbl_mp3.cat_id= tbl_category.cid
		where tbl_mp3.cat_id='$home_post_order_by' AND tbl_mp3.status='1' ORDER BY tbl_mp3.id DESC LIMIT $limit";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql)){
			
			$row['id'] = $data['id'];
			$row['cat_id'] = $data['cat_id'];
			$row['album_id'] = $data['album_id'];
			$row['mp3_type'] = $data['mp3_type'];
			$row['mp3_title'] = $data['mp3_title'];
			$row['mp3_url'] = $data['mp3_url'];
			 
			$row['mp3_thumbnail_b'] = $file_path.'images/'.$data['mp3_thumbnail'];
			$row['mp3_thumbnail_s'] = get_thumb('images/'.$data['mp3_thumbnail'],'300x300');
			 
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
			$row['category_image_thumb'] = get_thumb('images/'.$data['category_image'],'300x300');
			
			array_push($jsonObj,$row);
		
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
	}
	else if($get_method['method_name']=="album_list_home"){
	    
	    $limit=API_LATEST_LIMIT;
	    
 		$jsonObj= array();

		$query="SELECT * FROM tbl_album WHERE status='1' ORDER BY rand() DESC LIMIT $limit";
		$sql = mysqli_query($mysqli,$query)or die(mysql_error());

		while($data = mysqli_fetch_assoc($sql)){
			 
			$row['aid'] = $data['aid'];
 			$row['album_name'] = $data['album_name'];
			$row['album_image'] = $file_path.'images/'.$data['album_image'];
			$row['album_image_thumb'] = get_thumb('images/'.$data['album_image'],'300x300');
 
			array_push($jsonObj,$row);
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
 	}
	else if($get_method['method_name']=="all_songs"){
 
		$query_rec = "SELECT COUNT(*) as num FROM tbl_mp3
			LEFT JOIN tbl_category ON tbl_mp3.`cat_id`= tbl_category.`cid` 
			WHERE tbl_mp3.`status`='1' AND tbl_category.`status`='1'";
		$total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query_rec));
		
		$page_limit=10;
			
		$limit=($get_method['page']-1) * $page_limit;
 
		$jsonObj= array();	
	
	    $query="SELECT * FROM tbl_mp3
			LEFT JOIN tbl_category ON tbl_mp3.`cat_id`= tbl_category.`cid` 
			WHERE tbl_mp3.`status`='1' AND tbl_category.`status`='1' ORDER BY tbl_mp3.`id` DESC LIMIT $limit, $page_limit";

		$sql = mysqli_query($mysqli,$query);

		while($data = mysqli_fetch_assoc($sql)){	
			 
			$row['total_songs'] = $total_pages['num'];
			$row['id'] = $data['id'];
			$row['cat_id'] = $data['cat_id'];
			$row['album_id'] = $data['album_id'];
			$row['mp3_type'] = $data['mp3_type'];
			$row['mp3_title'] = $data['mp3_title'];
			$row['mp3_url'] = $data['mp3_url'];
 			
			$row['mp3_thumbnail_b'] = $file_path.'images/'.$data['mp3_thumbnail'];
			$row['mp3_thumbnail_s'] = get_thumb('images/'.$data['mp3_thumbnail'],'300x300');
			 
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
			$row['category_image_thumb'] = get_thumb('images/'.$data['category_image'],'300x300');
			 
			array_push($jsonObj,$row);
		
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();

		
	}
	else if($get_method['method_name']=="latest"){
 
		//$limit=API_LATEST_LIMIT;

		$query_rec = "SELECT COUNT(*) as num FROM tbl_mp3
			LEFT JOIN tbl_category ON tbl_mp3.`cat_id`= tbl_category.`cid` 
			WHERE tbl_mp3.`status`='1' AND tbl_category.`status`='1' ORDER BY tbl_mp3.`id`";
	    
	    $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query_rec));
	    
	    $page_limit=API_LATEST_LIMIT;
	      
	    $limit=($get_method['page']-1) * $page_limit;


		$jsonObj= array();	
   
		$query="SELECT * FROM tbl_mp3
			LEFT JOIN tbl_category ON tbl_mp3.`cat_id`= tbl_category.`cid` 
			WHERE tbl_mp3.`status`='1' AND tbl_category.`status`='1' ORDER BY tbl_mp3.`id` DESC LIMIT $limit, $page_limit";

		$sql = mysqli_query($mysqli,$query);

		while($data = mysqli_fetch_assoc($sql)){
			$row['total_records'] = $total_pages['num'];

			$row['id'] = $data['id'];
			$row['cat_id'] = $data['cat_id'];
			$row['album_id'] = $data['album_id'];
			$row['mp3_type'] = $data['mp3_type'];
			$row['mp3_title'] = $data['mp3_title'];
			$row['mp3_url'] = $data['mp3_url'];
 			
			$row['mp3_thumbnail_b'] = $file_path.'images/'.$data['mp3_thumbnail'];
			$row['mp3_thumbnail_s'] = get_thumb('images/'.$data['mp3_thumbnail'],'300x300');
			 
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
			$row['category_image_thumb'] = get_thumb('images/'.$data['category_image'],'300x300');
			 
			array_push($jsonObj,$row);
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
	} 
	else if($get_method['method_name']=="cat_list"){
 		$query_rec = "SELECT COUNT(*) as num FROM tbl_category WHERE status=1";
	    
	    $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query_rec));
	    
	    $page_limit=10;
	      
	    $limit=($get_method['page']-1) * $page_limit;

 		$jsonObj= array();
		
		$cat_order=API_CAT_ORDER_BY;

		$query="SELECT cid,category_name,category_image FROM tbl_category WHERE status=1 ORDER BY tbl_category.".$cat_order." LIMIT $limit, $page_limit";
		$sql = mysqli_query($mysqli,$query);

		while($data = mysqli_fetch_assoc($sql)){ 
			$row['total_records'] = $total_pages['num'];
			$row['cid'] = $data['cid'];
			$row['category_name'] = $data['category_name'];
			$row['category_image'] = $file_path.'images/'.$data['category_image'];
			$row['category_image_thumb'] = get_thumb('images/'.$data['category_image'],'300x300');
  
			array_push($jsonObj,$row);
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
 	}
 	else if($get_method['method_name']=="cat_songs"){
		$post_order_by=API_CAT_POST_ORDER_BY;

		$cat_id=$get_method['cat_id'];

		$query_rec = "SELECT COUNT(*) as num FROM tbl_mp3
			LEFT JOIN tbl_category ON tbl_mp3.`cat_id`= tbl_category.`cid` 
			WHERE tbl_mp3.`cat_id`='$cat_id' AND tbl_category.`status`='1' AND tbl_mp3.`status`='1'";
		$total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query_rec));
		
		$page_limit=10;
			
		$limit=($get_method['page']-1) * $page_limit;
 
		$jsonObj= array();	
	
	    $query="SELECT * FROM tbl_mp3
			LEFT JOIN tbl_category ON tbl_mp3.`cat_id`= tbl_category.`cid` 
			WHERE tbl_mp3.`cat_id`='$cat_id' AND tbl_category.`status`='1' AND tbl_mp3.`status`='1' ORDER BY tbl_mp3.`id` ".$post_order_by." LIMIT $limit, $page_limit";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql)){
			$row['total_records'] = $total_pages['num'];

			$row['id'] = $data['id'];
			$row['cat_id'] = $data['cat_id'];
			$row['album_id'] = $data['album_id'];
			$row['mp3_type'] = $data['mp3_type'];
			$row['mp3_title'] = $data['mp3_title'];
			$row['mp3_url'] = $data['mp3_url'];
 			
			$row['mp3_thumbnail_b'] = $file_path.'images/'.$data['mp3_thumbnail'];
			$row['mp3_thumbnail_s'] = get_thumb('images/'.$data['mp3_thumbnail'],'300x300');
			 
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
			$row['category_image_thumb'] = get_thumb('images/'.$data['category_image'],'300x300');
			 
			array_push($jsonObj,$row);
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
	}
	
	else if($get_method['method_name']=="cat_id_by_album"){
	    
	    $cat_id=$get_method['cat_id'];
	   
	    $query_rec = "SELECT COUNT(*) as num FROM tbl_album WHERE `status`='1' AND tbl_album.cat_id='".$cat_id."' ORDER BY tbl_album.`aid` DESC";
	    
	    $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query_rec));
	    
	    $page_limit=10;
	      
	    $limit=($get_method['page']-1) * $page_limit;

 		$jsonObj= array();
		 
        $query="SELECT * FROM tbl_album WHERE status='1' AND tbl_album.cat_id='".$cat_id."'ORDER BY tbl_album.aid DESC LIMIT $limit, $page_limit";

		$sql = mysqli_query($mysqli,$query);

		while($data = mysqli_fetch_assoc($sql)){
			$row['total_records'] = $total_pages['num']; 

			$row['aid'] = $data['aid'];
 			$row['album_name'] = $data['album_name'];
			$row['album_image'] = $file_path.'images/'.$data['album_image'];
			$row['album_image_thumb'] = get_thumb('images/'.$data['album_image'],'300x300');
 
			array_push($jsonObj,$row);
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
	}
	
	 else if($get_method['method_name']=="search_text_my"){
 	    
		$jsonObj= array();	
  
		$query="SELECT * FROM tbl_mp3
		LEFT JOIN tbl_category ON tbl_mp3.cat_id= tbl_category.cid
		WHERE tbl_mp3.status='1' AND tbl_mp3.mp3_title like '%".addslashes($get_method['search_text'])."%' 
		ORDER BY tbl_mp3.mp3_title";

		$sql = mysqli_query($mysqli,$query)or die(mysqli_error());

		while($data = mysqli_fetch_assoc($sql)){
			$row['id'] = $data['id'];
			$row['cat_id'] = $data['cat_id'];
			$row['album_id'] = $data['album_id'];
			$row['mp3_type'] = $data['mp3_type'];
			$row['mp3_title'] = $data['mp3_title'];
			$row['mp3_url'] = $data['mp3_url'];
			 
			$row['mp3_thumbnail_b'] = $file_path.'images/'.$data['mp3_thumbnail'];
			$row['mp3_thumbnail_s'] = get_thumb('images/'.$data['mp3_thumbnail'],'300x300');
			
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
			$row['category_image_thumb'] = get_thumb('images/'.$data['category_image'],'300x300');

			array_push($jsonObj,$row);
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
	}
	
 	else if($get_method['method_name']=="recent_artist_list"){
 		$jsonObj= array();
		 
		$query="SELECT id,artist_name,artist_image FROM tbl_artist ORDER BY tbl_artist.`id` DESC LIMIT 10";
		$sql = mysqli_query($mysqli,$query);

		while($data = mysqli_fetch_assoc($sql)){
			 
			$row['id'] = $data['id'];
			$row['artist_name'] = $data['artist_name'];
			$row['artist_image'] = $file_path.'images/'.$data['artist_image'];
			$row['artist_image_thumb'] = get_thumb('images/'.$data['artist_image'],'300x300');
 
			array_push($jsonObj,$row);
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
 	}
	else if($get_method['method_name']=="artist_list"){
 		$query_rec = "SELECT COUNT(*) as num FROM tbl_artist ORDER BY tbl_artist.`id`";
	    
	    $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query_rec));
	    
	    $page_limit=10;
	      
	    $limit=($get_method['page']-1) * $page_limit;

 		$jsonObj= array();	

		$query="SELECT id,artist_name,artist_image FROM tbl_artist ORDER BY tbl_artist.`id` LIMIT $limit, $page_limit";
		$sql = mysqli_query($mysqli,$query);

		while($data = mysqli_fetch_assoc($sql)){
			$row['total_records'] = $total_pages['num']; 

			$row['id'] = $data['id'];
			$row['artist_name'] = $data['artist_name'];
			$row['artist_image'] = $file_path.'images/'.$data['artist_image'];
			$row['artist_image_thumb'] = get_thumb('images/'.$data['artist_image'],'300x300');
 
			array_push($jsonObj,$row);
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
 	}
 	else if($get_method['method_name']=="artist_album_list"){

 		$query_rec = "SELECT COUNT(*) as num FROM tbl_album WHERE status='1' AND FIND_IN_SET(".$get_method['artist_id'].",tbl_album.artist_ids) ORDER BY tbl_album.`aid` DESC";
	    
	    $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query_rec));
	    
	    $page_limit=10;
	      
	    $limit=($get_method['page']-1) * $page_limit;

 		$jsonObj= array();
		 
		$query="SELECT * FROM tbl_album WHERE status='1' AND FIND_IN_SET(".$get_method['artist_id'].",tbl_album.artist_ids) ORDER BY tbl_album.`aid` DESC LIMIT $limit, $page_limit";

		$sql = mysqli_query($mysqli,$query);

		while($data = mysqli_fetch_assoc($sql)){
			$row['total_records'] = $total_pages['num']; 

			$row['aid'] = $data['aid'];
			$row['artist_ids'] = $data['artist_ids'];
 			$row['album_name'] = $data['album_name'];
			$row['album_image'] = $file_path.'images/'.$data['album_image'];
			$row['album_image_thumb'] = get_thumb('images/'.$data['album_image'],'300x300');
 
			array_push($jsonObj,$row);
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
 	}
 	else if($get_method['method_name']=="artist_name_songs"){
		$post_order_by=API_CAT_POST_ORDER_BY;

		$artist_name=$get_method['artist_name'];	

		$query_rec = "SELECT COUNT(*) as num FROM tbl_mp3
			LEFT JOIN tbl_category ON tbl_mp3.`cat_id`= tbl_category.`cid`
 			WHERE FIND_IN_SET('".$artist_name."',tbl_mp3.`mp3_artist`) AND tbl_category.`status`='1' AND tbl_mp3.`status`='1'";
	    $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query_rec));
	    
	    $page_limit=10;
	      
	    $limit=($get_method['page']-1) * $page_limit;

		$jsonObj= array();	
	
	    $query="SELECT * FROM tbl_mp3
			LEFT JOIN tbl_category ON tbl_mp3.`cat_id`= tbl_category.`cid`
 			WHERE FIND_IN_SET('".$artist_name."',tbl_mp3.`mp3_artist`) AND tbl_category.`status`='1' AND tbl_mp3.`status`='1' ORDER BY tbl_mp3.`id` DESC LIMIT $limit, $page_limit";

		$sql = mysqli_query($mysqli,$query);

		while($data = mysqli_fetch_assoc($sql)){
			$row['total_records'] = $total_pages['num'];
			$row['id'] = $data['id'];
			$row['cat_id'] = $data['cat_id'];
			$row['album_id'] = $data['album_id'];
			$row['mp3_type'] = $data['mp3_type'];
			$row['mp3_title'] = $data['mp3_title'];
			$row['mp3_url'] = $data['mp3_url'];
 			
			$row['mp3_thumbnail_b'] = $file_path.'images/'.$data['mp3_thumbnail'];
			$row['mp3_thumbnail_s'] = get_thumb('images/'.$data['mp3_thumbnail'],'300x300');
			 
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
			$row['category_image_thumb'] = get_thumb('images/'.$data['category_image'],'300x300');

			array_push($jsonObj,$row);
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();

		
	}
 	else if($get_method['method_name']=="album_list"){
 		$query_rec = "SELECT COUNT(*) as num FROM tbl_album WHERE `status`='1' ORDER BY tbl_album.`aid` DESC";
	    
	    $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query_rec));
	    
	    $page_limit=10;
	      
	    $limit=($get_method['page']-1) * $page_limit;

 		$jsonObj= array();
		 
		$query="SELECT * FROM tbl_album WHERE `status`='1' ORDER BY tbl_album.`aid` DESC LIMIT $limit, $page_limit";
		$sql = mysqli_query($mysqli,$query);

		while($data = mysqli_fetch_assoc($sql)){
			$row['total_records'] = $total_pages['num']; 

			$row['aid'] = $data['aid'];
 			$row['album_name'] = $data['album_name'];
			$row['album_image'] = $file_path.'images/'.$data['album_image'];
			$row['album_image_thumb'] = get_thumb('images/'.$data['album_image'],'300x300');
 
			array_push($jsonObj,$row);
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
 	}
 	else if($get_method['method_name']=="album_songs"){
		$post_order_by=API_CAT_POST_ORDER_BY;

		$album_id=$get_method['album_id'];

		$query_rec = "SELECT COUNT(*) as num FROM tbl_mp3
			LEFT JOIN tbl_category ON tbl_mp3.`cat_id`= tbl_category.`cid`
			LEFT JOIN tbl_album ON tbl_mp3.`album_id`= tbl_album.`aid` 
			WHERE tbl_mp3.`album_id`='$album_id' AND tbl_category.`status`='1' AND tbl_album.`status`='1' AND tbl_mp3.`status`='1'";
	    $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query_rec));
	    
	    $page_limit=10;
	      
	    $limit=($get_method['page']-1) * $page_limit;


		$jsonObj= array();	
	
	    $query="SELECT * FROM tbl_mp3
			LEFT JOIN tbl_category ON tbl_mp3.`cat_id`= tbl_category.`cid`
			LEFT JOIN tbl_album ON tbl_mp3.`album_id`= tbl_album.`aid` 
			WHERE tbl_mp3.`album_id`='$album_id' AND tbl_category.`status`='1' AND tbl_album.`status`='1' AND tbl_mp3.`status`='1' ORDER BY tbl_mp3.`id` ".$post_order_by." LIMIT $limit, $page_limit";

		$sql = mysqli_query($mysqli,$query);

		while($data = mysqli_fetch_assoc($sql)){
			$row['total_records'] = $total_pages['num'];
			$row['id'] = $data['id'];
			$row['cat_id'] = $data['cat_id'];
			$row['album_id'] = $data['album_id'];
			$row['mp3_type'] = $data['mp3_type'];
			$row['mp3_title'] = $data['mp3_title'];
			$row['mp3_url'] = $data['mp3_url'];
 			
			$row['mp3_thumbnail_b'] = $file_path.'images/'.$data['mp3_thumbnail'];
			$row['mp3_thumbnail_s'] = get_thumb('images/'.$data['mp3_thumbnail'],'300x300');
			 
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
			$row['category_image_thumb'] = get_thumb('images/'.$data['category_image'],'300x300');
			
			$row['aid'] = $data['aid'];
 			$row['album_name'] = $data['album_name'];
			$row['album_image'] = $file_path.'images/'.$data['album_image'];
			$row['album_image_thumb'] = get_thumb('images/'.$data['album_image'],'300x300');

			array_push($jsonObj,$row);
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
	}
	else if($get_method['method_name']=="playlist"){
 		$query_rec = "SELECT COUNT(*) as num FROM tbl_playlist WHERE status='1' ORDER BY tbl_playlist.`pid` DESC";
	    
	    $total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query_rec));
	    
	    $page_limit=10;
	      
	    $limit=($get_method['page']-1) * $page_limit;

 		$jsonObj= array();
		 
		$query="SELECT * FROM tbl_playlist WHERE status='1' ORDER BY tbl_playlist.`pid` DESC LIMIT $limit, $page_limit";
		$sql = mysqli_query($mysqli,$query);

		while($data = mysqli_fetch_assoc($sql)){
			 
			$row['total_records'] = $total_pages['num'];

			$row['pid'] = $data['pid'];
 			$row['playlist_name'] = $data['playlist_name'];
			$row['playlist_image'] = $file_path.'images/'.$data['playlist_image'];
			$row['playlist_image_thumb'] = get_thumb('images/'.$data['playlist_image'],'300x300');
 
			array_push($jsonObj,$row);
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
 	}
 	else if($get_method['method_name']=="playlist_songs"){
		$post_order_by=API_CAT_POST_ORDER_BY;

		$playlist_id=$get_method['playlist_id'];	

		$jsonObj= array();	
	
	    $query="SELECT * FROM tbl_playlist
  		where tbl_playlist.`status`='1' AND pid='".$playlist_id."'";

		$sql = mysqli_query($mysqli,$query);

		while($data = mysqli_fetch_assoc($sql)){
			 
			$row['pid'] = $data['pid'];
 			$row['playlist_name'] = $data['playlist_name'];
			$row['playlist_image'] = $file_path.'images/'.$data['playlist_image'];
			$row['playlist_image_thumb'] = get_thumb('images/'.$data['playlist_image'],'300x300'); 

			$songs_list=explode(",", $data['playlist_songs']);

			$total_records=count($songs_list);

			foreach($songs_list as $song_id){
            	$page_limit=10;
      
    			$limit=($get_method['page']-1) * $page_limit;

            	$query1="SELECT * FROM tbl_mp3
					LEFT JOIN tbl_category ON tbl_mp3.`cat_id`= tbl_category.`cid` 
					WHERE tbl_mp3.`id`='$song_id' AND tbl_category.`status`='1' AND tbl_mp3.`status`='1' LIMIT $limit, $page_limit";

				$sql1 = mysqli_query($mysqli,$query1);

				while($data1 = mysqli_fetch_assoc($sql1)){
					$row1['total_records'] = "$total_records";

					$row1['id'] = $data1['id'];
					$row1['cat_id'] = $data1['cat_id'];
					$row1['album_id'] = $data1['album_id'];
					$row1['mp3_type'] = $data1['mp3_type'];
					$row1['mp3_title'] = $data1['mp3_title'];
					$row1['mp3_url'] = $data1['mp3_url'];
		 			
					$row1['mp3_thumbnail_b'] = $file_path.'images/'.$data1['mp3_thumbnail'];
					$row1['mp3_thumbnail_s'] = get_thumb('images/'.$data1['mp3_thumbnail'],'300x300');
					 
					$row1['mp3_duration'] = $data1['mp3_duration'];
					$row1['mp3_artist'] = $data1['mp3_artist'];
					$row1['mp3_description'] = $data1['mp3_description'];
					$row1['total_rate'] = $data1['total_rate'];
					$row1['rate_avg'] = $data1['rate_avg'];
					$row1['total_views'] = $data1['total_views'];
					$row1['total_download'] = $data1['total_download'];

					$row1['cid'] = $data1['cid'];
					$row1['category_name'] = $data1['category_name'];
					$row1['category_image'] = $file_path.'images/'.$data1['category_image'];
					$row1['category_image_thumb'] = get_thumb('images/'.$data1['category_image'],'300x300');
					 
					$row['songs_list'][]=$row1;
				}
            }

			array_push($jsonObj,$row);
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
	}
	else if($get_method['method_name']=="single_song"){	
		$jsonObj= array();	
 
		$query="SELECT * FROM tbl_mp3
			LEFT JOIN tbl_category ON tbl_mp3.`cat_id`= tbl_category.`cid` 
			WHERE tbl_mp3.`id`='".$get_method['song_id']."' AND tbl_category.`status`='1' AND tbl_mp3.status='1'";

		$sql = mysqli_query($mysqli,$query);

		while($data = mysqli_fetch_assoc($sql)){
			$row['id'] = $data['id'];
			$row['cat_id'] = $data['cat_id'];
			$row['album_id'] = $data['album_id'];
			$row['mp3_type'] = $data['mp3_type'];
			$row['mp3_title'] = $data['mp3_title'];
			$row['mp3_url'] = $data['mp3_url'];
			 
			$row['mp3_thumbnail_b'] = $file_path.'images/'.$data['mp3_thumbnail'];
			$row['mp3_thumbnail_s'] = get_thumb('images/'.$data['mp3_thumbnail'],'300x300');
			 
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
			$row['category_image_thumb'] = get_thumb('images/'.$data['category_image'],'300x300');
			 
			if($get_method['device_id']){
				$query1 = mysqli_query($mysqli,"select * from tbl_rating where post_id  = '".$get_method['song_id']."' && ip = '".$get_method['device_id']."' ");
				$data1 = mysqli_fetch_assoc($query1);

				if(@count($data1) != 0 ){
					$row['user_rate'] = $data1['rate'];
				}else{
					$row['user_rate'] = 0;
				}
			}
			 
			array_push($jsonObj,$row);
		}
 		
 		$view_qry=mysqli_query($mysqli,"UPDATE tbl_mp3 SET total_views = total_views + 1 WHERE id = '".$get_method['song_id']."'");

 		$mp3_id= $get_method['song_id'];  
    	$date = date('Y-m-d');   
      
      	$start = (date('D') != 'Mon') ? date('Y-m-d', strtotime('last Monday')) : date('Y-m-d'); 
      	$finish = (date('D') != 'Sat') ? date('Y-m-d', strtotime('next Saturday')) : date('Y-m-d');
 
	    $query="SELECT * FROM tbl_mp3_views WHERE mp3_id='$mp3_id' and date BETWEEN '$start' AND '$finish'";
	    $sql = mysqli_query($mysqli,$query);  


	    if(mysqli_num_rows($sql)>0){
	      $query1 = "UPDATE tbl_mp3_views SET views=views+1 WHERE mp3_id='$mp3_id' and date BETWEEN '$start' AND '$finish'";
	      $sql1 = mysqli_query($mysqli,$query1);
	    } else{
	      $data = array( 
	          'mp3_id'  =>  $mp3_id,
	          'views'  =>  1,
	          'date'  =>  $date
	          );    
	 
	      $qry = Insert('tbl_mp3_views',$data);
	    }

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();	
	}	 		
	else if($get_method['method_name']=="song_download"){
		$jsonObj= array();	
		
		$view_qry=mysqli_query($mysqli,"UPDATE tbl_mp3 SET total_download = total_download + 1 WHERE id = '".$get_method['song_id']."'");
 	 
    	$total_dw_sql="SELECT * FROM tbl_mp3 WHERE id='".$get_method['song_id']."'";
	    $total_dw_res=mysqli_query($mysqli,$total_dw_sql);
	    $total_dw_row=mysqli_fetch_assoc($total_dw_res);
	    
        $jsonObj = array( 'total_download' => $total_dw_row['total_download']);

        $set['nemosofts'][] = $jsonObj;
        header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
	}	
	else if($get_method['method_name']=="song_search"){

		if($get_method['search_type']=="songs"){
                
                $query_rec = "SELECT COUNT(*) as num FROM tbl_mp3
					LEFT JOIN tbl_category ON tbl_mp3.`cat_id`= tbl_category.`cid`
					WHERE tbl_mp3.`status`='1' AND tbl_category.`status`='1' AND tbl_mp3.`mp3_title` like '%".addslashes($get_method['search_text'])."%' 
				ORDER BY tbl_mp3.mp3_title";

        		$total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query_rec));
        		
        		$page_limit=10;
        			
        		$limit=($get_method['page']-1) * $page_limit;
                
		    	$jsonObj0= array();	
		   
				$query0="SELECT * FROM tbl_mp3
					LEFT JOIN tbl_category ON tbl_mp3.`cat_id`= tbl_category.`cid`
					WHERE tbl_mp3.`status`='1' AND tbl_category.`status`='1' AND tbl_mp3.`mp3_title` like '%".addslashes($get_method['search_text'])."%' 
				ORDER BY tbl_mp3.mp3_title LIMIT $limit, $page_limit";

				$sql0 = mysqli_query($mysqli,$query0)or die(mysqli_error());

				while($data0 = mysqli_fetch_assoc($sql0)){
				    $row0['total_data'] = $total_pages['num'];
					$row0['id'] = $data0['id'];
					$row0['cat_id'] = $data0['cat_id'];
					$row0['album_id'] = $data0['album_id'];
					$row0['mp3_type'] = $data0['mp3_type'];
					$row0['mp3_title'] = $data0['mp3_title'];
					$row0['mp3_url'] = $data0['mp3_url'];
		 			
					 
					$row0['mp3_thumbnail_b'] = $file_path.'images/'.$data0['mp3_thumbnail'];
					$row0['mp3_thumbnail_s'] = get_thumb('images/'.$data0['mp3_thumbnail'],'300x300');
					 
					$row0['mp3_duration'] = $data0['mp3_duration'];
					$row0['mp3_artist'] = $data0['mp3_artist'];
					$row0['mp3_description'] = $data0['mp3_description'];
					$row0['total_rate'] = $data0['total_rate'];
					$row0['rate_avg'] = $data0['rate_avg'];
					$row0['total_views'] = $data0['total_views'];
					$row0['total_download'] = $data0['total_download'];

					$row0['cid'] = $data0['cid'];
					$row0['category_name'] = $data0['category_name'];
					$row0['category_image'] = $file_path.'images/'.$data0['category_image'];
					$row0['category_image_thumb'] = get_thumb('images/'.$data0['category_image'],'300x300');			 

					array_push($jsonObj0,$row0);
				
				}
		 
				$set['nemosofts'] = $jsonObj0;
		}
		else if($get_method['search_type']=="artist"){
            
               $query_rec = "SELECT COUNT(*) as num FROM tbl_artist
					WHERE tbl_artist.`artist_name` like '%".addslashes($get_method['search_text'])."%' 
				ORDER BY tbl_artist.artist_name";
        		$total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query_rec));
        		
        		$page_limit=10;
        			
        		$limit=($get_method['page']-1) * $page_limit;    
                
			   $jsonObj2= array();	
		   
				$query2="SELECT * FROM tbl_artist
					WHERE tbl_artist.`artist_name` like '%".addslashes($get_method['search_text'])."%' 
				ORDER BY tbl_artist.artist_name LIMIT $limit, $page_limit";

				$sql2 = mysqli_query($mysqli,$query2)or die(mysqli_error());

				while($data2 = mysqli_fetch_assoc($sql2)){
				    $row2['total_data'] = $total_pages['num'];
					$row2['id'] = $data2['id'];
					$row2['artist_name'] = $data2['artist_name'];
					$row2['artist_image'] = $file_path.'images/'.$data2['artist_image'];
					$row2['artist_image_thumb'] = get_thumb('images/'.$data2['artist_image'],'300x300');		

					array_push($jsonObj2,$row2);
				}
		 
				$set['nemosofts'] = $jsonObj2;
		}
		else if($get_method['search_type']=="album"){
                $query_rec = "SELECT COUNT(*) as num FROM tbl_album
					WHERE tbl_album.`album_name` AND tbl_album.`status`='1' like '%".addslashes($get_method['search_text'])."%' 
				ORDER BY tbl_album.album_name";
        		$total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query_rec));
        		
        		$page_limit=10;
        			
        		$limit=($get_method['page']-1) * $page_limit;
                
			    $jsonObj1= array();	
		        
				$query1="SELECT * FROM tbl_album
					WHERE tbl_album.`album_name` like '%".addslashes($get_method['search_text'])."%' AND tbl_album.`status`='1'
					ORDER BY tbl_album.album_name LIMIT $limit, $page_limit";

				$sql1 = mysqli_query($mysqli,$query1)or die(mysqli_error());

				while($data1 = mysqli_fetch_assoc($sql1)){
				    $row1['total_data'] = $total_pages['num'];
					$row1['aid'] = $data1['aid'];
					$row1['artist_ids'] = $data1['artist_ids']?$data1['artist_ids']:'';
					$row1['album_name'] = $data1['album_name'];
					$row1['album_image'] = $file_path.'images/'.$data1['album_image'];
					$row1['album_image_thumb'] = get_thumb('images/'.$data1['album_image'],'300x300');		

					array_push($jsonObj1,$row1);
				
				}
		 
				$set['nemosofts'] = $jsonObj1;
		}else{       
		        $query_rec = "SELECT COUNT(*) as num FROM tbl_mp3
					LEFT JOIN tbl_category ON tbl_mp3.`cat_id`= tbl_category.`cid`
					WHERE tbl_mp3.`status`='1' AND tbl_category.`status`='1' AND tbl_mp3.`mp3_title` like '%".addslashes($get_method['search_text'])."%' 
					ORDER BY tbl_mp3.mp3_title";
        		$total_pages = mysqli_fetch_array(mysqli_query($mysqli,$query_rec));
        		
        		$page_limit=10;
        			
        		$limit=($get_method['page']-1) * $page_limit;
			    
			    $jsonObj0= array();	
		   
				$query0="SELECT * FROM tbl_mp3
					LEFT JOIN tbl_category ON tbl_mp3.`cat_id`= tbl_category.`cid`
					WHERE tbl_mp3.`status`='1' AND tbl_category.`status`='1' AND tbl_mp3.`mp3_title` like '%".addslashes($get_method['search_text'])."%' 
				ORDER BY tbl_mp3.mp3_title LIMIT $limit, $page_limit";

				$sql0 = mysqli_query($mysqli,$query0)or die(mysqli_error());

				while($data0 = mysqli_fetch_assoc($sql0)){
				    $row0['total_data'] = $total_pages['num'];
					$row0['id'] = $data0['id'];
					$row0['cat_id'] = $data0['cat_id'];
					$row0['album_id'] = $data0['album_id'];
					$row0['mp3_type'] = $data0['mp3_type'];
					$row0['mp3_title'] = $data0['mp3_title'];
					$row0['mp3_url'] = $data0['mp3_url'];
		 			
					$row0['mp3_thumbnail_b'] = $file_path.'images/'.$data0['mp3_thumbnail'];
					$row0['mp3_thumbnail_s'] = get_thumb('images/'.$data0['mp3_thumbnail'],'300x300');
					 
					$row0['mp3_duration'] = $data0['mp3_duration'];
					$row0['mp3_artist'] = $data0['mp3_artist'];
					$row0['mp3_description'] = $data0['mp3_description'];
					$row0['total_rate'] = $data0['total_rate'];
					$row0['rate_avg'] = $data0['rate_avg'];
					$row0['total_views'] = $data0['total_views'];
					$row0['total_download'] = $data0['total_download'];

					$row0['cid'] = $data0['cid'];
					$row0['category_name'] = $data0['category_name'];
					$row0['category_image'] = $file_path.'images/'.$data0['category_image'];
					$row0['category_image_thumb'] = get_thumb('images/'.$data0['category_image'],'300x300');		 

					array_push($jsonObj0,$row0);
				
				}

				$row['search_songs']=$jsonObj0;

				$jsonObj1= array();	
		   
				$query1="SELECT * FROM tbl_album
					WHERE tbl_album.`status`='1' AND tbl_album.`album_name` like '%".addslashes($get_method['search_text'])."%' 
				ORDER BY tbl_album.album_name LIMIT 20";

				$sql1 = mysqli_query($mysqli,$query1)or die(mysqli_error());

				while($data1 = mysqli_fetch_assoc($sql1)){
					$row1['aid'] = $data1['aid'];
					$row1['artist_ids'] = $data1['artist_ids']?$data1['artist_ids']:'';
					$row1['album_name'] = $data1['album_name'];
					$row1['album_image'] = $file_path.'images/'.$data1['album_image'];
					$row1['album_image_thumb'] = get_thumb('images/'.$data1['album_image'],'300x300');

					array_push($jsonObj1,$row1);
				}

				$row['search_album']=$jsonObj1;

				$jsonObj2= array();	
		   
				$query2="SELECT * FROM tbl_artist
					WHERE tbl_artist.artist_name like '%".addslashes($get_method['search_text'])."%' 
					ORDER BY tbl_artist.artist_name LIMIT 20";

				$sql2 = mysqli_query($mysqli,$query2)or die(mysqli_error());

				while($data2 = mysqli_fetch_assoc($sql2))
				{
					$row2['id'] = $data2['id'];
					$row2['artist_name'] = $data2['artist_name'];
					$row2['artist_image'] = $file_path.'images/'.$data2['artist_image'];
					$row2['artist_image_thumb'] =  get_thumb('images/'.$data2['artist_image'],'300x300');

					array_push($jsonObj2,$row2);
				
				}

				$row['search_artist']=$jsonObj2;

				$set['nemosofts'] = $row;
		}
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();

	}
	else if($get_method['method_name']=="song_rating"){
		$ip = $get_method['device_id'];
		$post_id = $get_method['post_id'];
		$therate = $get_method['rate'];

		$query1 = mysqli_query($mysqli,"select * from tbl_rating where post_id  = '$post_id' && ip = '$ip' "); 
		while($data1 = mysqli_fetch_assoc($query1)){
		$rate_db1[] = $data1;
		}
		if(@count($rate_db1) == 0 ){

			$data = array(            
			  'post_id'  =>$post_id,
			  'rate'  =>  $therate,
			   'ip'  => $ip,
			   );  
			$qry = Insert('tbl_rating',$data); 

			//Total rate result

			$query = mysqli_query($mysqli,"select * from tbl_rating where post_id  = '$post_id' ");
			   
			while($data = mysqli_fetch_assoc($query)){
			        $rate_db[] = $data;
			        $sum_rates[] = $data['rate'];
			   
			}
			    if(@count($rate_db)){
			        $rate_times = count($rate_db);
			        $sum_rates = array_sum($sum_rates);
			        $rate_value = $sum_rates/$rate_times;
			        $rate_bg = (($rate_value)/5)*100;
			    }else{
			        $rate_times = 0;
			        $rate_value = 0;
			        $rate_bg = 0;
			    }

			$rate_avg=round($rate_value); 

			$sql="update tbl_mp3 set total_rate=total_rate + 1,rate_avg='$rate_avg' where id='".$post_id."'";

			mysqli_query($mysqli,$sql);

			$total_rat_sql="SELECT * FROM tbl_mp3 WHERE id='".$post_id."'";
			$total_rat_res=mysqli_query($mysqli,$total_rat_sql);
			$total_rat_row=mysqli_fetch_assoc($total_rat_res);

			$set['nemosofts'][] = array('total_rate' => $total_rat_row['total_rate'],'rate_avg' => $total_rat_row['rate_avg'],'msg' => $app_lang['rate_success'],'success'=>'1');

		}else{

			$set['nemosofts'][] = array('msg' => $app_lang['rate_already'],'success'=>'0');

		}

		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();

	}	

  else if($get_method['method_name']=="user_register"){	
  		if($get_method['name']!='' AND $get_method['email']!='' AND $get_method['password']!=''){

			$qry = "SELECT * FROM tbl_users WHERE email = '".$get_method['email']."'"; 
			$result = mysqli_query($mysqli,$qry);
			$row = mysqli_fetch_assoc($result);
			
			if($row['email']!=""){
				$set['nemosofts'][]=array('msg' => $app_lang['email_exist'],'success'=>'0');
			}else{ 
	 			$qry1="INSERT INTO tbl_users (`name`,`email`,`password`,`phone`,`status`) VALUES ('".$get_method['name']."','".$get_method['email']."','".$get_method['password']."','".$get_method['phone']."','1')"; 
	            $result1=mysqli_query($mysqli,$qry1);  										 
				$set['nemosofts'][]=array('msg' => $app_lang['register_success'],'success'=>'1');
			}
		}

		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
  }
  else if($get_method['method_name']=="user_login"){

  		$email = $get_method['email'];
		$password = $get_method['password'];

		$qry = "SELECT * FROM tbl_users WHERE email = '".$email."' and password = '".$password."'"; 
		$result = mysqli_query($mysqli,$qry);
		$num_rows = mysqli_num_rows($result);
		$row = mysqli_fetch_assoc($result);
		
    	if ($num_rows > 0){ 
			$set['nemosofts'][]=array('user_id' => $row['id'],'name'=>$row['name'],'success'=>'1','msg' =>$app_lang['login_success']); 
		}else{
			$set['nemosofts'][]=array('msg' =>$app_lang['login_fail'],'success'=>'0');	 
		}

		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();

  }
  else if($get_method['method_name']=="user_profile"){
  		$qry = "SELECT * FROM tbl_users WHERE id = '".$get_method['user_id']."'"; 
		$result = mysqli_query($mysqli,$qry);
		 
		$row = mysqli_fetch_assoc($result);
	  				 
	    $set['nemosofts'][]=array('user_id' => $row['id'],'name'=>$row['name'],'email'=>$row['email'],'phone'=>$row['phone'],'success'=>'1');

	    header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
  }
  else if($get_method['method_name']=="user_profile_update"){
  		if($get_method['password']!=""){
			$user_edit= "UPDATE tbl_users SET name='".$get_method['name']."',email='".$get_method['email']."',password='".$get_method['password']."',phone='".$get_method['phone']."' WHERE id = '".$get_method['user_id']."'";	 
		}else{
			$user_edit= "UPDATE tbl_users SET name='".$get_method['name']."',email='".$get_method['email']."',phone='".$get_method['phone']."' WHERE id = '".$get_method['user_id']."'";	 
		}
   		
   		$user_res = mysqli_query($mysqli,$user_edit);
 		 
		$set['nemosofts'][]=array('msg'=>$app_lang['update_success'],'success'=>'1');

  		 header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();
  }
  	 
    else if($get_method['method_name']=="app_details"){
		$jsonObj= array();	

		$query="SELECT * FROM tbl_settings WHERE id='1'";
		$sql = mysqli_query($mysqli,$query);

		while($data = mysqli_fetch_assoc($sql)){
			$row['package_name'] = $data['package_name'];	 
			$row['app_name'] = $data['app_name'];
			$row['app_logo'] = $data['app_logo'];
			$row['app_version'] = $data['app_version'];
			$row['app_author'] = $data['app_author'];
			$row['app_contact'] = $data['app_contact'];
			$row['app_email'] = $data['app_email'];
			$row['app_website'] = $data['app_website'];
			$row['app_description'] = stripslashes($data['app_description']);
 			$row['app_developed_by'] = $data['app_developed_by'];
			$row['app_privacy_policy'] = stripslashes($data['app_privacy_policy']);

			$row['publisher_id'] = $data['publisher_id'];
			$row['interstital_ad'] = $data['interstital_ad'];
			$row['interstital_ad_id'] = $data['interstital_ad_id'];
			$row['interstital_ad_click'] = $data['interstital_ad_click'];
 			$row['banner_ad'] = $data['banner_ad'];
 			$row['banner_ad_id'] = $data['banner_ad_id'];
 			
 			$row['facebook_interstital_ad'] = $data['facebook_interstital_ad'];
            $row['facebook_interstital_ad_id'] = $data['facebook_interstital_ad_id'];
		    $row['facebook_interstital_ad_click'] = $data['facebook_interstital_ad_click'];		
		    $row['facebook_banner_ad'] = $data['facebook_banner_ad'];
		    $row['facebook_banner_ad_id'] = $data['facebook_banner_ad_id'];
 			
            $row['purchase_code'] = $data['purchase_code'];
        	$row['nemosofts_key'] = $data['nemosofts_key'];
        	
        	$row['in_app'] = $data['in_app'];
        	$row['subscription_id'] = $data['subscription_id'];
        	$row['merchant_key'] = $data['merchant_key'];
        	$row['subscription_days'] = $data['subscription_days'];

			array_push($jsonObj,$row);
		}

		$set['nemosofts'] = $jsonObj;
		
		header( 'Content-Type: application/json; charset=utf-8' );
	    echo $val= str_replace('\\/', '/', json_encode($set,JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
		die();	
	}	
	else{
		$get_method = checkSignSalt($_POST['data']);
	}	
	 
	 
?>