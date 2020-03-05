# APIPlayground

## Docker
### Build
```
docker-compose build --force-rm
```

### Compose (start applications)
```
docker-compose up -d --force-recreate
```

### Docker status
```
docker ps -a
```

### Enter docker php container
```
docker exec -it dummy-php bash
```

## Update dependencies
```
composer update
```

## Database
```
php bin/console doctrine:database:create --if-not-exists 
```

```
php bin/console doctrine:migrations:migrate -n 
```

## Basic auth
Username: admin
Password: admin

## Token auth
```
Required header
Key: Authorization
Value: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiIxMjM0NTY3ODkwIiwibmFtZSI6IkpvaG4gRG9lIiwiaWF0IjoxNTE2MjM5MDIyfQ.SflKxwRJSMeKKF2QT4fwpMeJf36POk6yJV_adQssw5c
```

## Graph query
http://localhost/graphiql

Using postman:
http://localhost/g

### Employee Detail
```
{
  employee_detail(uuid:"825293d8-0bc5-415b-9389-6b769d92115c") {
    uuid
    name
    age
    salary
  }
}
```

### Employee List
```
{
  employee_list {
    employees {
      uuid
      name
      age
      salary
    }
  }
}
```

### Employee create
```
mutation {
  employee_create(input: { name: "Foo", age: 23, salary:2330}){
    name,
    age,
    salary,
    uuid
  }
}
```

### Employee update
```
mutation {
  employee_update(uuid: "123e06d9-4e39-4d03-86af-6dcc4475a2f9", input: { name: "Foo 2", age: 23, salary:2330}){
    name,
    age,
    salary,
    uuid
  }
}
```

### Delete
```
mutation {
  employee_delete(uuid: "a4984157-51be-4381-b0a2-8ba971bc1b23"){
    name,
    age,
    salary,
    uuid
  }
}
```