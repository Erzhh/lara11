# Агрегация в Elasticsearch

#### `Агрегация` — это мощный инструмент для группировки, фильтрации и вычисления данных в Elasticsearch. Она позволяет выполнять статистические, числовые и текстовые операции, например:
  - `Группировка (terms)` — разделение документов на категории.
  - `Подсчет (count)` — общее количество документов.
  - `Среднее значение (avg)` — вычисление среднего значения поля.
  - `Минимум/Максимум (min/max)` — поиск минимальных и максимальных значений.
  - `Сумма (sum)` — суммирование чисел.
  - `Гистограмма (histogram)` — группировка по числовым диапазонам.
  - `Дата-гистограмма (date_histogram)` — группировка по временным диапазонам


## 🏗 Создание индекса products
### Запрос
```json
{
    "Метод": "PUT",
    "Путь": "/products"
}
```

### Body
```json
{
  "mappings": {
    "properties": {
      "name": { "type": "text" },
      "category": { "type": "keyword" },
      "price": { "type": "float" },
      "stock": { "type": "integer" },
      "created_at": { "type": "date" }
    }
  }
}
```


---


## 📦 Добавление документов
### Запрос
```json
{
    "Метод": "POST",
    "Путь": "/products/_bulk"
}
```

### Body
```json
{ "index": { "_id": "1" } }
{ "name": "Apple iPhone 14", "category": "electronics", "price": 999.99, "stock": 50, "created_at": "2024-01-01" }
{ "index": { "_id": "2" } }
{ "name": "Samsung Galaxy S22", "category": "electronics", "price": 849.99, "stock": 30, "created_at": "2024-02-01" }
{ "index": { "_id": "3" } }
{ "name": "Sony WH-1000XM4", "category": "accessories", "price": 349.99, "stock": 100, "created_at": "2024-03-01" }
{ "index": { "_id": "4" } }
{ "name": "MacBook Pro 16", "category": "electronics", "price": 2499.99, "stock": 20, "created_at": "2024-04-01" }
{ "index": { "_id": "5" } }
{ "name": "Apple AirPods Pro", "category": "accessories", "price": 249.99, "stock": 150, "created_at": "2024-05-01" }
```


### Response
```json
{
  "errors": false,
  "took": 28,
  "items": [
    {
      "index": {
        "_index": "products",
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
    },
  ]
}
```


---


# 🔍 Примеры агрегаций aggs


---


## 📊 Группировка по категориям (terms)
### Запрос
```json
{
    "Метод": "POST",
    "Путь": "/products/_search"
}
```

### Body
```json
{
  "size": 0,
  "aggs": {
    "products_by_category": {
      "terms": {
        "field": "category",
        "size": 10
      }
    }
  }
}
```


### Response
```json
{
  "aggregations": {
    "products_by_category": {
      "buckets": [
        { "key": "electronics", "doc_count": 3 },
        { "key": "accessories", "doc_count": 2 }
      ]
    }
  }
}
```


---


## 💲 Средняя цена продуктов (avg)
### Запрос
```json
{
    "Метод": "POST",
    "Путь": "/products/_search"
}
```

### Body
```json
{
  "size": 0,
  "aggs": {
    "average_price": {
      "avg": {
        "field": "price"
      }
    }
  }
}
```


### Response
```json
{
  "aggregations": {
    "average_price": {
      "value": 1189.99
    }
  }
}
```


---


## 📉 Минимальная и максимальная цена (min, max)
### Запрос
```json
{
    "Метод": "POST",
    "Путь": "/products/_search"
}
```

### Body
```json
{
  "size": 0,
  "aggs": {
    "min_price": {
      "min": {
        "field": "price"
      }
    },
    "max_price": {
      "max": {
        "field": "price"
      }
    }
  }
}
```


### Response
```json
{
  "aggregations": {
    "min_price": { "value": 249.99 },
    "max_price": { "value": 2499.99 }
  }
}
```


---


## 💲 Средняя цена продуктов (avg)
### Запрос
```json
{
    "Метод": "POST",
    "Путь": "/products/_search"
}
```

### Body
```json
{
  "size": 0,
  "aggs": {
    "average_price": {
      "avg": {
        "field": "price"
      }
    }
  }
}
```


### Response
```json
{
  "aggregations": {
    "average_price": {
      "value": 1189.99
    }
  }
}
```


---


## 📊 Гистограмма цен (histogram)
### Запрос
```json
{
    "Метод": "POST",
    "Путь": "/products/_search"
}
```

### Body
```json
{
  "size": 0,
  "aggs": {
    "price_histogram": {
      "histogram": {
        "field": "price",
        "interval": 500
      }
    }
  }
}
```


### Response
```json
{
  "aggregations": {
    "price_histogram": {
      "buckets": [
        { "key": 0, "doc_count": 0 },
        { "key": 500, "doc_count": 2 },
        { "key": 1000, "doc_count": 2 },
        { "key": 1500, "doc_count": 0 },
        { "key": 2000, "doc_count": 0 },
        { "key": 2500, "doc_count": 1 }
      ]
    }
  }
}
```


---


## 🕒 Агрегация по датам (date_histogram)
### Запрос
```json
{
    "Метод": "POST",
    "Путь": "/products/_search"
}
```

### Body
```json
{
  "size": 0,
  "aggs": {
    "products_over_time": {
      "date_histogram": {
        "field": "created_at",
        "calendar_interval": "month"
      }
    }
  }
}
```


### Response
```json
{
  "aggregations": {
    "products_over_time": {
      "buckets": [
        { "key_as_string": "2024-01-01", "doc_count": 1 },
        { "key_as_string": "2024-02-01", "doc_count": 1 },
        { "key_as_string": "2024-03-01", "doc_count": 1 },
        { "key_as_string": "2024-04-01", "doc_count": 1 },
        { "key_as_string": "2024-05-01", "doc_count": 1 }
      ]
    }
  }
}
```


---



## 📊 Гистограмма цен (histogram)
### Запрос
```json
{
    "Метод": "POST",
    "Путь": "/products/_search"
}
```

### Body
```json
{
  "size": 0,
  "aggs": {
    "price_histogram": {
      "histogram": {
        "field": "price",
        "interval": 500
      }
    }
  }
}
```


### Response
```json
{
  "aggregations": {
    "price_histogram": {
      "buckets": [
        { "key": 0, "doc_count": 0 },
        { "key": 500, "doc_count": 2 },
        { "key": 1000, "doc_count": 2 },
        { "key": 1500, "doc_count": 0 },
        { "key": 2000, "doc_count": 0 },
        { "key": 2500, "doc_count": 1 }
      ]
    }
  }
}
```


---


## 🎯 Комбинированная агрегация (terms + avg)
### Запрос
```json
{
    "Метод": "POST",
    "Путь": "/products/_search"
}
```

### Body
```json
{
  "size": 0,
  "aggs": {
    "products_by_category": {
      "terms": {
        "field": "category",
        "size": 10
      },
      "aggs": {
        "average_price": {
          "avg": {
            "field": "price"
          }
        }
      }
    }
  }
}
```


### Response
```json
{
  "aggregations": {
    "products_by_category": {
      "buckets": [
        {
          "key": "electronics",
          "doc_count": 3,
          "average_price": { "value": 1783.32 }
        },
        {
          "key": "accessories",
          "doc_count": 2,
          "average_price": { "value": 299.99 }
        }
      ]
    }
  }
}
```
