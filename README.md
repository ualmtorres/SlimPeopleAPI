# API REST con datos de ejemplo

Este proyecto es un despliegue de una API REST con datos de ejemplo. Consta de 100 registros ficticios de persona generados con [Faker](https://github.com/fzaninotto/Faker). La API REST está desarrollada con Slim y se despliega con Docker. El proyecto se compone de dos contenedores, uno para Slim y otro para Nginx.

Este proyecto es una continuación de [SlimHelloWorld](https://github.com/ualmtorres/SlimHelloWorld).

## Instalación

Basta con clonar el repositorio y ejecutar el siguiente comando:

```bash
docker-compose up -d
```

## Acceso a la API REST

La API REST se despliega en `http://localhost:8080`. Si accedemos a `http://localhost:8080/api/people`, deberíamos ver un listado de 100 registros ficticios de persona.

```json
{
    "status": 200,
    "message": [
        {
            "id": 3,
            "name": "Benjamin Bernhard",
            "email": "elinore.hegmann@yahoo.com",
            "phoneNumber": "+1-760-770-5452",
            "dateOfBirth": "2012-03-20",
            "company": "Miller, Nader and Prosacco",
            "imageUrl": "https://via.placeholder.com/640x480.png/002266?text=recusandae",
            "address": {
                "street": "Dell Hills",
                "number": "6923",
                "city": "Mayertfurt",
                "state": "Louisiana",
                "zip": "22036"
            },
            "description": "Porro occaecati quia doloremque eos incidunt. Accusantium dolorem est voluptatem. Iusto quia doloribus molestiae explicabo expedita sit error.",
            "favoriteColors": [
                "black",
                "white",
                "lime"
            ]
        },
        ...
    ]
}
```

Los endpoints disponibles son los siguientes:

- `GET /api/people`: Listado de personas.
- `GET /api/people/{id}`: Detalle de una persona.
- `GET /api/peopleByEmail?email={email}`: Búsqueda de personas por email.
  
  