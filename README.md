# log-parser application
Parsing webserver log files using PHP/Symfony with MySQL

## Usage

### Requirements
- Symfony is only supported on PHP 5.3.9 and up.
- Install through Symfony Installer https://symfony.com/doc/current/book/installation.html#installing-the-symfony-installer


## Two main approaches
### Basic approach consists of parsing and persisting the log file
use of PHP's preg_match_all to match a regular expression
### Database Oriented approach
Using a trasaction to load the log file directly to the database using MySql's   


## Log Format
The log format used is based on the Apache Common Log Format https://en.wikipedia.org/wiki/Common_Log_Format

The test files has been sourced from http://www.monitorware.com/en/logsamples/apache.php
### Example
```127.0.0.1 user-identifier amine [10/Oct/2014:13:55:36 -0700] "GET /apache_pb.gif HTTP/1.0" 200 2326```

The presence of a "-" in a field indicates missing data.

- 127.0.0.1 is the IP address of the client (remote host) which made the request to the server.
- user-identifier is the RFC 1413 identity of the client.
- amine is the userid of the person requesting the document.
- [10/Oct/2014:13:55:36 -0700] is the date, time, and time zone when the server finished processing the request, by default in strftime format %d/%b/%Y:%H:%M:%S %z.
- "GET /apache_pb.gif HTTP/1.0" is the request line from the client. The method GET, /apache_pb.gif the resource requested, and HTTP/1.0 the HTTP protocol.
- 200 is the HTTP status code returned to the client. 2xx is a successful response, 3xx a redirection, 4xx a client error, and 5xx a server error.
- 2326 is the size of the object returned to the client, measured in bytes.

### Enhacements and TODO
- better manager parsing using services and dependeny injection (skinny models and controller)
- perform data analysis on myqsl database
- conversion to CSV format for a more adequate use in statistical anlysis (PERL, PY, and R) 
- enhance the speed of MySql's LOAD DATA through ignoring foreign keys and uniqueness constrains
- enforce file splitting rules for large log files 



