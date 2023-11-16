In : C:\xampp\apache\conf\extra\httpd-xampp.conf

## internal-audit.test

<VirtualHost _:80>
DocumentRoot "D:/projects/internal-audit-aba/public"
ServerName internal-audit.test
ServerAlias _.internal-audit.test
<Directory "D:/projects/internal-audit-aba/public">
Options All
AllowOverride All
Order Allow,Deny
Allow from all
Require local
</Directory>
</VirtualHost>
