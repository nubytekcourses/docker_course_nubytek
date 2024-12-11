# Usar imagen base de Python
FROM python:3.9-slim

# Establecer directorio de trabajo
WORKDIR /app

# Copiar el código fuente
COPY . .

# Instalar las dependencias
RUN pip install -r requirements.txt

# Exponer puerto para el servicio de usuarios
EXPOSE 5000

# Comando para ejecutar el servidor Flask
CMD ["python", "app.py"]
