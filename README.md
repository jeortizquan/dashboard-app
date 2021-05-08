# Dashboard-service-app

## how to run
```
docker-compose up
```

## dependency run first
* rabbit-mq
  ```
  docker run -d --hostname my-rabbit --name some-rabbit -p 15672:15672 -p 5672:5672 --network="admin-app_cool_network" rabbitmq:3.8.16-management-alpine
  ```
* admin-app
