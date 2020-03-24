<?php 
include "connect.php";

$kontrol = mysqli_query($baglan,"SELECT * FROM wp_posts WHERE post_type = 'post' and post_status = 'publish'");
$kontrol2 = mysqli_query($baglan,"SELECT * FROM `wp_postmeta` WHERE meta_key = '_wp_attached_file'");
$kontrol3 = mysqli_query($baglan,"SELECT * FROM `wp_postmeta` WHERE meta_key = 'post_views_count'");
$kontrol4 = mysqli_query($baglan,"SELECT * FROM `wp_postmeta` WHERE meta_key = '_menu_item_url'");
$say = mysqli_num_rows($kontrol);
$say2 = mysqli_num_rows($kontrol2);



class WpPosts {
	public $id;
	public $title;
	public $date;
	public $image;
	public $views;
	
}

$posts = new WpPosts();
$sayac =0;



$sunucuName = mysqli_fetch_assoc($kontrol4);


while ($bilgi2 = mysqli_fetch_assoc($kontrol2) ) {
	$images[] = $sunucuName["meta_value"]."wp-content/uploads/".$bilgi2["meta_value"];	
}

while ($bilgi3 = mysqli_fetch_assoc($kontrol3) ) {
	$views[] = $bilgi3["meta_value"];
}





if ($say>0 && $say2>0) {
	echo "[";


	while ($bilgi = mysqli_fetch_assoc($kontrol) ) {
		
		
		$posts->id = $bilgi["ID"];
		$posts->title = $bilgi["post_title"];
		$posts->date = $bilgi["post_date"];
		$posts->image = $images[$sayac];
		$posts->views = $views[$sayac];
		$sayac +=1;

		echo "<br>";
		echo(json_encode($posts));

		if ($say>$sayac) {
			echo ",";
		}


	}


	echo "]";
}











?>