<?php

if ( is_multisite()) {
	$sites = get_sites();			
	foreach ($sites as $site ) {
		$blog_id = $site->blog_id;				
			//if ($blog_id < 6 ){ //if we need just certain blogs 
				switch_to_blog( $blog_id );
				wp_suspend_cache_addition(true);
					//here's what we're gonna do...
					$site_url = get_site_url($blog_id);
					$command = $site_url.'/wp-cron.php?doing_wp_cron';
					wp_remote_get( $command );						  
				wp_suspend_cache_addition(false);
				restore_current_blog();	
			//} //endif $blog_id
		sleep(3); // this should be paused for 3 seconds before every other blog
	}//endforeach				
}//endif multisite	

?>
