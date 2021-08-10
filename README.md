# Important Notes

Please update the `.env` and `.env.testing` when clone the repository in order to system works

# API Map

## Person

### List All People

GET: /api/person

```
Params: null
Response: {
  "data": [
    {
        "id": 10,
        "child_from_family_id": null,
        "firstnames": "Roberto",
        "lastname": "Fischer",
        "created_at": "2021-08-10T16:23:54.000000Z",
        "updated_at": "2021-08-10T16:23:54.000000Z"
    },
    ....
  ],
}
```

### View A Person

GET: /api/person/{personID}

```
Params: null
Response: {
  "data": {
    "id": 16,
    "child_from_family_id": 6,
    "firstnames": "Guilherme Alexandre",
    "lastname": "Fischer",
    "created_at": "2021-08-10T17:05:05.000000Z",
    "updated_at": "2021-08-10T17:05:24.000000Z",
    "family": [
        {
            "id": 7,
            "husband_id": 16,
            "wife_id": 14,
            "created_at": "2021-08-10T17:10:47.000000Z",
            "updated_at": "2021-08-10T17:10:47.000000Z",
            "husband": {
                "id": 16,
                "child_from_family_id": 6,
                "firstnames": "Guilherme Alexandre",
                "lastname": "Fischer",
                "created_at": "2021-08-10T17:05:05.000000Z",
                "updated_at": "2021-08-10T17:05:24.000000Z"
            },
            "wife": {
                "id": 14,
                "child_from_family_id": null,
                "firstnames": "Future Wife",
                "lastname": "Fischer",
                "created_at": "2021-08-10T17:02:42.000000Z",
                "updated_at": "2021-08-10T17:04:20.000000Z"
            },
            "children": [
                {
                    "id": 15,
                    "child_from_family_id": 7,
                    "firstnames": "Future Son",
                    "lastname": "Fischer",
                    "created_at": "2021-08-10T17:02:48.000000Z",
                    "updated_at": "2021-08-10T17:02:48.000000Z",
                    "family": []
                }
            ]
        }
    ]
  }
}
```

### Create A Person

POST: /api/person/

```
Params: {
  firstnames: "Guilherme Alexandre",
  lastname: "Fischer"
}
Response: {
  "data": {
    "firstnames": "Guilherme Alexandre",
    "lastname": "Fischer",
    "updated_at": "2021-08-10T21:08:11.000000Z",
    "created_at": "2021-08-10T21:08:11.000000Z",
    "id": 17
  },
}
```

### Update A Person

PUT: /api/person/{personID}

```
Params: {
  firstnames: "Guilherme Alexandre",
  lastname: "Fischer"
}
Response: {
  "data": {
    "firstnames": "Guilherme Alexandre",
    "lastname": "Fischer",
    "updated_at": "2021-08-10T21:08:11.000000Z",
    "created_at": "2021-08-10T21:08:11.000000Z",
    "id": 17
  },
}
```

### Relate A Family To A Person

POST: /api/person/{personID}/relate-family

```
Params: {
  child_from_family_id: 1,
}
Response: {
  "data": {
    "id": 16,
    "child_from_family_id": 1,
    "firstnames": "Guilherme Alexandre",
    "lastname": "Fischer",
    "created_at": "2021-08-10T17:05:05.000000Z",
    "updated_at": "2021-08-10T17:05:24.000000Z"
  },
}
```

### DELETE A Person

DELETE: /api/person/{personID}

```
Params: null
Response: {
  "success": true,
  "data": null,
  "message": ""
}
```

## Family

### List All Families

GET: /api/family

```
Params: null
Response: {
  "data": [
    {
        "id": 6,
        "husband_id": 10,
        "wife_id": 11,
        "created_at": "2021-08-10T17:04:09.000000Z",
        "updated_at": "2021-08-10T17:04:09.000000Z"
    },
    ....
  ],
}
```

### View A Family

GET: /api/family/{familyID}

```
Params: null
Response: {
  "data": {
    "id": 7,
    "husband_id": 16,
    "wife_id": 14,
    "created_at": "2021-08-10T17:10:47.000000Z",
    "updated_at": "2021-08-10T17:10:47.000000Z",
    "husband": {
        "id": 16,
        "child_from_family_id": 6,
        "firstnames": "Guilherme Alexandre",
        "lastname": "Fischer",
        "created_at": "2021-08-10T17:05:05.000000Z",
        "updated_at": "2021-08-10T17:05:24.000000Z"
    },
    "wife": {
        "id": 14,
        "child_from_family_id": null,
        "firstnames": "Future Wife",
        "lastname": "Fischer",
        "created_at": "2021-08-10T17:02:42.000000Z",
        "updated_at": "2021-08-10T17:04:20.000000Z"
    },
    "children": [
        {
            "id": 15,
            "child_from_family_id": 7,
            "firstnames": "Future Son",
            "lastname": "Fischer",
            "created_at": "2021-08-10T17:02:48.000000Z",
            "updated_at": "2021-08-10T17:02:48.000000Z",
            "family": []
        }
    ]
  }
}
```

### Create A Family

POST: /api/family/

```
Params: {
  husband_id: 16,
  wife_id: 14
}
Response: {
  "data": {
    "husband_id": 16,
    "wife_id": 14,
    "updated_at": "2021-08-10T21:18:38.000000Z",
    "created_at": "2021-08-10T21:18:38.000000Z",
    "id": 8
  },
}
```

### Update A Family

PUT: /api/family/{familyID}

```
Params: {
  husband_id: 16,
  wife_id: 15
}
Response: {
  "data": {
    "id": 8,
    "husband_id": 16,
    "wife_id": 15,
    "created_at": "2021-08-10T21:18:38.000000Z",
    "updated_at": "2021-08-10T21:18:38.000000Z"
  },
}
```

### DELETE A Family

DELETE: /api/family/{familyID}

```
Params: null
Response: {
  "success": true,
  "data": null,
  "message": ""
}
```
