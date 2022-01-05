FROM node:lts-alpine3.14

WORKDIR /app

ENV PATH /app/node_modules/.bin:$PATH

COPY ../../front/package.json /app/package.json

RUN yarn
RUN yarn add global @vue/cli

EXPOSE 8080
CMD [ "yarn", "serve" ]
