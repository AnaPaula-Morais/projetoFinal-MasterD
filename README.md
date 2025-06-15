# loja_online

## Como executar com o docker

Para desenvolvimento usar o comando abaixo
```bash
docker compose watch
```

Cria uma imagem nova a partir do meu dockerfile e sobe os outros containers.
Caso haja alguma alteração no dockerfile usar o comando abaixo.
```bash
docker compose up --build
```

As configurações do docker foram baseadas no link abaixo
https://docs.docker.com/guides/php/develop/
