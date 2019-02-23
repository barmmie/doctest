# Errors

<aside class="notice">
    The Changer API uses the following error codes:
</aside>



Error Code | Meaning
---------- | -------
422 | Unprocessable Entity -- Most likely caused by a validation error
401 | Unauthorized -- Your API key is wrong
403 | Forbidden -- The requested is hidden for administrators only
404 | Not Found -- The specified resource could not be found
405 | Method Not Allowed -- You tried to access a resource with an invalid method
406 | Not Acceptable -- You requested a format that isn't json
500 | Internal Server Error -- We had a problem with our server. Try again later.
503 | Service Unavailable -- We're temporarially offline for maintanance. Please try again later.
