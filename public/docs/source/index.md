---
title: API Reference

language_tabs:
- bash
- javascript

includes:
- errors
- authentication

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->
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



#Journey management

APIs for managing interacting with user's journey history
<!-- START_b69a9536e6a53b6cc06386241c693075 -->
## Log journey

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
This endpoint allows the client to send his journey log.

> Example request:

```bash
curl -X POST "http://localhost/api/v1/journey_histories/create" \
    -H "Authorization: Bearer {auth_token}" \
    -H "X-Consumer-Username: {username}" \
    -H "Content-Type: application/json" \
    -d '{"distance":200,"journey_type":"walking","start_time":"2019-02-23T00:00:00Z","end_time":"2019-02-23T17:09:28.889Z"}'

```

```javascript
const url = new URL("http://localhost/api/v1/journey_histories/create");

let headers = {
    "Authorization": "Bearer {auth_token}",
    "X-Consumer-Username": "{username}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "distance": 200,
    "journey_type": "walking",
    "start_time": "2019-02-23T00:00:00Z",
    "end_time": "2019-02-23T17:09:28.889Z"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "journey_log": {
        "id": 23,
        "journey_type": "walking",
        "distance": 200,
        "start_time": "2019-02-23UTC23:00:0017",
        "end_time": "2019-02-23UTC23:00:0017"
    }
}
```

### HTTP Request
`POST api/v1/journey_histories/create`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    distance | integer |  required  | The distance traveled. Metric system of measurement.
    journey_type | string |  required  | The type of journey, Must be one of  'walking' , 'biking' , 'driving" , 'flying'.
    start_time | datetime |  required  | The time the journey started. Use ISO 8601 format.
    end_time | datetime |  required  | The time the journey ended. Use ISO 8601 format.

<!-- END_b69a9536e6a53b6cc06386241c693075 -->

<!-- START_82ca959c089f7eb7e36f6199c4144752 -->
## Compute lifetime distance

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
This endpoint allows the client to get his lifetime distance for each mobility type.

> Example request:

```bash
curl -X GET -G "http://localhost/api/v1/journey_histories/{journey_type}/compute_distance" \
    -H "Authorization: Bearer {auth_token}" \
    -H "X-Consumer-Username: {username}"
```

```javascript
const url = new URL("http://localhost/api/v1/journey_histories/{journey_type}/compute_distance");

    let params = {
            "journey_type": "walking",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Authorization": "Bearer {auth_token}",
    "X-Consumer-Username": "{username}",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (200):

```json
{
    "computed_distance": 4
}
```

### HTTP Request
`GET api/v1/journey_histories/{journey_type}/compute_distance`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    journey_type |  required  | The type of journey, Must be one of  'walking' , 'biking' , 'driving' , 'flying'.

<!-- END_82ca959c089f7eb7e36f6199c4144752 -->


