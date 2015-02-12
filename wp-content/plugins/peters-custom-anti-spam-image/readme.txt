=== Plugin Name ===
Contributors: pkthree
Donate link: http://www.theblog.ca
Tags: comments, spam, anti-spam, CAPTCHA
Requires at least: 3.2
Tested up to: 3.8
Stable tag: trunk

Stop a lot of spambots from polluting your site by making visitors identify a custom word displayed as an image before commenting.

== Description ==

Stop a lot of spambots from polluting your site by making visitors identify a random word displayed as an image before commenting and optionally before registering. You can customize the pool of words to display.

= Features =

* Toggle whether registered users need to enter the word

* Random font display

* No cookies required

* No JavaScript required

* Auto-generated audio for visually impaired users

* Easy-to-read

* No mapping of words from the code -- words are used once or removed after 24 hours

* Reminder of what was entered if you get the word wrong

* Selective blocking of trackbacks, pingbacks

* Easy to translate

* Compatible with caching plugins

= Negatives =

* Purposely no obscuring techniques so that the anti-spam word is easy to read

* The more people who use this plugin, the more motivation for spambots to target it

= Requirements =

* GD Library and FreeType Library (There's a diagnostic page to tell you whether you have them installed. If needed, just ask your web host to install them!)

* WordPress 3.2 or higher

= Translations =

* ru\_RU translation by koc

== Installation ==

Unzip all files to the folder custom-anti-spam in your plugins directory, so that the path is wp-content/plugins/custom-anti-spam/. Then activate the plugin via your WordPress admin section. The plugin should work directly "out of the box", but all settings can be customized in the Settings > Custom anti-spam page in your WordPress control panel. If you are upgrading from a previous release, de-activate that release first.

== Frequently Asked Questions ==

Please visit the plugin page at http://www.theblog.ca/anti-spam with any questions.

== Changelog ==

= 3.2.2 =
* 2014-02-08: Minor code cleanup (thanks koc!)

= 3.2.1 =
* 2013-10-07: Support PHP 5 static function calls, bumping WordPress requirement to 3.2+.

= 3.2.0 =
* 2013-03-30: Add dynamic anti-spam field name. Also: standardize translation and upgrade process.