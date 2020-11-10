# Symfony
php framwork, enforces best practises, easy maintenance, modular.
### MVC architecture
M=>model  
V=>view   
C=>controller 
### REST (Representational state transfer)
An architectural system centered around resources and hypermedia, via HTTP protocols.
````rest
get
post
put
patch
delete
````

### CRUD (create, read, update, delete)
a cycle meant for maintaining permanent records in a database setting.  
CRUD principles are mapped to REST commands to comply with the goals of RESTful architecture.


### configuration file format  in symfony:
1. Annotaions
2. YML
3. XML
4. PHP

### environment:
first update packages:
```shell
sudo apt-get update
```

install mysql, php and apach2
````shell script
sudo apt-get install mysql-server mysql-client
sudo apt-get install apach2
sudo apt-get install  php-cli php-xml libapache2-mod-php
````
install composer:
````shell script
sudo apt install curl
cd ~
curl -sS https://getcomposer.org/installer -o composer-setup.php
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
````
download symfony cli
````shell script
wget https://get.symfony.com/cli/installer -O - | bash
````
### Create a symfony application:

with composer:
````shell script
composer create-project symfony/skeleton myProject
````
with Symfony cli
````shell script
 symfony new --full SymfonyCourseProject
````

install local certificate for https
````shell script
symfony server:ca:install
````

Launch the demo app
````shell script
symfony server:start
````
List all running servers:
````shell script
symfony server:list
````
list installed php version
````shell script
symfony  local:php:list
````

start with a proxy
````shell script
symfony  proxy:start
````
attach a domain to proxy `by default ends with .wip` 
````shell script
symfony proxy:domain:attach symfonyproject
````
show logs:
````shell script
symfony server:log
````
start server, stop server and server status
````shell script
symfony server:start
symfony server:stop
symfony server:status
````
show all php console command
````
php bin/console
symfony console
````
install cors
````shell script
composer require cors

````
install bundles  `--dev for development`
````shell script
composer require yourBundle  
````
remove bundles
````shell script
composer remove yourBundle
````

show all recipes
````shell script
composer recipes
````
create controller
````shell script
symfony console make:controller YourController
````

### ORM (object relational mapper)
Doctrine    
create an entity
````shell script
symfony console:make entity
````
this command allows us to create or update an entity, add fields, property and specify type of each one.

create a migration: allows to create a table corresponding to the entity in our database  
before we have to configure the .env file to specify our db configuration
for MySQL:  
````dotenv
DATABASE_URL=mysql://db_user:db_password@host:port/db_name?serverVersion=*.*
````
we can create the configured database if not exists with doctrine:
````shell script
symfony console doctrine:database:create
````
we can also drop the configured database:
````shell script
symfony console doctrine:database:drop
````
### configuration parameter
it's recommended to define our conf param in /config/services.yaml.

````yaml
parameters:
    app.myparam
````
list all parameters:
````shell script
symfony console debug:container --parameters
````
list value on a parameter:
````shell script
symfony console debug:container --parameter=app.myparameter
````
Access to env var in configuration file:
````yaml
parameter:
    app.param: '%env(MYENVVAR)%'
````
Resolve in conf file:
resole allows to resolve conf params in url or other;
for example:
````yaml
doctrine:
    url: '%env(resolve(DATABASE_URL))%'
````
### Migrations
create a table in our DB with our entities:
By default the name of the table is the entity's one.
we can specify the name of our table in the entity by the annotation `@ORM\Table(name="tableName")`
````shell script
symfony console make:migration
````
show status of migrations:
````shell script
symfony console doctrine:migrations:status
````
apply the migration:
````shell script
symfony console doctrine:migrations:migrate
````

go back:
````shell script
symfony console doctrine:migrations:migrate prev
````

reapply:
````shell script
symfony console doctrine:migrations:migrate next
````
create an instance of an entity:
````php
public function myfunction(): Response{
    $newEntityInstance = new Entity; //new instance of the entity
    $newEntityInstance->setFirstAttribute('someinformations');
    $newEntityInstance->setSecondAttribute('somInformations');
    $em = $this->getDoctrine()->getManager();//get doctrine EM
    $em->persist($newEntityInstance);
    $em->flush();
    return $this-> render('entity.html.twig');
}
````

### profiler and debug
we can install the profiler if we need it only or install debug, which include the profiler.
````shell script
composer req debug --dev
````

### dependance injections
we can inject dependencies in controllers.
list all injectable dependencies:
````shell script
symfony console debug:autowiring
````
injection could be done in parameter of our function:
````php
public function myfunction(EntityManager $em):\Symfony\Flex\Response
{
//some code
    $em->persist();
    $em->flush();
}
````

### Repository
first import the repo in your controller to use it
````php
$repo = $em->getRepository(Pin::class);
//or
$repo = $em->getRepository('App\entity\pin');
````
then you can use the methods of your repo.
````php
$pins = $repo->findAll();
````
we can simplify the code by injecting the ClassRepository and using compact function for the response. 
````php
public function myfunction(ClassNameRepository $repo):Response{
    $pins = $repo->findAll();
    return $this->render('pins.html.twig', compact('pins'));
}
````
