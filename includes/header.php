<?php include("includes/connection.php");
      include("includes/session_check.php");
      
      //Get file name
      $currentFile = $_SERVER["SCRIPT_NAME"];
      $parts = Explode('/', $currentFile);
      $currentFile = $parts[count($parts) - 1];        
?>
<!DOCTYPE html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta name="author" content="">
<meta name="description" content="">

<meta name="viewport"content="width=device-width, initial-scale=1.0">
<link rel="icon" href="images/<?php echo APP_LOGO;?>" sizes="32x32">
<link rel="icon" href="images/<?php echo APP_LOGO;?>" sizes="192x192">
<link rel="apple-touch-icon-precomposed" href="images/<?php echo APP_LOGO;?>">
<meta name="msapplication-TileImage" content="images/<?php echo APP_LOGO;?>">
<title><?php echo APP_NAME;?></title>
<link rel="stylesheet" type="text/css" href="assets/css/nemosofts2.css">
<link rel="stylesheet" type="text/css" href="assets/css/home.css">

<script src="assets/ckeditor/ckeditor.js"></script>

<style type="text/css">
  .btn_edit, .btn_delete{
    padding: 5px 10px !important;
  }
</style>


<?php if(DARK!="0"){?>
<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min13.css">
<Style>
label {
color: #fff;
}   
.form-control {;
    line-height: 1.42857143;
    color: #f8f9fa;
    background-color: #151515;
    border: 1px solid #333;
}
    .rad-info-box {
        margin-bottom: 16px;
        padding: 20px;
        background: #262626;
        border: 1px solid #252525;
        border-radius: 10px;
    }                
    .table-hover > tbody > tr:hover {
        background-color: #171717;
    }
    .table-bordered > tbody > tr > td, .table-bordered > tfoot > tr > td {
        border: 1px solid #171717;
    }
    .nav-tabs {
        border-bottom: 1px solid #000;
    }
    .hljs {
        color: #ffffff;
        background: #262626;
        display: block;
        overflow-x: auto;
        padding: 0.5em;
    }
    .pagination > li > a, .pagination > li > span {
        color: #333;
        border-radius: 2px;
        border-color: #171717;
        box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);
        margin-left: 2px;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
    border: 1px solid #1782df6e;
    background-color: #151515;
    outline: 0;
}
.select2-container--default .select2-selection--multiple {
    border-radius: 4px;
    border: 1px solid #1782df6e;
    background-color: #151515;
    cursor: text;
}
.progress {
    height: 20px;
    margin-bottom: 20px;
    overflow: hidden;
    background-color: #171717;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
    box-shadow: inset 0 1px 2px rgba(0, 0, 0, .1);
}
</Style>

<?php }else{?>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <Style>
    .rad-info-box{
      margin-bottom:16px;
      padding:20px;
      background: #fff;
      border: 1px solid #dadce0;
      border-radius: 10px;
    }
  </Style>
<?php }?>

<Style>
    .checkbox, .radio {
	position: relative;
	margin-top: 10px;
	margin-bottom: 10px;
}
.checkbox label, .radio label {
	padding-left: 30px;
}
.checkbox label:before, .checkbox label:after, .radio label:before, .radio label:after {
	border-radius: 10px;
}
.checkbox label:before, .radio label:before {
	border: 1px solid #fff;
}
.checkbox label:after, .radio label:after {
	border-radius: 10px;
}
</Style>

</head>
<body>
<div class="app app-default">
  <aside class="app-sidebar" id="sidebar">
    <div class="sidebar-header"> <a class="sidebar-brand" href="home.php"><img src="images/<?php echo APP_LOGO;?>" alt="app logo" /></a>
      <button type="button" class="sidebar-toggle"> <i class="fa fa-times"></i> </button>
    </div>
    <div class="sidebar-menu">
      <ul class="sidebar-nav">
        <li <?php if($currentFile=="home.php"){?>class="active"<?php }?>> <a href="home.php">
          <div class="icon"> <i class="fa fa-dashboard" aria-hidden="true"></i> </div>
          <div class="title">Dashboard</div>
          </a> 
        </li>
        <li <?php if($currentFile=="manage_category.php" or $currentFile=="add_category.php"){?>class="active"<?php }?>> <a href="manage_category.php">
          <div class="icon"> <i class="fa fa-sitemap" aria-hidden="true"></i> </div>
          <div class="title">Categories</div>
          </a> 
        </li>
        <li <?php if($currentFile=="manage_artist.php" or $currentFile=="add_artist.php"){?>class="active"<?php }?>> <a href="manage_artist.php">
          <div class="icon"> <i class="fa fa-buysellads" aria-hidden="true"></i> </div>
          <div class="title">Artist</div>
          </a> 
        </li>
        <li <?php if($currentFile=="manage_album.php" or $currentFile=="add_album.php"){?>class="active"<?php }?>> <a href="manage_album.php">
          <div class="icon"> <i class="fa fa-image" aria-hidden="true"></i> </div>
          <div class="title">Album</div>
          </a> 
        </li>

        <li <?php if($currentFile=="manage_mp3.php" or $currentFile=="add_mp3.php" or $currentFile=="edit_mp3.php"){?>class="active"<?php }?>> <a href="manage_mp3.php">
          <div class="icon"> <i class="fa fa-music" aria-hidden="true"></i> </div>
          <div class="title">Mp3 Songs</div>
          </a> 
        </li>


        <li <?php if($currentFile=="manage_playlist.php" or $currentFile=="add_playlist.php"){?>class="active"<?php }?>> <a href="manage_playlist.php">
          <div class="icon"> <i class="fa fa-list" aria-hidden="true"></i> </div>
          <div class="title">Playlist</div>
          </a> 
        </li>

        <li <?php if($currentFile=="manage_banners.php" or $currentFile=="add_banner.php"){?>class="active"<?php }?>> <a href="manage_banners.php">
          <div class="icon"> <i class="fa fa-sliders" aria-hidden="true"></i> </div>
          <div class="title">Home Banners</div>
          </a> 
        </li>

        <li <?php if($currentFile=="manage_users.php" or $currentFile=="add_user.php"){?>class="active"<?php }?>> <a href="manage_users.php">
          <div class="icon"> <i class="fa fa-users" aria-hidden="true"></i> </div>
          <div class="title">Users</div>
          </a> 
        </li>

        
        <li <?php if($currentFile=="send_notification.php"){?>class="active"<?php }?>> <a href="send_notification.php">
          <div class="icon"> <i class="fa fa-bell" aria-hidden="true"></i> </div>
          <div class="title">Notification</div>
          </a> 
        </li>
       
        <li <?php if($currentFile=="settings.php"){?>class="active"<?php }?>> <a href="settings.php">
          <div class="icon"> <i class="fa fa-wrench" aria-hidden="true"></i> </div>
          <div class="title">Settings</div>
          </a> 
        </li>

         <?php if(file_exists('speed_api.php')){?>
          <li <?php if($currentFile=="api_urls.php"){?>class="active"<?php }?>> 
            <a href="api_urls.php">
              <div class="icon"> <i class="fa fa-exchange" aria-hidden="true"></i> </div>
              <div class="title">API URLS</div>
            </a> 
          </li> 
        <?php }?>
 
      </ul>
    </div>
     
  </aside>   
  <div class="app-container">
    <nav class="navbar navbar-default" id="navbar">
      <div class="container-fluid">
        <div class="navbar-collapse collapse in">
          <ul class="nav navbar-nav navbar-mobile">
            <li>
              <button type="button" class="sidebar-toggle"> <i class="fa fa-bars"></i> </button>
            </li>
            <li class="logo"> <a class="navbar-brand" href="#"><?php echo APP_NAME;?></a> </li>
            <li>
              <button type="button" class="navbar-toggle">
                   <?php if(PROFILE_IMG){?>               
                  <img class="profile-img" src="images/<?php echo PROFILE_IMG;?>">
                <?php }else{?>
                  <img class="profile-img" src="assets/images/profile.jpg">
                <?php }?>
              </button>
            </li>
          </ul>
          <ul class="nav navbar-nav navbar-left">
             
              <Style>
                  titel, .titel {
                    font-size: 25px;
                    text-align: center;
                    color: #1782de;
                     font-weight: 600;}
              </Style>
              
              
              <titel><?php echo APP_NAME;?></titel>
             
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown profile"> <a href="profile.php" class="dropdown-toggle" data-toggle="dropdown">
               <?php if(PROFILE_IMG){?>               
                  <img class="profile-img" src="images/<?php echo PROFILE_IMG;?>">
                <?php }else{?>
                  <img class="profile-img" src="assets/images/profile.jpg">
                <?php }?>
              <div class="title">Profile</div>
              </a>
              <div class="dropdown-menu">
                <ul class="action">
                  <li><a href="profile.php">Profile</a></li>                  
                  <li><a href="logout.php">Logout</a></li>
                </ul>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </nav>