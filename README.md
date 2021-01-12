# Customers

## Configuração Virtual Host Xampp

**C:\xampp\apache\conf\extra\httpd-vhosts.conf**
<pre>
    <VirtualHost *:80>
        ServerName www.customers.com.br
        ServerAlias intervin.com.br
        DocumentRoot "C:/customers/public"
        <Directory "C:/customers">
            Options Indexes FollowSymLinks Includes ExecCGI
            AllowOverride All
            Require all granted 
        </Directory>
    </VirtualHost>
</pre>

## Configuração Host Local
**C:\Windows\System32\drivers\etc\hosts**
127.0.0.1 www.customers.com.br

## Rodar script banco de dados
allQuerys.sql