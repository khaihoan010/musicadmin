<?php

$qry_cat="SELECT COUNT(*) as num FROM tbl_category";
$total_category= mysqli_fetch_array(mysqli_query($mysqli,$qry_cat));
$total_category = $total_category['num'];

$qry_art="SELECT COUNT(*) as num FROM tbl_artist";
$total_artist= mysqli_fetch_array(mysqli_query($mysqli,$qry_art));
$total_artist = $total_artist['num'];

$qry_mp3="SELECT COUNT(*) as num FROM tbl_mp3";
$total_mp3 = mysqli_fetch_array(mysqli_query($mysqli,$qry_mp3));
$total_mp3 = $total_mp3['num'];

$qry_album="SELECT COUNT(*) as num FROM tbl_album";
$total_album = mysqli_fetch_array(mysqli_query($mysqli,$qry_album));
$total_album = $total_album['num'];


$qry_playlist="SELECT COUNT(*) as num FROM tbl_playlist";
$total_playlist = mysqli_fetch_array(mysqli_query($mysqli,$qry_playlist));
$total_playlist = $total_playlist['num'];

$qry_users="SELECT COUNT(*) as num FROM tbl_users";
$total_users = mysqli_fetch_array(mysqli_query($mysqli,$qry_users));
$total_users = $total_users['num'];

$qry_banner="SELECT COUNT(*) as num FROM tbl_banner";
$total_banner = mysqli_fetch_array(mysqli_query($mysqli,$qry_banner));
$total_banner = $total_banner['num'];

$qry_dwn2="SELECT SUM(total_views) as num FROM tbl_mp3";
$total_vi= mysqli_fetch_array(mysqli_query($mysqli,$qry_dwn2));
$total_vi = $total_vi['num'];

$qry_dwn="SELECT SUM(total_download) as num FROM tbl_mp3";
$total_download= mysqli_fetch_array(mysqli_query($mysqli,$qry_dwn));
$total_download = $total_download['num'];

$qry_rat="SELECT COUNT(*) as num FROM tbl_rating";
$total_rat = mysqli_fetch_array(mysqli_query($mysqli,$qry_rat));
$total_rat = $total_rat['num'];

?>