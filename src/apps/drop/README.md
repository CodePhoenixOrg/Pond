# Pond

Execute batch operations on Pond REST API

## Installation

Just clone the repo on gitlab

	git clone https://git.CodePhoenixOrg.lan/blanchard/pond.git



## Requirements

Pond is developped in PHP 7.3. You need to be sure the iconv and curl extensions are enabled.

## How it works ?

Pond is a PHP CLI program to which you pass parameters.

	php pond.php help

The command line parameters allow you to choose which batch operations you need to run.

## The commands

Excepted help option, by now, you can only rename images. This can be done like this :

    php pond.php renimages

## Before running the script

### Authentication considerations

In order to send back a useful response body, the Pond REST API needs an authorization token and its refresh key. Both values are stored in the Cookie field of the reponse header.

Pond does the job for you but you need to provide your credentials. You will be logged in via a CURL request and the tokens cookie will be stored on the disk to be used for other requests.

Since the requests negotiate over TLS, you also need the CodePhoenixOrg certificate public key.

#### Setting up the credentials 

Be careful, the username and password are stored in clear text, you should consider using this script in your user space to limit the indiscretion risk.

Open an editor and save the following JSON object under **./config/credentials.json**. It is your CodePhoenixOrg domain user.

	{
		"username":  "blanchard",
		"password":  "demo"
	}

#### Setting up the certificate

Pond uses all the security options available in CURL requests. It must know where to get the certificate file. 
Since the certificate is global to CodePhoenixOrg it is provided with the script in zip format. You just have to unzip it. 
The configuration is already done for ease of use.

However, if you have to renew the certificate with a different name, don't forget to edit **./config/certificate.json**.

    {
        "path": "./certs/CodePhoenixOrg_root_public.crt"
    }

#### Setting up the API context

To prevent from writing your locale setting in the code, one configuration file gather the language, country and partner information. Edit **./config/api-context.json** and add the following JSON object :

	{
		"language": "fr",
		"country": "FR",
		"partner": "7884"
	}

## Work in progress

Keep in mind that the script is still in development. By now the renimages command only does read-only stuff.