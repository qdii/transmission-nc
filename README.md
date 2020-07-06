# Transmission for Nextcloud

This app allows you to run a Transmission server alongside your Nextcloud instance, and manage your torrents directly from within Nextcloud web interface.

# Architecture
```
+-----------+
|           |
| Nextcloud |
|           |    +---------------+
+-----+-----+    |               |
      |          | Transmission  |
      +----------+               |
 shared          +---------------+
   volume
```
The Transmission docker instance runs on the same machine as the Nextcloud docker instance. It saves the downloaded torrents in a volume that is shared with the Nextcloud docker instance. This volume is integrated into Nextcloud by adding it as an external storage.

Commands can be sent to Transmission daemon from the Nextcloud app: javascript requests are sent to a PHP handler in the app, that in turns emits a JSON request to the docker container, and forward the response back to the javascript code.

# Installation

## Docker-compose file

A new docker container needs to be added to the docker-compose of Nextcloud:
```
version: '3'
services:  
  ...
  transmission:
    image: qdii/transmission
    container_name: transmission
    environment:
      - PUID=1000
      - PGID=1000
      - TZ=Europe/London
    volumes:
      - /config
      - transmission-downloads:/downloads
      - /watch
    ports:
      - 9091:9091
      - 51413:51413
      - 51413:51413/udp
    restart: unless-stopped

  app:
    image: nextcloud:fpm-alpine
    restart: always
    volumes:
      - nextcloud:/var/www/html
      - /home/qdii/pub/nextcloud/data:/var/www/html/data/qdii/files
      - transmission-downloads:/transmission
    environment:
      - MYSQL_HOST=db
      - REDIS_HOST=redis
    env_file:
      - db.env
    depends_on:
      - db
      - redis


volumes:
  ...
  transmission-downloads:
```
## External storage
To let you download your torrents through Nextcloud UI, you will need to add the shared volume as an external storage.
For add a **Local Storage** pointing to the `/transmission` folder, and allow your user to access this local storage.

