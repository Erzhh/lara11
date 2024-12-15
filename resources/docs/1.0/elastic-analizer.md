# [Elasticsearch Analyzer Documentation](#analyzer)

- [Introduction](#introduction)
- [Create Index with Custom Analyzer](#create_analyzer)
- [Test Analyzer](#test_analyzer)
- [Delete Index](#delete_index)

---

<a name="introduction"></a>
## [Introduction](#introduction)

`Analyzer` в Elasticsearch — это компонент, который обрабатывает текст для создания токенов, подготавливая данные для поиска. Он состоит из:
- **Tokenizer**: разделяет текст на токены (слова, фразы).
- **Filters**: обрабатывают токены (например, удаление стоп-слов, приведение к нижнему регистру).

### Полезные ссылки
- [Официальная документация](https://www.elastic.co/guide/en/elasticsearch/reference/current/analysis.html)


---


<a name="create_analyzer"></a>
## [Create Index with Custom Analyzer](#create_analyzer)

### Запрос
```json
{
    "Метод": "PUT",
    "Путь": "/custom_analyzer_index"
}
```

### Request
```json
{
    "settings": {
        "analysis": {
            "analyzer": {
                "custom_analyzer": {
                    "type": "custom",
                    "tokenizer": "standard",
                    "filter": ["lowercase", "asciifolding", "stop", "snowball"]
                }
            }
        }
    },
    "mappings": {
        "properties": {
            "title": { "type": "text", "analyzer": "custom_analyzer" },
            "description": { "type": "text", "analyzer": "custom_analyzer" }
        }
    }
}
```

### Response 200
```json
{
    "acknowledged": true,
    "shards_acknowledged": true,
    "index": "custom_analyzer_index"
}
```

### Description
```text
custom_analyzer:
    Tokenizer: standard — стандартный токенайзер для разбивки текста.
    Filters:
        lowercase: приводит текст к нижнему регистру.
        asciifolding: удаляет акценты (например, é → e).
        stop: удаляет стоп-слова (например, "and", "or").
        snowball: стемминг (приведение слов к базовой форме).
```

---


<a name="test_analyzer"></a>
## [Test Analyzer](#test_analyzer)

### Запрос
```json
{
    "Метод": "GET",
    "Путь": "/custom_analyzer_index/_analyze"
}
```

### Request
```json
{
    "analyzer": "custom_analyzer",
    "text": "Elasticsearch is a powerful search engine!"
}
```

### Response 200
```json
{
    "tokens": [
        { "token": "elasticsearch", "start_offset": 0, "end_offset": 14, "position": 1 },
        { "token": "power", "start_offset": 19, "end_offset": 25, "position": 2 },
        { "token": "search", "start_offset": 26, "end_offset": 32, "position": 3 },
        { "token": "engin", "start_offset": 33, "end_offset": 39, "position": 4 }
    ]
}
```

### Description
```text
Этот запрос позволяет протестировать работу анализатора custom_analyzer. Мы видим результат стемминга и других фильтров
```


---


<a name="delete_index"></a>
## [Delete Index](#delete_index)

### Запрос
```json
{
    "Метод": "DELETE",
    "Путь": "/custom_analyzer_index"
}
```

### Request
```json

```

### Response 200
```json
{
    "acknowledged": true
}
```
