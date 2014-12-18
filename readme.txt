Plugin Name: MML Simple Weather
Plugin URI: http://www.mymedialab.co.uk/opensource/wp-simple-weather/
Description: A simple plugin that enables you to add Yahoo Weather to add your site.
Version: 1.0.0
Author: Barry Rhodes
Author URI: http://www.mymedialab.co.uk/
License: GPLv2

This work is based on Beautiful Yahoo Weather 1.4.2 by Mohammad Pishdar. A plugin which *almost* did what I needed!
All of the languages come from there, as do most of the icons. The code itself is a rewrite to allow for less user
extension, but more developer flexibility.
Original URI: http://www.wp-book.ir/
Original Author URI: http://www.wp-book.ir/

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

The Weather plugin enables you to get up-to-date weather information for your location.The Weather plugin is a dynamically-generated based on WOEID

== Description ==

The Weather plugin enables you to get up-to-date weather information for your location.The Weather plugin is a dynamically-generated based on WOEID

= Languages =

persian english arabic bulgarian catalan chinese-simplified chinese-traditional danish dutch estonian finnish german french greek haitian-creole hindi indonesian italian japanese korean latvian maltese romanian russian spanish swedish turkish ukrainian vietnamese

== Installation ==

= You can either install it automatically from the WordPress admin, or do it manually: =

1. Unzip the archive and put the `mml-simple-weather` folder into your plugins folder (/wp-content/plugins/).
2. Activate the plugin from the Plugins menu.

== Frequently Asked Questions ==

= How can I find a county/city fips given a yahoo WOEID? =


weather.yahoo.com

Yahoo uses weather.com as it's weather provider, so using the same steps as the above should work. However. If you would like to find your weather code through weather.yahoo.com, follow these steps.

  1. Go to http://weather.yahoo.com
  2. Search for your city. You will now see page with weather information. There are two ways to go from here.
  3. Click 'Extended forecast'.
  4. http://www.weather.com/weather/extended/IRXX0018?par=yahoo...
  5. WOEID is:IRXX0018


Weather.com

  1. Go to http://www.weather.com
  2. Search for your town and country (ie London, United Kingdom or New york, NY, United States) - When your search has given you the right location you will be taken to the page where the weather is displayed. You should now look at the URL (the address bar).
  3. The URL should now look something like this:
        http://www.weather.com/weather/today/UKXX0085
        or
        http://www.weather.com/weather/today/USNY0996
  4. The weather code is now in the URL. The part we are looking for is: UKXX0085 ( / USNY0996 )
  5. Take the weather code and paste in in your skin at the appropriate place. Save. Refresh.
