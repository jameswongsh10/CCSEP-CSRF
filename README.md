This project demo how basic CSRF works.

# CCSEP-CSRF-Exploit

Host the server with ```php -S 127.0.0.1:8888```

the default login detail is ```test:password```

go to ```http://127.0.0.1:8888/csrf-exploit.php``` for the exploit

# CCSEP-CSRF-Patch

Host the server with ```php -S 127.0.0.1:8888```

the default login detail is ```test:password```

go to ```http://127.0.0.1:8888/csrf-exploit.php``` to see the patch

# Explanation of the files

```account.php``` the main view of the program. It contains the dashboard to show the transactions of the user and the actual transaction form.

```common.php``` the common functions that this program uses. 

```csrf-exploit.php``` the csrf exploit page for this program 

```index.html``` the login page of the program

```login.php``` the backend of the file to which the POST requests are sent to from ```index.html```

```reset.php``` used to reset the current state of the program to its original state

```transfer.php``` the backend code for the transaction shown in ```account.php```

```transfer-for-csrf.php``` this is a slightly modified file from ```transfer.php```. The difference between this file in Exploit and Patch is that in Exploit, there is a slight modification on line 18 to line 19, where it redirects the user to the ```account.php``` and set a session variable called ```alertMessage```. For Patch, there are more changes as it has to compare the token of the user and the token stored in the session. If the token match, it will execute the POST request. Else the request will be rejected.
