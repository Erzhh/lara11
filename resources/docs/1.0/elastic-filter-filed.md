# [Elastic search by field](#create)

- [create key](#key)
- [Create advert bulk](#create)
- [Delete all keys](#delete_key)


----


<a name="key"></a>
## [Создать обьявление](#key)

## [Источник](https://www.elastic.co/guide/en/elasticsearch/reference/current/full-text-filter-tutorial.html)
### Запрос
```json
{
    "Метод" : "PUT",
    "Путь" : "/adverts_search_field"
}
```

### Request
```json
{
    "mappings": {
        "properties": {
            "title": { "type": "text" },
            "description": { "type": "text" },
            "price": { "type": "float" },
            "room": { "type": "integer" },
            "level": { "type": "integer" },
            "location": {
                "type": "geo_point"
            },
            "updated_at": { "type": "date" },
            "created_at": { "type": "date" },
            "id": { "type": "keyword" }
        }
    }
}
```


### Response 200
```json
{
    "acknowledged": true,
    "shards_acknowledged": true,
    "index": "adverts_search_field"
}
```


----


<a name="create"></a>
## [Create advert bulk](#create)
### Запрос
```json
{
    "Метод" : "POST",
    "Путь" : "/adverts_search_field/_bulk"
}
```

### Request
```json
{ "index": { "_id": "6755851aa1d48a1eca035792" } }
{ "title": "Ex dolores qui.", "description": "An example description for Ex dolores qui.", "price": 7817.59, "room": 1, "level": 8, "location": { "lat": 43.297577, "lon": 76.825883 }, "updated_at": "2024-12-08T11:38:02.171000Z", "created_at": "2024-12-08T11:38:02.171000Z", "id": "6755851aa1d48a1eca035792" }
{ "index": { "_id": "6755851aa1d48a1eca035793" } }
{ "title": "Similique et dolore ad.", "description": "An example description for Similique et dolore ad.", "price": 3663.56, "room": 2, "level": 5, "location": { "lat": 43.347281, "lon": 76.905448 }, "updated_at": "2024-12-08T11:38:02.172000Z", "created_at": "2024-12-08T11:38:02.172000Z", "id": "6755851aa1d48a1eca035793" }
{ "index": { "_id": "6755851aa1d48a1eca035794" } }
{ "title": "Esse nam quo.", "description": "An example description for Esse nam quo.", "price": 379.37, "room": 4, "level": 2, "location": { "lat": 43.249814, "lon": 76.916185 }, "updated_at": "2024-12-08T11:38:02.172000Z", "created_at": "2024-12-08T11:38:02.172000Z", "id": "6755851aa1d48a1eca035794" }
{ "index": { "_id": "6755851aa1d48a1eca035795" } }
{ "title": "Voluptatem quia.", "description": "An example description for Voluptatem quia.", "price": 3952.63, "room": 3, "level": 4, "location": { "lat": 43.231186, "lon": 76.875297 }, "updated_at": "2024-12-08T11:38:02.172000Z", "created_at": "2024-12-08T11:38:02.172000Z", "id": "6755851aa1d48a1eca035795" }
{ "index": { "_id": "6755851aa1d48a1eca035796" } }
{ "title": "Et molestiae.", "description": "An example description for Et molestiae.", "price": 2195.48, "room": 3, "level": 8, "location": { "lat": 43.265715, "lon": 76.889532 }, "updated_at": "2024-12-08T11:38:02.172000Z", "created_at": "2024-12-08T11:38:02.172000Z", "id": "6755851aa1d48a1eca035796" }
```

### Response 201
```json
{
  "errors": false,
  "took": 24,
  "items": [
    {
      "index": {
        "_index": "adverts_search_field",
        "_id": "6755851aa1d48a1eca035792",
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


<a name="search"></a>
## [Search by one](#search)
#### search by one filed get to 'title' more privileges then 'description'
#### i give title privileges use ^3
### Запрос
```json
{
    "Метод" : "GET",
    "Путь" : "/adverts_search_field/_search"
}
```

### Request
```json
{
  "query": {
    "multi_match": {
      "query": "dolores qui",
      "fields": ["title^3", "description^2"] 
    }
  }
}
```

### Response 200
```json
{
    "took": 32,
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
        "max_score": 8.081615,
        "hits": [
            {
                "_index": "adverts_search_field",
                "_id": "6755851aa1d48a1eca035792",
                "_score": 8.081615,
                "_source": {
                    "title": "Ex dolores qui.",
                    "description": "An example description for Ex dolores qui.",
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



---


<a name="search"></a>
## [Search one by reducing the field](#search)
#### _source help you reducing the field
### Запрос
```json
{
    "Метод" : "GET",
    "Путь" : "/adverts_search_field/_search"
}
```

### Request
```json
{
    "_source": ["title"],
    "query": {
        "multi_match": {
            "query": "dolores qui",
            "fields": ["title^3", "description^2"]
        }
    }
}
```

### Response 200
```json
{
    "took": 3,
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
        "max_score": 8.081615,
        "hits": [
            {
                "_index": "adverts_search_field",
                "_id": "6755851aa1d48a1eca035792",
                "_score": 8.081615,
                "_source": {
                    "title": "Ex dolores qui."
                }
            }
        ]
    }
}
```


---


<a name="search"></a>
## [Search by multiple](#search)
#### Search title = 'ex' and level > 4 | get only title & level field
### Запрос
```json
{
    "Метод" : "GET",
    "Путь" : "/adverts_search_field/_search"
}
```

### Request
```json
{
    "_source": ["title","level"],
    "query": {
        "bool": {
            "must": [
                {
                    "multi_match": {
                        "query": "dolores qui",
                        "fields": ["title^3", "description^2"]
                    }
                },
                {
                    "range": {
                        "level": {
                            "gte": 8
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
        "max_score": 9.081615,
        "hits": [
            {
                "_index": "adverts_search_field",
                "_id": "6755851aa1d48a1eca035792",
                "_score": 9.081615,
                "_source": {
                    "title": "Ex dolores qui.",
                    "level": 8
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
    "Путь" : "/adverts_search_field"
}
```

### Request
```json
```
