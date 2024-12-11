
#Instalar dependencias

FROM node:18 AS dependencies  

WORKDIR /app

COPY package.json package-lock.json ./

RUN npm ci

# Ejecutar pruebas

FROM dependencies AS test
COPY . .
RUN npm test && echo "Pruebas completadas correctamente" > /pruebas


# Construir la aplicación

FROM dependencies AS build

COPY . .
RUN npm run build

# Imagen final para produccion

FROM node:18-alpine AS production

WORKDIR /app
COPY --from=build /app/dist ./dist
COPY --from=dependencies /app/node_modules ./node_modules
COPY --from=test /pruebas /pruebas

EXPOSE 3000
CMD ["node", "dist/index.js"]