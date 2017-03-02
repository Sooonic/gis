#Развертка окружения на основе Docker контейнеров

Развертка 
~~~bash
./run.sh && ./init.yii.sh
~~~

Обновление Composer (После pull) 
~~~bash
./composer.sh update
~~~

Накатывание миграций 
~~~bash
./migrate.sh 
~~~

yii command 
~~~bash
./yii.sh "command" 
~~~

Остановка 
~~~bash
./stop.sh
~~~

Удаление 
~~~bash
./clean.sh
~~~

Composer console 
~~~bash
./composer.sh
~~~

Container console 
~~~bash
./console.sh containerName
~~~