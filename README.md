# mu-cron
multisite cron job for external cron
To reduce CPU usage and get tasks executed no matter, whether there are hits on the blog or not, we should replace WordPress Multisite CRON with real CRON.

The steps for Multisite are pretty similar, except that we need to trigger CRON on every single site of the network (because they work independently, as you remember).

1. Disable WordPress CRON across the whole network in wp-config.php: 
" define('DISABLE_WP_CRON', true); "

2. We will trigger publishing on every site with the help of foreach loop.
   download the php file " mu-cron.php " and upload it in the same root directory, where you have your wp-config.php.
   
3. All that you need now, is just to add one single CRON job for your main blog/site on your server:   

  " wget -q -O - "http://yourdomain.com/mu-cron.php" > /dev/null 2>&1 "
  *with your desired time interval. and replace yourdomain.com with your multisite network's main domain*

That’s all! According to the specified recurrence (e.g. once a day or ex=very 5 mins) Unix CRON will hit
mu-cron.php -> which will hit wp-cron.php on every blog in the network-> which will check if there are any tasks scheduled, and execute them.

Thus you can use a single external cronjob to trigger every subsite in the network at once.

*thank you*



