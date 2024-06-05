# Utiliza la imagen oficial de Node.js versión 18
FROM node:18

# Establece el directorio de trabajo dentro del contenedor
WORKDIR /usr/src/app

# Copia el archivo package.json y package-lock.json (si existe)
COPY package*.json ./

# Instala las dependencias de la aplicación
RUN npm install

# Copia el resto de la aplicación
COPY . .

# Expone el puerto 3000 para que pueda ser accesible desde fuera del contenedor
EXPOSE 3000
EXPOSE 5173

CMD [ "npm", "run", "dev" ]
