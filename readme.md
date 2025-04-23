# DotaHunt - Esports Team Finder

An application for Dota 2 players to find teams, arrange scrims (practice matches), and participate in tournaments.

*Award-winning Final Year Project: https://farhanhadi.netlify.app/dotahunt-menang-anugerah-panel-industri-untuk-final-year-project-exhibition-ui-tm-jasin-2020*

## Features

- Player profiles with statistics and achievements
- Team creation and management
- Scrim scheduling system
- Tournament listings and registration
- Player recommendation system
- Location-based player finder
- In-app messaging system
- Steam account integration

## Deployment Guide for Render.com

### Prerequisites

1. A Render.com account
2. Git installed on your local machine

### Step 1: Prepare Your Environment File

Create a `.env` file in the root directory of the project with the following content (replace placeholders with your actual values):

```
APP_NAME=DotaHunt
APP_ENV=production
APP_KEY=base64:YOUR_GENERATED_KEY
APP_DEBUG=false
APP_URL=https://your-render-app-url.onrender.com

LOG_CHANNEL=stderr

DB_CONNECTION=pgsql
DATABASE_URL=postgres://username:password@host:port/database

BROADCAST_DRIVER=pusher
CACHE_DRIVER=file
QUEUE_CONNECTION=database
SESSION_DRIVER=cookie
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null

PUSHER_APP_ID=your_pusher_app_id
PUSHER_APP_KEY=your_pusher_app_key
PUSHER_APP_SECRET=your_pusher_app_secret
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

### Step 2: Deploy to Render.com

1. **Create a PostgreSQL Database on Render**
   - Log in to your Render dashboard
   - Click on "New" and select "PostgreSQL"
   - Name your database (e.g., `dotahunt-db`)
   - Choose a plan (Free tier is available)
   - Click "Create Database"
   - Copy the "Internal Database URL" for the next step

2. **Create a Web Service on Render**
   - Click on "New" and select "Web Service"
   - Connect your GitHub repository or use the "Deploy from git repository" option
   - Name your service (e.g., `dotahunt`)
   - Select "PHP" as the runtime
   - Set the build command: `composer install --no-interaction --prefer-dist --optimize-autoloader --no-dev && npm install && npm run production`
   - Set the start command: `php artisan migrate --force && php artisan config:cache && php artisan route:cache && php artisan view:cache && php -S 0.0.0.0:$PORT -t public`

3. **Set Environment Variables**
   - In the "Environment" tab, add the following key-value pairs:
     - `APP_ENV`: `production`
     - `APP_DEBUG`: `false`
     - `APP_KEY`: Generate with `php artisan key:generate --show`
     - `APP_URL`: Your Render web service URL
     - `DATABASE_URL`: The Internal Database URL from step 1
     - `DB_CONNECTION`: `pgsql`
     - `CACHE_DRIVER`: `file`
     - `SESSION_DRIVER`: `cookie`
     - `QUEUE_CONNECTION`: `database`
     - `LOG_CHANNEL`: `stderr`
     - Add any other environment variables needed for your app

4. **Deploy Your Application**
   - Click "Create Web Service"
   - Render will automatically build and deploy your application

### Step 3: Post-Deployment Tasks

1. **Set Up the Database**
   - The migrations will run automatically during deployment
   - If you need to seed the database, you can use the Render shell to run: `php artisan db:seed`

2. **Configure Steam API Integration**
   - Add your Steam API key to the environment variables
   - Update the callback URL in your Steam Developer account

3. **Set Up Pusher for Real-time Features**
   - Add your Pusher credentials to the environment variables

## Local Development

1. Clone the repository
2. Copy `.env.example` to `.env` and configure your environment
3. Run `composer install`
4. Run `npm install`
5. Run `php artisan key:generate`
6. Run `php artisan migrate`
7. Run `npm run dev` or `npm run watch`
8. Run `php artisan serve`

## License

This project is licensed under the MIT License.
