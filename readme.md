## View a vacancy

`GET /vacancies/{vacancy_id}` will return a detailed information on the indicated vacancy


```json
{
    "id": 78,
    "name": "Менеджер по продажам",
    "area": "Москва",
    "url": "https://hh.ru/vacancy/26890855"
}
```

## View all vacancies

`GET /vacancies` will return all vacancies


```json
[
    {
        "id": 1,
        "name": "Электросварщик судовой",
        "area": "Киренск",
        "url": "https://hh.ru/vacancy/27167786"
    },
    {
        "id": 2,
        "name": "Продавец-консультант",
        "area": "Иркутск",
        "url": "https://hh.ru/vacancy/27167785"
    },
    {
        "id": 3,
        "name": "Наборщик текста на компьютере",
        "area": "Алматы",
        "url": "https://career.ru/vacancy/27167782"
    },
    {
        "id": 4,
        "name": "Наборщик текста на компьютере",
        "area": "Астана",
        "url": "https://career.ru/vacancy/27167783"
    },
    {
        "id": 5,
        "name": "Шеф-повар/Кондитер",
        "area": "Санкт-Петербург",
        "url": "https://hh.ru/vacancy/27167781"
    }
]
