FROM node:latest
WORKDIR /var/www
COPY ./www/package*.json ./
RUN npm install
COPY ./www ./
ENTRYPOINT ["bash", "-c"]
CMD ["npm install && npm run dev"]

