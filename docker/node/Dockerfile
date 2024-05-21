FROM node:14
WORKDIR /var/www
COPY ./www/package*.json ./
RUN npm install \
    && npm install laravel-mix@latest resolve-url-loader@^5.0.0 @babel/core @babel/preset-env babel-loader vue-loader@next @vue/compiler-sfc tailwindcss postcss-import bootstrap axios --save-dev --legacy-peer-deps
COPY ./www ./
