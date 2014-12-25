## Requirements

- PHP 5.3.0+
- MySQL
- mod_rewrite activated (tutorials below, but there's also [TINY](https://github.com/panique/tiny), a mod_rewrite-less 
version of MINI)

## Installation

1. Edit the database credentials in `application/config/config.php`
2. Execute the .sql statements in the `_install/`-folder (with PHPMyAdmin for example).

MINI runs without any further configuration. You can also put it inside a sub-folder, it will work without any 
further configuration.
Maybe useful: A simple tutorial on [How to install LAMPP (Linux, Apache, MySQL, PHP, PHPMyAdmin) on Ubuntu 14.04 LTS](http://www.dev-metal.com/installsetup-basic-lamp-stack-linux-apache-mysql-php-ubuntu-14-04-lts/)
and [the same for Ubuntu 12.04 LTS](http://www.dev-metal.com/setup-basic-lamp-stack-linux-apache-mysql-php-ubuntu-12-04/).

## Security

The script makes use of mod_rewrite and blocks all access to everything outside the /public folder.
Your .git folder/files, operating system temp files, the application-folder and everything else is not accessible
(when set up correctly). For database requests PDO is used, so no need to think about SQL injection (unless you
are using extremely outdated MySQL versions).

## License

AGPL
