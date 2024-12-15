# geo_shape в Elasticsearch на примере базы данных Adverts

#### Использование `geo_shape` позволяет хранить сложные географические формы, такие как полигоны, линии и многоугольники. Elasticsearch поддерживает точные пространственные запросы с различными отношениями (`intersects`, `within`, `contains`, `disjoint`)

## Объяснение relation в `geo_shape`
- `intersects`: Документы пересекаются с заданной формой.
- `within`: Документы полностью находятся внутри заданной формы.
- `contains`: Документы содержат заданную форму.
- `disjoint`: Документы не пересекаются с заданной формой.

## 🏗 Создание индекса adverts с полем geo_shape
### Запрос
```json
{
    "Метод": "PUT",
    "Путь": "/adverts"
}
```

### Body
```json
{
  "mappings": {
    "properties": {
      "title": { "type": "text" },
      "description": { "type": "text" },
      "price": { "type": "float" },
      "area": { "type": "geo_shape" }
    }
  }
}
```

### Response 200
```json
{
  "acknowledged": true,
  "shards_acknowledged": true,
  "index": "adverts"
}
```


---



## 🏗 Добавление документов с geo_shape
### Запрос
```json
{
    "Метод": "POST",
    "Путь": "/adverts/_bulk"
}
```

### Body
```json
{ "index": { "_id": "1" } }
{ "title": "Luxury Villa", "description": "Seaside villa with private beach", "price": 5000, "area": { "type": "polygon", "coordinates": [[[25.7617, -80.1918], [25.7657, -80.1818], [25.7597, -80.1818], [25.7617, -80.1918]]] } }

{ "index": { "_id": "2" } }
{ "title": "Lake House", "description": "House near the lake", "price": 4000, "area": { "type": "envelope", "coordinates": [[40.9352, -73.7306], [40.7128, -73.9070]] } }


{ "index": { "_id": "3" } }
{ "title": "Mountain Cabin", "description": "Cabin in the mountains", "price": 3000, "area": { "type": "lineString", "coordinates": [[35.6762, 139.6503], [35.6895, 139.6917], [35.6822, 139.6500]] } }
```

### Response 200
```json
{
  "errors": false,
  "took": 15,
  "items": [
    {
      "index": {
        "_index": "adverts",
        "_id": "3",
        "_version": 1,
        "result": "created",
        "_shards": {
          "total": 2,
          "successful": 1,
          "failed": 0
        },
        "_seq_no": 1,
        "_primary_term": 1,
        "status": 201
      }
    }
  ]
}
```


---



# 🏗 Примеры запросов с geo_shape

## 📍 a. Фильтр geo_shape с `intersects`
Ищем все объявления, чья область пересекается с многоугольником
### Запрос
```json
{
    "Метод": "POST",
    "Путь": "/adverts/_search"
}
```

### Body
```json
{
  "query": {
    "geo_shape": {
      "area": {
        "shape": {
          "type": "polygon",
          "coordinates": [[[25.7615, -80.1920], [25.7660, -80.1820], [25.7600, -80.1800], [25.7615, -80.1920]]]
        },
        "relation": "intersects"
      }
    }
  }
}
```

### Response 200
```json
{
  "took": 24,
  "timed_out": false,
  "_shards": {
    "total": 1,
    "successful": 1,
    "skipped": 0,
    "failed": 0
  },
  "hits": {
    "total": {
      "value": 1,
      "relation": "eq"
    },
    "max_score": 0,
    "hits": [
      {
        "_index": "adverts",
        "_id": "1",
        "_score": 0,
        "_source": {
          "title": "Luxury Villa",
          "description": "Seaside villa with private beach",
          "price": 5000,
          "area": {
            "type": "polygon",
            "coordinates": [
              [
                [
                  25.7617,
                  -80.1918
                ],
                [
                  25.7657,
                  -80.1818
                ],
                [
                  25.7597,
                  -80.1818
                ],
                [
                  25.7617,
                  -80.1918
                ]
              ]
            ]
          }
        }
      }
    ]
  }
}
```


---



## 📍 b. Поиск по точному совпадению geo_shape с `within`
Ищем объявления, не пересекающиеся с линией
### Запрос
```json
{
    "Метод": "POST",
    "Путь": "/adverts/_search"
}
```

### Body
```json
{
  "query": {
    "geo_shape": {
      "area": {
        "shape": {
          "type": "envelope",
          "coordinates": [[40.9352, -73.7306], [40.7128, -73.9070]]
        },
        "relation": "within"
      }
    }
  }
}
```

### Response 200
```json
{
  "took": 26,
  "timed_out": false,
  "_shards": {
    "total": 1,
    "successful": 1,
    "skipped": 0,
    "failed": 0
  },
  "hits": {
    "total": {
      "value": 1,
      "relation": "eq"
    },
    "max_score": 0,
    "hits": [
      {
        "_index": "adverts",
        "_id": "2",
        "_score": 0,
        "_source": {
          "title": "Lake House",
          "description": "House near the lake",
          "price": 4000,
          "area": {
            "type": "envelope",
            "coordinates": [
              [
                40.9352,
                -73.7306
              ],
              [
                40.7128,
                -73.907
              ]
            ]
          }
        }
      }
    ]
  }
}
```


---


## 📍 c. Пересечение с линией geo_shape и `disjoint`
Ищем все объявления, полностью находящиеся внутри прямоугольной области
### Запрос
```json
{
    "Метод": "POST",
    "Путь": "/adverts/_search"
}
```

### Body
```json
{
  "query": {
    "geo_shape": {
      "area": {
        "shape": {
          "type": "envelope",
          "coordinates": [[40.7500, -73.9500], [40.7000, -73.9000]]
        },
        "relation": "within"
      }
    }
  }
}
```

### Response 200
```json

```


---


## 📍 d. Сложный фильтр с geo_shape и `contains`
Ищем объявления, включающие заданную точку в свои границы
### Запрос
```json
{
    "Метод": "POST",
    "Путь": "/adverts/_search"
}
```

### Body
```json
{
  "query": {
    "geo_shape": {
      "area": {
        "shape": {
          "type": "envelope",
          "coordinates": [[40.7500, -73.9500], [40.7000, -73.9000]]
        },
        "relation": "within"
      }
    }
  }
}
```

### Response 200
```json

```
