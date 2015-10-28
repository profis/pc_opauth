pc_opauth
=========

This is a ProfisCMS plug-in that adds external authentication network capabilities using "opauth" library.

How to make it work?
---------

To make pc_opauth plug-in work you have to:

1. Activate plug-ins site_users and pc_opauth via admin area module manager
2. Fill in strategy specific configuration (API credentials) and set "enabled" for each needed strategy to "1" in admin area "Settings" module.

After all steps are done, **PC_user::getExternalAuthenticators()** static method should return authentication strategies (names and URLs)
supported by this plug-in. You can add ?redirect=...someUrl... to provided URLs in order for this plug-in to redirect users to specific
location after authentication is finished either successfully or with error. You can check if there was an error while authenticating
by calling **$error = PC_utils::getMessage('login-error');**. Don't forget to remove the message by calling
**PC_utils::removeMessage('login-error');** after that.

Licensing
---------

The plug-in is distributed under GNU General Public License version 3 (see LICENSE located in this plug-in's root directory).

Plug-in uses opauth library distributed under MIT license (see website for more information http://opauth.org/)

Each strategy plug-in used by opauth has it's own repository and licensing. Please check out opauth website for information on source and licensing of strategy plug-ins.
