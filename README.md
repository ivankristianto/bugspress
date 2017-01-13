# Bugspress

## Installing your development environment

bugspress development environment uses [Chassis](http://chassis.io/) for local development, a virtual server built using [Vagrant](https://www.vagrantup.com/).

### Prerequisites

Before using Chassis, this is how your system should be set up:

1. Install [VirtualBox](https://www.virtualbox.org/wiki/Downloads).
2. Install [Vagrant](http://www.vagrantup.com/downloads.html).
3. Make sure you have Zeroconf networking (Bonjour) set up:
	* **OS X**

		You already have Bonjour available.

	* **Windows**

		If you have iTunes, Safari, Bonjour Print Services, or Creative Suite 3 installed, you already have Bonjour.

		Otherwise, you need to install Bonjour on your system. The easiest way to do this is to [install iTunes](http://www.apple.com/itunes/download/). If you'd prefer not to do this, you can follow [these instructions](http://help.touch-able.com/kb/network-setup-windows/make-sure-that-bonjour-is-installed-on-your-windows-pc) to install just Bonjour.

	* **Linux**

		You need to have Avahi installed on your system.

		For Ubuntu:

		$ sudo apt-get install avahi-dnsconfd

### Installing

The initial step is to clone the repos.

The Chassis config files are stored in the theme repository and copied to Chassis in the instructions below.

	$ git clone --recursive https://github.com/Chassis/Chassis bugspress
	$ cd bugspress
	$ git clone --recursive git@github.com:wp-id/site.git content
	$ vagrant up

This will take a few moments to run as Chassis configures your machine. You may wish to get a coffee while you wait for vagrant to provision.

The remaining configuration takes place after the virtual machine is provisioned.

	$ vagrant ssh
	$ wp theme activate wpid
	$ wp rewrite structure '/%postname%/'

You can now login to the site:

* URL: http://bugspress.local/wp/wp-admin
* Username: `admin`
* Password: `password`


## Testing

### Coding standards

To lint your PHP run the following commands:

	$ vagrant ssh
	$ cd /vagrant/content
	$ phpcs -p -s -v -n . --standard=phpcs.ruleset.xml --extensions=php

### Unit tests

Run PHP unit with the WordPress Testing framework for unit testing. The tests need to be run within Vagrant.

	$ vagrant ssh
	$ cd /vagrant/content
	$ phpunit