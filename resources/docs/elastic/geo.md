# GEO Queries

#### `Geo Queries` - позволяют выполнять поиск, фильтрацию и агрегацию документов на основе географических координат


## 🏗 Создание индекса adverts с географическим полем
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
      "location": { "type": "geo_point" }
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


## Добавление объявлений с географическими координатами
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
{ "title": "Apartment in New York", "description": "2-room apartment near Central Park", "price": 2500, "location": { "lat": 40.785091, "lon": -73.968285 } }

{ "index": { "_id": "2" } }
{ "title": "House in Los Angeles", "description": "4-bedroom house in Beverly Hills", "price": 4500, "location": { "lat": 34.090009, "lon": -118.406773 } }

{ "index": { "_id": "3" } }
{ "title": "Studio in San Francisco", "description": "Modern studio near downtown", "price": 3200, "location": { "lat": 37.774929, "lon": -122.419416 } }

{ "index": { "_id": "4" } }
{ "title": "Villa in Miami", "description": "Luxury villa with ocean view", "price": 5500, "location": { "lat": 25.761681, "lon": -80.191788 } }

{ "index": { "_id": "5" } }
{ "title": "Flat in Chicago", "description": "Cozy flat near downtown", "price": 2100, "location": { "lat": 41.878113, "lon": -87.629799 } }
```

### Response 200
```json
{
  "errors": false,
  "took": 27,
  "items": [
    {
      "index": {
        "_index": "adverts",
        "_id": "1",
        "_version": 1,
        "result": "created",
        "_shards": {
          "total": 2,
          "successful": 1,
          "failed": 0
        },
        "_seq_no": 0,
        "_primary_term": 1,
        "status": 201
      }
    }
  ]
}
```


---


## 📍 a. Фильтр по радиусу (geo_distance)
### Ищет документы в пределах заданного радиуса от указанной точки
### Запрос - Ищем объявления в радиусе 50 км от Нью-Йорка
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
    "bool": {
      "filter": {
        "geo_distance": {
          "distance": "50km",
          "location": {
            "lat": 40.785091,
            "lon": -73.968285
          }
        }
      }
    }
  }
}
```

### Response 200
```json
{
  "took": 45,
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
          "title": "Apartment in New York",
          "description": "2-room apartment near Central Park",
          "price": 2500,
          "location": {
            "lat": 40.785091,
            "lon": -73.968285
          }
        }
      }
    ]
  }
}
```


---


## 📍 b. Поиск по ограниченной области (geo_bounding_box)
### Ищем объявления в северо-восточной части США, ограниченной координатами
- Верхний левый угол: `(42.0, -75.0)`
- Нижний правый угол: `(39.0, -72.0)`
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
    "bool": {
      "filter": {
        "geo_bounding_box": {
          "location": {
            "top_left": {
              "lat": 42.0,
              "lon": -75.0
            },
            "bottom_right": {
              "lat": 39.0,
              "lon": -72.0
            }
          }
        }
      }
    }
  }
}

```
### Response 200
```json
{
  "took": 4,
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
          "title": "Apartment in New York",
          "description": "2-room apartment near Central Park",
          "price": 2500,
          "location": {
            "lat": 40.785091,
            "lon": -73.968285
          }
        }
      }
    ]
  }
}
```


---


## 📍 c. Поиск по гео-полигону (geo_polygon)
### Ищем объявления, внутри треугольной области, заданной тремя точками
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
    "bool": {
      "filter": {
        "geo_polygon": {
          "location": {
            "points": [
              { "lat": 40.0, "lon": -75.0 },
              { "lat": 42.0, "lon": -72.0 },
              { "lat": 39.0, "lon": -118.0 }
            ]
          }
        }
      }
    }
  }
}
```

### Response 200
```json
{
  "took": 5,
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
          "title": "Apartment in New York",
          "description": "2-room apartment near Central Park",
          "price": 2500,
          "location": {
            "lat": 40.785091,
            "lon": -73.968285
          }
        }
      }
    ]
  }
}
```


---


## 📍 d. Сортировка по расстоянию (geo_distance + sort)
### Ищем все объявления, отсортированные по расстоянию от Чикаго
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
  "sort": [
    {
      "_geo_distance": {
        "location": {
          "lat": 41.878113,
          "lon": -87.629799
        },
        "order": "asc",
        "unit": "km"
      }
    }
  ],
  "query": {
    "match_all": {}
  }
}
```

### Response 200
```json
{
  "took": 6,
  "timed_out": false,
  "_shards": {
    "total": 1,
    "successful": 1,
    "skipped": 0,
    "failed": 0
  },
  "hits": {
    "total": {
      "value": 5,
      "relation": "eq"
    },
    "max_score": null,
    "hits": [
      {
        "_index": "adverts",
        "_id": "5",
        "_score": null,
        "_source": {
          "title": "Flat in Chicago",
          "description": "Cozy flat near downtown",
          "price": 2100,
          "location": {
            "lat": 41.878113,
            "lon": -87.629799
          }
        },
        "sort": [
          0
        ]
      },
      {
        "_index": "adverts",
        "_id": "1",
        "_score": null,
        "_source": {
          "title": "Apartment in New York",
          "description": "2-room apartment near Central Park",
          "price": 2500,
          "location": {
            "lat": 40.785091,
            "lon": -73.968285
          }
        },
        "sort": [
          1145.911173735667
        ]
      },
      {
        "_index": "adverts",
        "_id": "4",
        "_score": null,
        "_source": {
          "title": "Villa in Miami",
          "description": "Luxury villa with ocean view",
          "price": 5500,
          "location": {
            "lat": 25.761681,
            "lon": -80.191788
          }
        },
        "sort": [
          1917.3162171621834
        ]
      },
      {
        "_index": "adverts",
        "_id": "2",
        "_score": null,
        "_source": {
          "title": "House in Los Angeles",
          "description": "4-bedroom house in Beverly Hills",
          "price": 4500,
          "location": {
            "lat": 34.090009,
            "lon": -118.406773
          }
        },
        "sort": [
          2815.436529066584
        ]
      },
      {
        "_index": "adverts",
        "_id": "3",
        "_score": null,
        "_source": {
          "title": "Studio in San Francisco",
          "description": "Modern studio near downtown",
          "price": 3200,
          "location": {
            "lat": 37.774929,
            "lon": -122.419416
          }
        },
        "sort": [
          2984.9120174123145
        ]
      }
    ]
  }
}
```


---


## 📍 e. Гео-диапазон с несколькими фильтрами (geo_distance + range)
### Ищем дома дороже 3000$, находящиеся в радиусе 100 км от Лос-Анджелеса
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
    "bool": {
      "filter": [
        {
          "geo_distance": {
            "distance": "100km",
            "location": {
              "lat": 34.090009,
              "lon": -118.406773
            }
          }
        },
        {
          "range": {
            "price": {
              "gte": 3000
            }
          }
        }
      ]
    }
  }
}
```

### Response 200
```json
{
  "took": 5,
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
          "title": "House in Los Angeles",
          "description": "4-bedroom house in Beverly Hills",
          "price": 4500,
          "location": {
            "lat": 34.090009,
            "lon": -118.406773
          }
        }
      }
    ]
  }
}
```


---



## 📍 f. Гео-агрегация (geo_distance + aggs)
### Выполняем агрегацию по радиусам от Лос-Анджелеса
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
  "size": 0,
  "aggs": {
    "adverts_by_distance": {
      "geo_distance": {
        "field": "location",
        "origin": "34.090009, -118.406773",
        "ranges": [
          { "to": 100 },
          { "from": 100, "to": 500 },
          { "from": 500 }
        ]
      }
    }
  }
}
```

### Response 200
```json
{
  "took": 5,
  "timed_out": false,
  "_shards": {
    "total": 1,
    "successful": 1,
    "skipped": 0,
    "failed": 0
  },
  "hits": {
    "total": {
      "value": 5,
      "relation": "eq"
    },
    "max_score": null,
    "hits": []
  },
  "aggregations": {
    "adverts_by_distance": {
      "buckets": [
        {
          "key": "*-100.0",
          "from": 0,
          "to": 100,
          "doc_count": 1
        },
        {
          "key": "100.0-500.0",
          "from": 100,
          "to": 500,
          "doc_count": 0
        },
        {
          "key": "500.0-*",
          "from": 500,
          "doc_count": 4
        }
      ]
    }
  }
}
```
