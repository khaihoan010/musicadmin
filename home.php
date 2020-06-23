<?php include("includes/header.php");
 	include("check/home.php");
?>       

<div class="row">
    
    <div class="col-lg-3 col-xs-6">
        <div class="rad-info-box my rad-txt-success">
            <i class="icon fa fa-sitemap"></i>
            <span class="heading">Categories</span>
            <span class="value"><span data-purecounter-duration="1.0" data-purecounter-end="<?php echo $total_category;?>"class="purecounter">0</span></span>
        </div>
    </div>
    
    <div class="col-lg-3 col-xs-6">
        <div class="rad-info-box my rad-txt-violet">
            <i class="fa fa-buysellads"></i>
            <span class="heading">Artist</span>
            <span class="value"><span data-purecounter-duration="1.5" data-purecounter-end="<?php echo $total_artist;?>"class="purecounter">0</span></span>
        </div>
    </div>
    
    <div class="col-lg-3 my col-xs-6">
        <div class="rad-info-box rad-txt-banner">
            <i class="icon fa fa-image"></i>
            <span class="heading">Album</span>
            <span class="value"><span data-purecounter-duration="1.0" data-purecounter-end="<?php echo $total_album;?>"class="purecounter">0</span></span>
        </div>
    </div>
    
    <div class="col-lg-3 my col-xs-6">
        <div class="rad-info-box my rad-txt-success">
            <i class="icon fa fa-music"></i>
            <span class="heading">Mp3 Songs</span>
            <span class="value"><span data-purecounter-duration="1.0" data-purecounter-end="<?php echo $total_mp3;?>"class="purecounter">0</span></span>
        </div>
    </div>
    
    <div class="col-lg-3 my col-xs-6">
        <div class="rad-info-box rad-txt-danger">
            <i class="icon fa fa-sliders"></i>
            <span class="heading">Banners</span>
            <span class="value"><span data-purecounter-duration="1.0" data-purecounter-end="<?php echo $total_banner;?>"class="purecounter">0</span></span>
        </div>
    </div>
    
    <div class="col-lg-3 col-xs-6">
        <div class="rad-info-box my rad-txt-playlist">
            <i class="icon fa fa-list"></i>
            <span class="heading">Playlist</span>
            <span class="value"><span data-purecounter-duration="1.0" data-purecounter-end="<?php echo $total_playlist;?>"class="purecounter">0</span></span>
        </div>
    </div>
    
    <div class="col-lg-3 col-xs-6">
        <div class="rad-info-box my rad-txt-primary">
            <i class="fa fa-users"></i>
            <span class="heading">Users</span>
            <span class="value"><span data-purecounter-duration="1.0" data-purecounter-end="<?php echo $total_users;?>"class="purecounter">0</span></span>
        </div>
    </div>

    <div class="col-lg-3 col-xs-6">
        <div class="rad-info-box my rad-txt-banner">
            <i class="icon fa fa-cloud-download"></i>
            <span class="heading">Download</span>
            <span class="value"><span data-purecounter-duration="1.0" data-purecounter-end="<?php echo $total_download;?>"class="purecounter">0</span></span>
        </div>
    </div>
    
    <div class="col-lg-3 my col-xs-6">
        <div class="rad-info-box my rad-txt-primary">
            <i class="icon fa fa-eye"></i>
            <span class="heading">MP3 total views</span>
            <span class="value"><span data-purecounter-duration="1.0" data-purecounter-end="<?php echo $total_vi;?>"class="purecounter">0</span></span>
        </div>
    </div>
    
    <div class="col-lg-3 col-xs-6">
        <div class="rad-info-box my rad-txt-success">
            <i class="fa fa-road"></i>
            <span class="heading">total rating</span>
            <span class="value"><span data-purecounter-duration="1.0" data-purecounter-end="<?php echo $total_rat;?>"class="purecounter">0</span></span>
        </div>
    </div>	
    
    <div class="col-lg-3 my col-xs-6">
		<div class="rad-info-box my rad-txt-rating">
			<i class="icon fa fa-user-md"></i>
			<span class="heading">Admin</span>
			<span class="value"><span>1</span></span>
		</div>
	</div>


</div>

<script async src="dist/purecounter.js"></script>
<?php include("includes/footer.php");?>       
