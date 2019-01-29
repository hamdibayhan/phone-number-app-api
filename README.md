First of all, create environment.php file in config file.
Then fill environment.php file like the environments_sample file content and
change 'XXXX' variables with your self-variables.

# Start Server
# `php -S localhost:4000`

Your server will run at [http://localhost:4000](http://localhost:4000)

# GET Method - http://localhost:4000/api/sub_number/numbers.php

If result is success:
```javascript
{
  success: true, 
  sub_numbers: ['1001', '1002']
}
```

If result isn't success:
```javascript
{
  success: false, 
  message: 'Sub numbers do not found'
}
```

# GET Method - http://localhost:4000/api/main_number/numbers.php

If result is success:
```javascript
{
  success: true, 
  main_numbers: ['2001', '2002']
}
```

If result isn't success:
```javascript
{
  success: false, 
  message: 'Main numbers do not found'
}
```

# POST Method - http://localhost:4000/api/invoce/amount.php

JSON Example data:
```javascript
{
  representative_email: "example@example.com",
  representative_phone_number: "+9005000000000",
  commitment_performance_period: "1_yearly",
  main_number: "1234",
  sub_numbers: ["1234", "1235"]
}
```
-----------

If result is success:
```javascript
{
  success: true, 
  amount: 1000,
  message: 'Invoce amount calculated successfully'
}
```
If result isn't success:
```javascript
{
  success: false, 
  message: 'Invoce amount not calculated'
}
```
# POST Method - http://localhost:4000/api/company/companies.php

JSON Example data:
```javascript
{
  name: "name",
  address: "address",
  sector: "sector",
  tax_office: "tax office",
  tax_number: "123123",
  representative_email: "example@example.com",
  representative_phone_number: "+9005000000000",
  representative_name: "representative name",
  commitment_performance_period: "1_yearly",
  main_number: "1234",
  sub_numbers: ["1234", "1235"],
  amount: 100
}
```
-----------

If result is success:
```javascript
{
  success: true,
  message: 'Phone numbers taken successfully'
}
```

If result isn't success:
```javascript
{
  success: false, 
  message: 'Phone numbers could not taken'
}
```