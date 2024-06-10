# [Аэропорт](#list)

- [Список](#list)

<a name="list"></a>
## [Список](#list)

### Запрос
```json
{
    "Метод" : "GET",
    "Путь" : "/api/airports"
}
```

### Headers
```json
{
    "Accept" : "application/json"
}
```

### Query Params
```json
'query': 'ABQ'
```

### Response 200
```json
{
    "ABQ": {
        "cityName": {
            "ru": "Альбукерке",
            "en": "Albuquerque"
        },
        "area": null,
        "country": "US",
        "lat": 35.04199,
        "lng": -106.60697,
        "timezone": "America/Denver"
    }
}
```
