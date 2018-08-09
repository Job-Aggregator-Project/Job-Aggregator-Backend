## View a vacancy

`GET /vacancies/{vacancy_id}` will return a detailed information on the indicated vacancy


```json
{
    "id": 438,
    "originalId": "27132447",
    "name": "Программист 1С",
    "area": "Алматы",
    "url": "https://hh.ru/vacancy/27132447",
    "salaryTo": "0",
    "salaryFrom": "0",
    "currency": "null",
    "logo": "https://hhcdn.ru/employer-logo-original/515912.jpg",
    "employer": "SCS-Almaty",
    "experience": "3–6 лет",
    "description": "IT-компания SCS приглашает на постоянную работу 1C разработчика"
}
```

## View all vacancies

`GET /vacancies` will return all vacancies with pagination


```json
{
    "current_page": 1,
    "data": [
        {
            "id": 438,
            "originalId": "27132447",
            "name": "Программист 1С",
            "area": "Алматы",
            "url": "https://hh.ru/vacancy/27132447",
            "salaryTo": "0",
            "salaryFrom": "0",
            "currency": "null",
            "logo": "https://hhcdn.ru/employer-logo-original/515912.jpg",
            "employer": "SCS-Almaty",
            "experience": "3–6 лет",
            "description": "IT-компания SCS приглашает на постоянную работу 1C разработчика"
        }
    ],
    "first_page_url": "http://jobag.vkzhuk.com/api/vacancies?page=1",
    "from": 1,
    "last_page": 99,
    "last_page_url": "http://jobag.vkzhuk.com/api/vacancies?page=99",
    "next_page_url": "http://jobag.vkzhuk.com/api/vacancies?page=2",
    "path": "http://jobag.vkzhuk.com/api/vacancies",
    "per_page": 20,
    "prev_page_url": null,
    "to": 20,
    "total": 1980
}
```

## Pagination

`GET /vacancies/?page=number` will return all vacancies on the page

## Search

`GET /vacancies/?name=value&area=value` will return the results of vacancy search.

key | type 
---- | ---- 
name| string 
area | string 
description | string 

Example `http://127.0.0.1:8000/api/vacancies/?name=php&area=Москва`

## All vacancies

`GET /vacancies/all` will return all vacancies