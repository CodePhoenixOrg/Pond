# Pond

A basic PHP framework to make both command line and web experimentations like API and so on.

## Requirements

Pond is developped in PHP 7.3. You need to be sure the iconv and curl extensions are enabled.
Additionally it requires the DOM extension and its dependencies when using PHPUnits.

## How does it work ?

The framewrok consists of a command line tool named Drop and a web application named Pond.
The Pond script itself is no more the main script. Each application has its own directory under __src/apps/__

For example, to find and use the __pond__ script you must go to __src/apps/pond__.

## Installation

Just clone the repo on github

	git clone https://github.com/CodePhoenixOrg/Pond.git

## Setup

### Setting up the running environment - _REQUIRED_

All environment data are stored in a file. Edit **./config/environment.json** and add the following JSON object :

    {
        "env": "test"
    }

These also may be the place of other application settings.

### Setting up the working directories - _OPTIONAL_

You can now decide where to read and write input and output files. Edit **./config/directories.json** and add the following JSON object :

	{
    	"output": "~/Documents/output",
    	"input": "~/Documents/input"
	}

Static methods from **FileUtils** class use __../input__ and __../output__ folders relative to **src/pond.php** by default. The JSON object allow you to override the default values.

## The Docker image

A docker image has been added so you are not obliged to install all the needed developement stuff.

    docker-compose build
    docker-compose up &
    docker exec -it pond_php_1 /bin/bash

## Work in progress

You are welcome to suggest new features or updates.

David