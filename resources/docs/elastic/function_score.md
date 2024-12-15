# Использование function_score в Elasticsearch
## 📌 Цель:

### Настроить ранжирование объявлений по следующим критериям:
  - `Цена (price)`: Дешевые объявления должны получать более высокий score.
  - `Дата обновления (updated_at)`: Более свежие объявления должны быть выше.
  - `Уровень (level)`: Чем выше уровень, тем лучше.


## 🏗 Создание Индекса
### Запрос
```json
{
    "Метод": "PUT",
    "Путь": "/adverts_get_started"
}
```

### Body
```json
{
    "mappings": {
        "properties": {
            "created_at": { "type": "date" },
            "id": { "type": "keyword" },
            "level": { "type": "long" },
            "location": {
                "properties": {
                    "lat": { "type": "float" },
                    "lon": { "type": "float" }
                }
            },
            "price": { "type": "float" },
            "room": { "type": "long" },
            "title": { "type": "text" },
            "updated_at": { "type": "date" }
        }
    }
}
```


---


## 📄 Пример Документа
### Запрос
```json
{
    "Метод": "POST",
    "Путь": "/adverts_get_started/_doc/1"
}
```

### Body
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


---


## 🔍 Запрос с function_score
### Условия:
  - Увеличить score на основе значения level (чем выше, тем лучше).
  - Уменьшить score, если price выше 5000.
  - Повысить документы, обновленные за последние 7 дней.

### Запрос
```json
{
    "Метод": "POST",
    "Путь": "/adverts_get_started/_search"
}
```

### Body
```json
{
"query": {
    "function_score": {
        "query": {
            "match": {
                "title": "dolores"
            }
        },
        "functions": [
            {
                "filter": {
                    "range": {
                        "level": {
                            "gte": 5
                        }
                    }
                },
              "weight": 2
            },
            {
                "filter": {
                    "range": {
                        "price": {
                          "gte": 5000
                        }
                    }
                },
                "weight": 0.5
            },
            {
                "filter": {
                    "range": {
                        "updated_at": {
                          "gte": "now-7d/d"
                        }
                    }
                },
                "weight": 1.5
            }
        ],
        "score_mode": "sum",
        "boost_mode": "multiply"
    }
  }
}
```

### ✅ Пример Ответа (Упрощенный):
```json
{
    "hits": {
        "total": {
            "value": 1,
            "relation": "eq"
        },
        "hits": [
            {
                "_index": "adverts_get_started",
                "_id": "1",
                "_score": 3.75,
                "_source": {
                    "title": "Ex dolores qui.",
                    "price": 7817.59,
                    "level": 8,
                    "updated_at": "2024-12-08T11:38:02.171000Z"
                }
            }
        ]
    }
}
```


---



### 💡 Объяснение:
```text
Основной Запрос:
    Ищем объявления с title, содержащими "dolores".

Функции для изменения score:

    Функция 1 (Уровень):
        Документы с level >= 5 получают дополнительный вес 2.
    
    Функция 2 (Цена):
        Документы с price >= 5000 получают штраф weight: 0.5.
    
    Функция 3 (Обновление):
        Объявления, обновленные за последние 7 дней, получают бонус weight: 1.5.

Режимы работы:
    score_mode: "sum": Суммируем оценки от всех функций.
    boost_mode: "multiply": Умножаем начальный score на итоговый вес.
```
