environment variable is a variable which we can create in our OS, which we can access with a programmation language.  
#### create variables in Linux/macOS
````shell script
export MYENVVAR = "this is my env var"
````
then we can echo the content of the var:
````shell script
echo $MYENVVAR
````
#### create variables in Windows
````shell script
set MYENVVAR = "this is an env var"
````
echo the var content
````shell script
echo %MYENVVAR%
````
or
````shell script
set MYENVVAR
````
### ENV in PHP
get env value:
````php
echo getenv('MYVARENV');
````
environment variables are stored in .env file.  
we can use also .env.local to store variable that we don't want to push to github
if .env.local exists, the env var defined in it will be superior to env var defined in .env
