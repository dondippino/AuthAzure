# Minimal Azure Active Directory Authentication

This application is a tiny one, meant to get access token from Azure Active Directory.

## Set Up Application

Step 1:
Go to the root directory 

```bash
cd <path-to-root-of-app>
```

Step 2:
Run composer.install

```bash
composer.install
```

Step 3:
Create .env file in the root and put in the following content:

```bash
CLIENT_ID=2e...erx // Insert Client ID of your registered app on Azure
CLIENT_SECRET=Zkm....de=  // Insert Client Secret of your registered app on Azure
TENANT_ID=2ee5863b-6ec3-4801-bb52-c9fb1222927b  // Insert Tenant Id from Azure
AZ_USERNAME=o..com // Insert Azure username
AZ_PASSWORD=******* //Insert Azure password
```
## **Important Note** Please DO NOT upload the .env file to your repository or production environment


Step 4:
Run the command below to encrypt the .env file.
This produces 2 files .env.enc and .env.key

```bash
vendor/bin/encrypt-env
```

Step 5:
Move files .env.enc and .env.key to public/ directory

Step 6:
Add the following to .gitignore

```bash
.env
.env.enc
.env.key
/public/.env.enc
/public/.env.key
```