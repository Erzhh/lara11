# [Elastic get started](#create)

- [create key](#key)
- [Create doc](#create)
- [Get Mapping](#mapping)
- [Create new mapping index](#new_mapping)
- [Get list adverts](#get_list)
- [Filter by title](#get_adverts_by_search)
- [Delete all keys](#delete_key)


----


<a name="key"></a>
## [Создать обьявление](#key)

## [Источник](https://www.elastic.co/guide/en/elasticsearch/reference/current/getting-started.html)
### Запрос
```json
{
    "Метод" : "PUT",
    "Путь" : "/adverts_get_started"
}
```

### Response
```json
{
  "acknowledged": true,
  "shards_acknowledged": true,
  "index": "adverts_get_started"
}
```


----



<a name="create"></a>
## [Create doc](#create)
### Запрос
```json
{
    "Метод" : "POST",
    "Путь" : "/adverts_get_started/_doc"
}
```

### Request
```json
{
    "title": "Ex dolores qui.",
    "price": 7817.59,
    "room": 1,
    "level": 8,
    "location": {
        "lat": 43.297577,
        "lon": 76.825883
    },
    "updated_at": "2024-12-08T11:38:02.171000Z",
    "created_at": "2024-12-08T11:38:02.171000Z",
    "id": "6755851aa1d48a1eca035792"
}
```

### Response 201
```json
{
    "_index": "adverts_get_started",
    "_id": "D-7tq5MB-4PgWIiJ0wgz",
    "_version": 1,
    "result": "created",
    "_shards": {
        "total": 2,
        "successful": 1,
        "failed": 0
    },
    "_seq_no": 0,
    "_primary_term": 1
}
```


----



<a name="mapping"></a>
## [Get default mapping](#mapping)
### Запрос
```json
{
    "Метод" : "GET",
    "Путь" : "/adverts_get_started/_mapping"
}
```

### Request
```json
```

### Response 201
```json
{
    "adverts_get_started": {
        "mappings": {
            "properties": {
                "created_at": {
                    "type": "date"
                },
                "id": {
                    "type": "text",
                    "fields": {
                        "keyword": {
                            "type": "keyword",
                            "ignore_above": 256
                        }
                    }
                },
                "level": {
                    "type": "long"
                },
                "location": {
                    "properties": {
                        "lat": {
                            "type": "float"
                        },
                        "lon": {
                            "type": "float"
                        }
                    }
                },
                "price": {
                    "type": "float"
                },
                "room": {
                    "type": "long"
                },
                "title": {
                    "type": "text",
                    "fields": {
                        "keyword": {
                            "type": "keyword",
                            "ignore_above": 256
                        }
                    }
                },
                "updated_at": {
                    "type": "date"
                }
            }
        }
    }
}
```


----



<a name="new_mapping"></a>
## [Create new mapping index](#new_mapping)
### Запрос
```json
{
    "Метод" : "PUT",
    "Путь" : "/adverts_get_started_1"
}
```

### Request
```json
{
  "settings": {
    "index": {
      "number_of_shards": 1,
      "number_of_replicas": 1,
      "routing": {
        "allocation": {
          "include": {
            "_tier_preference": "data_content"
          }
        }
      }
    }
  },
  "mappings": {
    "properties": {
      "created_at": {
        "type": "date"
      },
      "id": {
        "type": "text",
        "fields": {
          "keyword": {
            "type": "keyword",
            "ignore_above": 256
          }
        }
      },
      "level": {
        "type": "long"
      },
      "location": {
        "type": "geo_point" 
      },
      "price": {
        "type": "float"
      },
      "room": {
        "type": "long"
      },
      "title": {
        "type": "text",
        "fields": {
          "keyword": {
            "type": "keyword",
            "ignore_above": 256
          }
        }
      },
      "updated_at": {
        "type": "date"
      }
    }
  }
}
```

### Response 200
```json
{
    "acknowledged": true,
    "shards_acknowledged": true,
    "index": "adverts_get_started_1"
}
```


---



<a name="get_list"></a>
## [Get list adverts](#get_list)
### Запрос
```json
{
    "Метод" : "GET",
    "Путь" : "/adverts_get_started/_search"
}
```

### Request
```json
```

### Response 200
```json
{
    "took": 1,
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
        "max_score": 1,
        "hits": [
            {
                "_index": "adverts_get_started",
                "_id": "D-7tq5MB-4PgWIiJ0wgz",
                "_score": 1,
                "_source": {
                    "title": "Ex dolores qui.",
                    "price": 7817.59,
                    "room": 1,
                    "level": 8,
                    "location": {
                        "lat": 43.297577,
                        "lon": 76.825883
                    },
                    "updated_at": "2024-12-08T11:38:02.171000Z",
                    "created_at": "2024-12-08T11:38:02.171000Z",
                    "id": "6755851aa1d48a1eca035792"
                }
            }
        ]
    }
}
```



---



<a name="get_adverts_by_search"></a>
## [Filter by title](#get_adverts_by_search)
### Запрос
```json
{
    "Метод" : "POST",
    "Путь" : "/adverts_get_started/_search"
}
```

### Request
```json
{
    "query": {
        "match": {
            "title": "Ex"
        }
    }
}
```

### Response 200
```json
{
    "took": 2,
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
        "max_score": 0.2876821,
        "hits": [
            {
                "_index": "adverts_get_started",
                "_id": "D-7tq5MB-4PgWIiJ0wgz",
                "_score": 0.2876821,
                "_source": {
                    "title": "Ex dolores qui.",
                    "price": 7817.59,
                    "room": 1,
                    "level": 8,
                    "location": {
                        "lat": 43.297577,
                        "lon": 76.825883
                    },
                    "updated_at": "2024-12-08T11:38:02.171000Z",
                    "created_at": "2024-12-08T11:38:02.171000Z",
                    "id": "6755851aa1d48a1eca035792"
                }
            }
        ]
    }
}
```


---



<a name="delete_key"></a>
## [Delete all keys](#delete_key)
### Запрос
```json
{
    "Метод" : "DELETE",
    "Путь" : "/adverts_get_started",
    "Путь 2" : "/adverts_get_started_1"
}
```

### Request
```json
```

