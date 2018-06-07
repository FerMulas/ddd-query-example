# Spotahome exercise app
A spotahome exercise

This my provided solution to the exercise. I included a __run.sh__ script to easily deploy it using docker. This script is located at __$ProjectPath/docker/run.sh__. To run it just go to the project path and execute the next command:

```
docker/run.sh
```

I provided a simple (and quite useless test) to test de use case. I just did this to show I use TDD, but in a real scenario this use case (and most of use cases based on query) are usually tested from outside (with curl, from a restlet client, etc). 

I provided a simple html/JS client to show the data sorted in table format.

Once the docker containers are running you should be able to access to client or api with these url:

- API: 0.0.0.0:8090
- Client: 0.0.0.0:8091

Some request examples:
- http://0.0.0.0:8090/apartments
- http://0.0.0.0:8090/apartments?page=1
- http://0.0.0.0:8090/apartments?page=1&pageSize=3
- http://0.0.0.0:8090/apartments?page=1&pageSize=30&ordinationField=title
- http://0.0.0.0:8090/apartments?page=1&pageSize=30&ordinationField=title&ordinationDirection=DESC

Query request parameters available:
- page
- pageSize
- ordinationField
- ordinationDirection

Default values
- page: 1
- pageSize: 10
- ordinationField: 'id'
- ordinationDirection: 'ASC'
