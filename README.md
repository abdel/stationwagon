# Stationwagon

* Version: 1.3
* Fuel Version: 1.2-RC1
* [Stationwagon on FuelPHP Forums](http://fuelphp.com/forums/topics/view/326)

## Description

Stationwagon is a Fuel-powered blog application. The purpose of this application is to allow FuelPHP beginners to see how things work by providing real and working examples.

## Developers

* [Abdelrahman Mahmoud](http://aplusm.me/) - Lead Developer

## Downloading Stationwagon

You can download Stationwagon right away from the Downloads area.

## Cloning Stationwagon

    git clone git://github.com/abdelm/stationwagon.git

## Installation

After cloning or downloading Stationwagon using the steps above, you will do a few things to get Stationwagon up and running:

- Import the **database.sql** to your database
- Change the database details in */fuel/app/config/db.php*
- Change the table name in */fuel/packages/auth/config/simpleauth.php*
  'table_name' => 'users'
- That's it!

If you want to use mod_rewrite, do the following changes in */fuel/app/config/config.php*:

    'index_file' => false,

## Learning

Stationwagon is full of examples and is updated regularly with the latest Fuel changes.

There are a lot of examples on these classes:

- Orm
- Auth
- Pagination
- Validation
- and a lot more!

## Contribute

If you are interested in adding more features to Stationwagon, fork the repository and make sure you make a pull request after you pushed changes to your Stationwagon fork.

To report any bugs or problems, create a new issue here in our GitHub repository.
