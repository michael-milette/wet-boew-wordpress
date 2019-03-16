<img src="pix/logo.png" align="right" />

WET-BOEW-WORDPRESS
==================
![PHP](https://img.shields.io/badge/PHP-v5.6%20%2F%20v7.0%20%2F%20v7.1-blue.svg)
![WordPress](https://img.shields.io/badge/WordPress-v4.9%20to%20v5.1-teal.svg)
[![GitHub Issues](https://img.shields.io/github/issues/michael-milette/wet-boew-wordpress.svg)](https://github.com/michael-milette/wet-boew-wordpress/issues)
[![Contributions welcome](https://img.shields.io/badge/contributions-welcome-green.svg)](#contributing)
[![License](https://img.shields.io/badge/License-GPL%20v3-blue.svg)](#license)

# Table of Contents

- [Basic Overview](#basic-overview)
- [Requirements](#requirements)
- [Download WET-BOEW-WORDPRESS](#download-wet-boew-wordpress)
- [Installation](#installation)
- [Configuration](#configuration)
- [Updating](#updating)
- [Uninstallation](#uninstallation)
- [Limitations](#limitations)
- [Language Support](#language-support)
- [Frequently Asked Questions (FAQ)](#faq)
- [Contributing](#contributing)
- [Motivation for this plugin](#motivation-for-this-plugin)
- [Further information](#further-information)
- [License](#license)

# Basic Overview

WET-BOEW-WORDPRESS is a WordPress theme which implements a variant of the Web Experience Toolkit (WET) version 4.0.26.

Author: Government of Canada and contributors from the global community

Author URI: https://github.com/wet-boew/wet-boew-wordpress

This theme uses HTML5 and CSS3 properties.

Based on Government of Canada Common Look and Feel (CLF) standard:

Web Experience Toolkit (WET) - Boîte à outils de l'expérience Web (BOEW)

[(Back to top)](#table-of-contents)

# Requirements

* [WordPress](https://github.com/WordPress/WordPress): Only tested with WordPress 4.9.x
* [WET-BOEW-WORDPRESS](https://github.com/wet-boew/wet-boew-wordpress): Theme only tested with WordPress 4.9.x
* [WET-BOEW Theme](https://github.com/wet-boew/themes-dist): Only tested with theme-gc-intranet but can be made to work with other WET-BOEW themes with some small modifications to PHP files.
* For a multilingual site, it has been tested with [qTranslate-XT](https://github.com/qtranslate/qtranslate-xt)
* See [WordPress system requirements](https://en-ca.wordpress.org/about/requirements/)
* The amount of memory required in your server will depend on the complexity of your WordPress installation and the number of expected concurrent users. However, 1 to 2 GB of memory is recommended.
* You will need root/sudo access to your web server.
* You will need root/administrator access to your database server.
* You will need to decide on the username of the Admin user and the domain of your website. Almost everything else can be easily changed after the installation.

The dependency on qTranslate has been removed but is recommended. Other multilingual plugins such as [WPML](https://wpml.org/) and [Polylang](https://en-ca.wordpress.org/plugins/polylang/) may work as well but have not been tested.

[(Back to top)](#table-of-contents)

# Download WET-BOEW-WORDPRESS

The most recent ALPHA release of WET-BOEW-WORDPRESS is available from:
https://moodle.org/plugins/filter_filtercodes

The most recent DEVELOPMENT release can be found at:
https://github.com/michael-milette/wet-boew-wordpress

[(Back to top)](#table-of-contents)

# Installation

The following instructions describe how to setup WordPress and the WET-BOEW Intranet theme. For other themes or for installing on a Windows-based server, the instructions may be slightly different and will need to modify the Linux symbolic links included with the theme.

1. Install WordPress.

* Create a database and set permissions.
* Download and install WordPress.

    git clone https://github.com/WordPress/WordPress.git .
    git checkout --track origin/4.9-branch
    
* Go to http://your.website/ and follow the WordPress setup instructions.

[More information on installing WordPress](https://codex.wordpress.org/Installing_WordPress#Famous_5-Minute_Installation)

2. Download the WET-BOEW theme distribution files.

From a shell prompt at the webroot of your site:

    git clone https://github.com/wet-boew/themes-dist.git wet-boew-intranet
    cd wet-boew-intranet
    git checkout --track origin/theme-gc-intranet

3. Download the WET-BOEW-WORDPRESS theme repository.

    git clone https://github.com/wet-boew/wet-boew-wordpress.git wp-content/themes/wet-boew
    cd wp-content
    cd themes
    cd wet-boew
    git checkout --track origin/v4.0
    
If you are on Windows, you will need to do the following additional commands with an elevated (run as Administrator) command prompt to delete the Linux symbolic links and replace them with Windows versions:

    del wet-boew
    mklink /J theme-wet ..\..\..\wet-boew-intranet\theme-gc-intranet
    del themes-wet-boew
    mklink /J theme-wet-boew wet-boew\theme-gc-intranet
    
# Configuration

At this point, you may need to adjust the permissions of the files and folders that you just installed if it isn't working properly.

Once logged into WordPress configure it as follows:

- Site Language: English
- Timezone: Toronto (or the closest Canadian city in your time zone)
- Date format: Y-m-d
- Time format: g:i A
- Week Starts on: Sunday
- Permalink Common Setting: http://intranet/sample-post/
- For multilingual sites, install the qTranslate-XT. See link below.
- Change theme to WET-BOEW. Instructions on how to install a WordPress theme: http://codex.wordpress.org/Using_Themes

Tip: The main navigation is controlled by a menu called "mega-menu"

If using qTranslate...

Add a widget called qTranslate Language Chooser to the "Language Selection Widget Area" and configure it as follows:

* Title: Blank
* Hide Title: Checked
* Hide Title Colon: Checked
* Display: Text only
* Widget CSS: Unchecked

Configure the French version of the uncategorized category label.


# Usage

[TODO]

IMPORTANT: This release has been tested on very limited number of WordPress sites. Although we expect everything to work, if you find a problem, please help by reporting it in the [Bug Tracker](http://github.com/michael-milette/wet-boew-wordpress/issues).

# Updating

Please note that this is a complete re-write of the WET-BOEW-WORDPRESS theme. It may not be backwards compatible with versions of this theme published before March 2019.

Assuming you followed the installation instructions, the easiest way to updating the theme is simply a matter of going to thr webroot of your WordPress installation and doing the following commands:

To use the most recent release:

    cd wp-content/themes/wet-boew
    git pull

This theme is not available from the WordPress plugins / themes repository.

# Uninstallation

Uninstalling the theme as you would any other WordPress theme.

In addition, you will want to delete the wet-boew-intranet folder located in the webroot.

# Limitations

WET-BOEW-WORDPRESS is still very young. As such, it may not include some features or settings that you might find in more evolved themes.
You may not be able to use all of the features from the WET-BOEW framework. We will make a list available as they are uncovered.

# Language

This theme includes support for the English and French language.

If you need a different language that is not yet supported, please feel free
to contribute the mo/po file through a pull request. The following tools can be useful to create new
translations:

* [Loco Translate](https://en-ca.wordpress.org/plugins/loco-translate/) WordPress plugin - Only required to create the language file and then can be uninstalled.
* [Google Translator Toolkit](https://translate.google.com/toolkit/) - Web based tool.
* [POEdit](https://poedit.net/) for Windows.

This theme has not been tested for right-to-left (RTL) language support.
If you want to use this theme with a RTL language and it doesn't work as-is,
feel free to prepare a pull request.

Pull Requests can be submitted to the project page at:
http://github.com/michael-milette/wet-boew-wordpress

[(Back to top)](#table-of-contents)

# FAQ

## Frequently Asked Questions

IMPORANT: Although we expect everything to work, this ALPHA release has not been fully tested in every situation. If you find a problem, please help by reporting it in the [Bug Tracker](http://github.com/michael-milette/wet-boew-wordpress/issues).

### Are there any security considerations?

There are no known security considerations at this time.

## Other questions

Got a burning question that is not covered here? If you can't find your answer, submit your question in the Moodle forums or open a new issue on Github at:

http://github.com/michael-milette/moodle-filter_filtercodes/issues

[(Back to top)](#table-of-contents)

# Contributing

If you are interested in helping, please take a look at our [contributing](https://github.com/michael-milette/wet-boew-wordpress/blob/master/CONTRIBUTING.md) guidelines for details on our code of conduct and the process for submitting pull requests to us.

## Contributors

Pierre Dublis - Author and lead developer of the original version.
Michael Milette - Author and Lead Developer of this fork.

## Pending Features

## Known Issues

* <s>Only in French.</s>
* <s>Requires qTranslate</s>
* <s>There is no secondary navigation</s>
* <s>Footer items are hard coded in footer.php</s>
* Need to cleanup old CLF2 code in functions.php
* Need to review how blog comments are displayed.
* Some widgets, such as the Archives widget, don't get translated. You may need to use [:en]English content[:fr]Contenu français[:] syntax.
* Layouts need work. Needs more page layouts (only Single column) available.
* The sidebar appears below the results on the search results page.
* On the blog roll page, only the most recent post is displayed.
* Untested with WordPress 5.x with Gutenberg Editor.
* Currently made for the theme-gc-intranet theme. Will need more work to enable it to work with other WET 4.0 themes.

## Wish List

* Create an initialization script that will configure WordPress with some default settings instead of having this as part of the theme activation.
* Set date format
* Set time format
* Remove the "Just another WordPress site" tagline.
* Create a default mega-menu.
* Configure the widgets.
* Install qTranslate-XT (or at least prompt for it).
* ... suggestions?

# License
WET-BOEW-WORDPRESS - Copyright (C) 2012-2019 Government of Canada

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <https://www.gnu.org/licenses/>.
