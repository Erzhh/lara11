## **Типы данных в Elasticsearch с несколькими значениями, правилами минимальных и максимальных значений, ограничениями**

---

## 📋 **1. Текстовые Типы**  

### a. `text` (анализируемый текст)
- **Использование:** Полнотекстовый поиск.
- **Ограничения:** Нельзя задать минимальные или максимальные значения, но можно ограничить длину токенов через анализаторы (`tokenizer`, `filters`).

```json
PUT /products
{
    "mappings": {
        "properties": {
        "tags": { "type": "text" }
        }
    }
}

POST /products/_doc/1
{
    "tags": ["смартфоны", "гаджеты", "электроника"]
}
```


---


### b. keyword (точное совпадение)
- **Использование:** Фильтры, агрегации, сортировка.
- **Ограничения:** `ignore_above` — максимальная длина строки (по умолчанию 256).

```json
PUT /products
{
    "mappings": {
        "properties": {
            "categories": {
                "type": "keyword",
                "ignore_above": 100
            }
        }
    }
}

POST /products/_doc/2
{
    "categories": ["phones", "laptops", "accessories"]
}
```


---


#🔢 2. Числовые Типы

### a. integer, long, short, byte (целые числа)
- **Использование:** Подсчет, фильтрация, агрегации.
- **Ограничения:** Минимум и максимум через `range`. Elasticsearch не поддерживает жесткие ограничения в `mappings`
```json
PUT /products
{
    "mappings": {
        "properties": {
            "ratings": { "type": "integer" }
        }
    }
}

POST /products/_doc/3
{
    "ratings": [1, 3, 5, 7, 9]
}
```


---


### b. float, double (числа с плавающей точкой)
- **Использование:** Цены, измерения.
- **Ограничения:** Ограничения минимальных и максимальных значений — через `range`.
```json
PUT /products
{
    "mappings": {
        "properties": {
            "prices": { "type": "float" }
        }
    }
}

POST /products/_doc/4
{
    "prices": [199.99, 299.99, 499.99]
}
```


---


### 📅 3. Дата и время `date`
- **Использование:** События, даты обновлений.
- **Ограничения:** `format` — настройка формата даты. Ограничения задаются через range. `range`.
```json
PUT /products
{
    "mappings": {
        "properties": {
            "release_dates": {
                "type": "date",
                "format": "yyyy-MM-dd"
            }
        }
    }
}

POST /products/_doc/5
{
    "release_dates": ["2023-01-01", "2024-01-01", "2025-01-01"]
}
```


---


### 🔵 4. Булевые значения `boolean`
- **Использование:** Флаги, индикаторы.
- **Ограничения:** `true` / `false` (минимум и максимум не применимы).
```json
PUT /products
{
    "mappings": {
        "properties": {
            "features": { "type": "boolean" }
        }
    }
}

POST /products/_doc/6
{
    "features": [true, false, true]
}
```


---


### 📍 5. Географические Типы `geo_point`
- **Использование:** Координаты (широта, долгота).
- **Ограничения:** `Минимум и максимум задаются через `range` запросы
```json
PUT /products
{
    "mappings": {
        "properties": {
            "locations": { "type": "geo_point" }
        }
    }
}

POST /products/_doc/7
{
    "locations": [
        { "lat": 40.7128, "lon": -74.0060 },
        { "lat": 34.0522, "lon": -118.2437 }
    ]
}
```


---


### 🏗 6. Специальные Типы


- **`nested`:** (вложенные объекты)
- **Использование:** Хранение сложных объектов
```json
PUT /products
{
  "mappings": {
    "properties": {
      "reviews": {
        "type": "nested",
        "properties": {
          "author": { "type": "text" },
          "rating": { "type": "integer" }
        }
      }
    }
  }
}

POST /products/_doc/8
{
  "reviews": [
    { "author": "John", "rating": 5 },
    { "author": "Jane", "rating": 4 }
  ]
}
```

---


- **`object`:** (простой вложенный объект)
```json
POST /products/_doc/9
{
    "manufacturer": {
        "name": "Apple",
        "models": ["iPhone 14", "MacBook Pro"]
    }
}
```

---


### 🔢 7. Диапазоны (Range)

- **`integer_range`:**
- **Использование:** Диапазоны чисел
```json
POST /products/_doc/10
{
    "age_ranges": [
        { "gte": 18, "lte": 25 },
        { "gte": 26, "lte": 35 }
    ]
}
```

---

- **`date_range`:**
- **Использование:** Периоды времени
```json
POST /products/_doc/11
{
    "sale_periods": [
        { "gte": "2024-01-01", "lte": "2024-01-31" },
        { "gte": "2024-06-01", "lte": "2024-06-30" }
    ]
}
```
