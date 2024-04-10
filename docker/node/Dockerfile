FROM node:latest
WORKDIR /var/www
COPY ./www/package*.json ./
COPY ./www ./
RUN npm install \
    && npm install resolve-url-loader@^5.0.0 --save-dev --legacy-peer-deps \
    && npm install laravel-mix@latest --save-dev \
    && npm install --save-dev @babel/core @babel/preset-env babel-loader \
    && npm install --save-dev @babel/preset-env vue-loader
CMD ["npm", "run", "dev"]