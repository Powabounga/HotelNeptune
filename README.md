# projet_trans_hotel

## SETUP

-   Environment Variables

1. Rename the `.env.example` to `.env`
2. Add these to your `.env` file:

```
ROOT_PASSWORD=secret
PASSWORD=secret
```

-   Github
    Once you have made a change and you want to push it to github do:

1. `git add .`
2. `git commit -m 'commit message here'`
3. `git push`

To pull data from the repository

1. `git pull`

-   To Run

1. In the console write this command to start the server `docker compose up`
2. The first time might take a few minutes but after it will be almost instant
3. The main server will be in `http://127.0.0.1/`
4. The phpmyadmin page is in `localhost:8000`
5. To close server press cntr+c in the terminal that the server is running

-   phpmyadmin

host = mysql
user = tutorial
password = secret
