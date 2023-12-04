docker exec -it ganti_php php bin/console d:d:c
docker exec -it ganti_php php bin/console d:m:m --no-interaction

docker exec -it ganti_php php bin/console cache:clear

npm run dev

open http://localhost:80
