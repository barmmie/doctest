### Authentication

Changer's API expects for the User's <code>auth_token</code> and <code>username</code> to be included in all API requests to the server in request headers that looks like the following:

`Authorization: Bearer {auth_token}`

`X-Consumer-Username: {username}`

```bash
# With shell, you can just pass the correct header with each request
curl "api_endpoint_here"
  -H "Authorization: bearer {auth_token}"
  -H "X-Consumer-Username: {username}"
  
```

> Make sure to replace `{auth_token}`  and `{username}` with their actual values.

