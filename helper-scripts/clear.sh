
#!/bin/bash
docker-compose down -v

docker rm $(docker ps -aq) -f

docker volume rm $(docker volume ls -q) -f

docker rmi $(docker images -q) -f 

exec "$@"