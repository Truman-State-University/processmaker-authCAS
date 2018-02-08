# authCAS Plugin for Processmaker

Tested with PM version (3.2-community) & phpCAS (CAS-1.3.5)

Through this plugin you can integrate CAS with processmaker. 

> Note : The Username needs to be added before the user can log in. Auto-register functionality will be added in future.

## Setup

1. Download this plugin and copy files to workflow/engine/plugins directory.
2. Edit the authCASconfig.ini file and put correct CAS configuration.
3. **Important**: You must copy the login.php file in patch folder to the workflow/engine/methods/login/ folder.
4. Enable authCAS plugin by logging into processmaker and visiting Admin > Plugins section.

## List of files modified in PM

- workflow/engine/methods/login/login.php