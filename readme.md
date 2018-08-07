## View a vacancy

`GET /vacancies/{vacancy_id}` will return a detailed information on the indicated vacancy


```json
{
    "id": 781,
    "originalId": "27215293",
    "name": "Администратор клиники на телефон",
    "area": "Королев",
    "url": "https://career.ru/vacancy/27215293",
    "salaryTo": "33000",
    "salaryFrom": "30000",
    "currency": "RUR",
    "logo": "https://hhcdn.ru/employer-logo-original/255053.jpg",
    "employer": "Женское здоровье",
    "experience": "null"
}
```

## View all vacancies

`GET /vacancies` will return all vacancies


```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name": "Продавец-консультант",
            "area": "Москва",
            "url": "https://hh.ru/vacancy/26725000",
            "salaryTo": "NULL",
            "salaryFrom": "NULL",
            "currency": "NULL"
        },
        {
            "id": 2,
            "name": "Специалист по сопровождению государственных контрактов/договоров",
            "area": "Москва",
            "url": "https://hh.ru/vacancy/26955687",
            "salaryTo": "50000",
            "salaryFrom": "30000",
            "currency": "RUR"
        }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/vacancies?page=1",
    "from": 1,
    "last_page": 99,
    "last_page_url": "http://127.0.0.1:8000/api/vacancies?page=99",
    "next_page_url": "http://127.0.0.1:8000/api/vacancies?page=2",
    "path": "http://127.0.0.1:8000/api/vacancies",
    "per_page": 20,
    "prev_page_url": null,
    "to": 20,
    "total": 1980
}
```

## Pagination

`GET /vacancies/?page=number` will return all vacancies on the page

```json
{
    "current_page": 10,
    "data": [
        {
            "id": 181,
            "name": "Продавец-консультант",
            "area": "Санкт-Петербург",
            "url": "https://hh.ru/vacancy/27127243",
            "salaryTo": "30000",
            "salaryFrom": "NULL",
            "currency": "RUR"
        },
        {
            "id": 182,
            "name": "Операционный директор",
            "area": "Санкт-Петербург",
            "url": "https://hh.ru/vacancy/26343644",
            "salaryTo": "NULL",
            "salaryFrom": "170000",
            "currency": "RUR"
        }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/vacancies?page=1",
    "from": 181,
    "last_page": 99,
    "last_page_url": "http://127.0.0.1:8000/api/vacancies?page=99",
    "next_page_url": "http://127.0.0.1:8000/api/vacancies?page=11",
    "path": "http://127.0.0.1:8000/api/vacancies",
    "per_page": 20,
    "prev_page_url": "http://127.0.0.1:8000/api/vacancies?page=9",
    "to": 200,
    "total": 1980
}
```

## Search

`GET /vacancies/?name=value&area=value` will return the results of vacancy search.

Example `http://127.0.0.1:8000/api/vacancies/?name=php&area=Москва`
```json
{
    "current_page": 1,
    "data": [
        {
            "id": 60,
            "name": "Web-программист / PHP программист",
            "area": "Москва",
            "url": "https://hh.ru/vacancy/27063988",
            "salaryTo": "60000",
            "salaryFrom": "30000",
            "currency": "RUR"
        },
        {
            "id": 89,
            "name": "Senior backend PHP developer (проект Dropwow)",
            "area": "Москва",
            "url": "https://hh.ru/vacancy/27042764",
            "salaryTo": "200000",
            "salaryFrom": "160000",
            "currency": "RUR"
        },
        {
            "id": 216,
            "name": "PHP Программист/разработчик 1С Битрикс (Bitrix) Удаленно/офис",
            "area": "Москва",
            "url": "https://hh.ru/vacancy/26813462",
            "salaryTo": "NULL",
            "salaryFrom": "NULL",
            "currency": "NULL"
        }
    ],
    "first_page_url": "http://127.0.0.1:8000/api/vacancies?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://127.0.0.1:8000/api/vacancies?page=1",
    "next_page_url": null,
    "path": "http://127.0.0.1:8000/api/vacancies",
    "per_page": 20,
    "prev_page_url": null,
    "to": 6,
    "total": 6
}
```