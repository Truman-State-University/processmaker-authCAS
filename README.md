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

## Logout Functionality

- workflow/engine/skinEngine/skinEngine.php

Look for $logout variable which is where user will be redirected after logout. We need to send the user to CAS logout once PM logout occurs.

```
$logout = 'https://cas.server.com:8443/cas/logout';
```

Also, in your themes layout.html, add the following code

```
{literal}
<script type="text/javascript">
function logout() {
  document.cookie = 'PHPSESSID=;expires=Thu, 01 Jan 1970 00:00:01 GMT;';
  window.location = 'https://cas.server.com:8443/cas/logout';
}
   </script>
{/literal}
```

and bind the anchor to click event.
