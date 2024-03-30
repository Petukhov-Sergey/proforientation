FROM node:latest
WORKDIR /var/www
COPY ./www/package*.json ./
RUN npm install
COPY ./www ./
RUN npm run build